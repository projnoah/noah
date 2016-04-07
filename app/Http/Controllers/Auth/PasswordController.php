<?php

namespace Noah\Http\Controllers\Auth;

use Noah\Http\Controllers\Controller;
use Noah\Library\Traits\Auth\ResetsPasswords;

class PasswordController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    | 密码重置 控制器
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    | @project Project Noah
    | @author Cali
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
