<?php

namespace Noah\Library\Traits\Auth;

use Auth;
use Noah\User;
use Socialite;

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

    
    public function callback($service)
    {
        // TODO: Add QQ, Weibo, Wechat ...
        Auth::login(User::socialize($service), true);
        
        return Auth::user();
    }
}