<?php

namespace Noah\Http\Controllers\Admin;

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
        return view('admin.users.index');
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

    public function bindOrUnbindOAuth($service)
    {
        // Check bound or not
        // If not, redirect to service
        // If bound, unbind
    }
}
