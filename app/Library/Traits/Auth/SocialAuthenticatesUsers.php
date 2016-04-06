<?php

namespace Noah\Library\Traits\Auth;

use Auth;
use Validator;
use Noah\User;
use Socialite;
use Illuminate\Http\Request;

trait SocialAuthenticatesUsers {

    /*
     |------------------------------------------------------------
     | Authenticates Users w/ Social Platforms
     | 社交平台验证登录
     |------------------------------------------------------------
     |
     | 
     |
     | @project Project Noah
     | @author Cali
     |
     */

    /**
     * Redirect user to the related service auth.
     *
     * @param $service
     * @return \Illuminate\Http\Response
     *
     * @author Cali
     */
    public function socialLogin($service)
    {
        return Socialite::with($service)->redirect();
    }

    /**
     * @param  $service
     * @return \Illuminate\View\View
     *
     * @author Cali
     */
    public function callback($service)
    {
        $user = User::socialize($service);

        return view('auth.social', compact('user', 'service'));
    }

    public function connect(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:191|min:3|unique:users',
            'email'    => 'required|email|max:191|unique:users'
        ]);

        if ($validator->fails()) {
            return [
                'status'   => 'error',
                'messages' => array_values($validator->messages()->toArray())
            ];
        }
        // Create the user

        // Attach social information
        return [
            'status' => 'succeeded',
            'data'   => $request->all()
        ];
    }
}