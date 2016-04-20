<?php

namespace Noah\Http\Controllers\Admin;

use Socialite;
use Noah\User;
use Noah\Avatar;
use Illuminate\Http\Request;
use Noah\Http\Controllers\Controller;
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
        $avatar = $request->file('avatar');

        Avatar::move($avatar, $request->user());

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
        $old_avatar = $request->user()->localAvatar();
        $path = storage_path('app/' . $old_avatar->src);

        $resized_avatar = resize_avatar($path, intval($request->width), intval($request->height), intval($request->x), intval($request->y));

        $avatar = new Avatar(['type' => Avatar::TYPE_LOCAL, 'src' => $old_avatar->src]);
        $request->user()->avatars()->save($avatar);

        return $this->successResponse([
            'avatarUrl' => route('users.avatar', [
                'user' => $request->user()->id, 'v' => ($request->user()->avatarVersion() + 1)
            ]),
            'message'   => $resized_avatar ? trans('views.admin.pages.users.profile.avatar.update-success') :
                trans('views.admin.pages.users.profile.avatar.update-failure')
        ]);
    }
}