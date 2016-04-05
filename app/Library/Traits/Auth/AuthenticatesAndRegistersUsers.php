<?php

namespace Noah\Library\Traits\Auth;

trait AuthenticatesAndRegistersUsers {

    /*
    |------------------------------------------------------------
    | AuthenticatesAndRegistersUsers Trait
    | 用户验证与注册逻辑Trait
    |------------------------------------------------------------
    |
    | @project Project Noah
    | @author  Cali
    |
    */
    
    use AuthenticatesUsers, RegistersUsers, SocialAuthenticatesUsers {
        AuthenticatesUsers::redirectPath insteadof RegistersUsers;
    }
}