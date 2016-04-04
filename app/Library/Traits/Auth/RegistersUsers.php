<?php

namespace Noah\Library\Traits\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RedirectsUsers;

trait RegistersUsers {

    /*
    |------------------------------------------------------------
    | RegistersUsers Trait
    | 用户注册逻辑Trait
    |------------------------------------------------------------
    |
    | @project Project Noah
    | @author  Cali
    |
    */
    
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return $this->showRegistrationForm();
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        return $this->register($request);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return [
                'status'   => 'error',
                'messages' => $validator->messages()
            ];
        }

        Auth::login($this->create($request->all()));

        return [
            'status' => 'succeeded',
            'redirect' => $this->redirectPath()
        ];
    }
}
