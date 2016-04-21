<?php

namespace Noah\Http\Controllers\Admin;

use Socialite;
use Noah\User;
use Noah\Avatar;
use Illuminate\Http\Request;
use Noah\Http\Controllers\Controller;
use Noah\Library\Features\Users\Invitation;
use Noah\Library\Traits\Controller\APIResponse;
use Noah\Http\Requests\User\UpdateUserProfileRequest;
use Noah\Http\Requests\User\UpdateUserPasswordRequest;

class UsersController extends Controller {
    
    use APIResponse;

    /**
     * Show index users management page.
     *
     * @return mixed
     * @author Cali
     */
    public function showIndex()
    {
        $users = User::paginate();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show users' profile page.
     *
     * @return mixed
     * @author Cali
     */
    public function showProfile()
    {
        return view('admin.users.profile');
    }

    /**
     * Search users by the given keyword.
     * 
     * @param $keyword
     * @return mixed
     * 
     * @author Cali
     */
    public function searchUsers($keyword)
    {
        $users = User::search($keyword)->paginate();
        
        return view('admin.users.index', compact('users', 'keyword'));    
    }

    /**
     * Show invitations.
     * 
     * @return mixed
     * @author Cali
     */
    public function showInvitations()
    {
        return Invitation::hasCodes() ? view('admin.users.invitations', [
            'codes' => Invitation::getCodes()
        ]) : view('admin.users.invitations');
    }
    
    /**
     * Deletes a user.
     * 
     * @param User $user
     * @return array
     * @throws \Exception
     * 
     * @author Cali
     */
    public function deleteUser(User $user)
    {
        $user->delete();
        
        return $this->successResponse();
    }

    /**
     * Bulk action for users.
     * 
     * @param Request $request
     * @return array
     * 
     * @author Cali
     */
    public function bulkAction(Request $request)
    {
        $action = $request->action;

        switch ($action) {
            case 'delete':
                foreach (explode(',', $request->input('userIDs')) as $id) {
                    $user = User::findOrFail($id);
                    $user->delete();
                }
                break;
        }

        return $this->successResponse();
    }

    /**
     * Show this user's profile.
     *
     * @param User $user
     * @return mixed
     * @author Cali
     */
    public function showUserProfile(User $user)
    {
        return view('admin.users.profile', compact('user'));
    }
    
    /**
     * Save user's profile.
     *
     * @param UpdateUserProfileRequest $request
     * @return array
     *
     * @author Cali
     */
    public function saveProfile(UpdateUserProfileRequest $request)
    {
        $user = $request->user();
        foreach ($request->all() as $key => $value) {
            if (in_array($key, array_keys($user->attributesToArray())))
                $user->{$key} = $value;
        }

        if ($user->isDirty()) {
            $user->update($user->getDirty());
        }

        return $this->successResponse([
            'message' => trans('views.admin.pages.settings.updated', [
                'setting' => trans('views.admin.pages.users.profile.basics.heading')
            ])
        ]);
    }

    /**
     * Save this user's profile.
     *
     * @param User                     $user
     * @param Request $request
     * @return array
     *
     * @author Cali
     */
    public function updateUserProfile(User $user, Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:users,username,' . $user->id,
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email,' . $user->id
        ]);

        foreach ($request->all() as $key => $value) {
            if (in_array($key, array_keys($user->attributesToArray())))
                $user->{$key} = $value;
        }

        if ($user->isDirty()) {
            $user->update($user->getDirty());
        }

        return $this->successResponse([
            'message' => trans('views.admin.pages.settings.updated', [
                'setting' => trans('views.admin.pages.users.profile.basics.heading')
            ])
        ]);
    }

    /**
     * Update user's password.
     *
     * @param UpdateUserPasswordRequest $request
     * @return array
     *
     * @author Cali
     */
    public function updatePassword(UpdateUserPasswordRequest $request)
    {
        $request->user()->update(['password' => bcrypt(trim($request->input('password')))]);

        return $this->successResponse([
            'message' => trans('views.admin.pages.settings.updated', [
                'setting' => trans('views.admin.pages.users.profile.password.heading')
            ])
        ]);
    }

    /**
     * Update this user's password.
     *
     * @param User                      $user
     * @param UpdateUserPasswordRequest $request
     * @return array
     *
     * @author Cali
     */
    public function updateUserPassword(User $user, UpdateUserPasswordRequest $request)
    {
        $user->update(['password' => bcrypt(trim($request->input('password')))]);

        return $this->successResponse([
            'message' => trans('views.admin.pages.settings.updated', [
                'setting' => trans('views.admin.pages.users.profile.password.heading')
            ])
        ]);
    }

    /**
     * Bind/Unbind the user's OAuth service.
     *
     * @param         $service
     * @param Request $request
     * @return array
     *
     * @author Cali
     */
    public function bindOrUnbindOAuth($service, Request $request)
    {
        if ($request->user()->boundOAuth($service)) {
            $request->user()->unbindOAuth($service);

            return $this->successResponse([
                'message' => trans('views.admin.pages.users.profile.social.unbind-success', compact('service')),
                'reload'  => true
            ]);
        } else {
            return $this->successResponse(['redirectUrl' => route('admin.users.profile.oauth', compact('service'))]);
        }
    }

    /**
     * Redirect to oAuth service.
     *
     * @param $service
     * @return mixed
     * @author Cali
     */
    public function redirectToService($service)
    {
        if (site($service . 'On') != '1')
            return redirect('/');

        request()->session()->put('redirect', route('admin.users.profile.index', [], false));

        return Socialite::with($service)->redirect();
    }

    /**
     * Handle upload avatar.
     *
     * @param Request $request
     * @return array
     * @author Cali
     */
    public function uploadAvatar(Request $request)
    {
        Avatar::move($request->file('avatar'), $request->user());

        return response(json_encode([
            'url' => route('users.avatar', ['user' => $request->user()->id])
        ]), 200, [
            'Content-type' => 'text/html'
        ]);
    }

    /**
     * Resize the avatar to the cropper area.
     *
     * @param Request $request
     * @return array
     *
     * @author Cali
     */
    public function resizeAvatar(Request $request)
    {
        $resized_avatar = Avatar::resize($request);

        return $this->successResponse([
            'avatarUrl' => route('users.avatar', [
                'user' => $request->user()->id, 'v' => ($request->user()->avatarVersion() + 1)
            ]),
            'message'   => $resized_avatar ? trans('views.admin.pages.users.profile.avatar.update-success') :
                trans('views.admin.pages.users.profile.avatar.update-failure')
        ]);
    }

    /**
     * Generate invitation codes.
     * 
     * @param Request $request
     * @return array
     * 
     * @author Cali
     */
    public function generateInvitationCode(Request $request)
    {
        Invitation::generateCodes(intval($request->quantity));
        
        return $this->successResponse([
            'message' => trans('views.admin.pages.users.invitations.generated'),
            'reload'  => 'true'
        ]);
    }
}