<?php

namespace Noah\Http\Controllers\Auth;

use Crypt;
use Noah\User;
use Validator;
use Illuminate\Http\Request;
use Noah\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Noah\Library\Traits\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    | 注册 & 登录 控制器
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    | @project Project Noah
    | @author Cali
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * The username field
     *
     * @var string
     */
    protected $username = "username";

    /**
     * Create a new authentication controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'confirmRegistration']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     *
     * @author Cali
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:191|min:3|unique:users',
            'email'    => 'required|email|max:191|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);
    }

    /**
     * Confirm the registration through email.
     *
     * @param Request $request
     * @return mixed
     *
     * @author Cali
     */
    public function confirmRegistration(Request $request)
    {
        $email = Crypt::decrypt($request->input('token'));

        // TODO:
        return User::activateByEmail($email) ?
            redirect($this->redirectPath())->with('status', 'success') :
            redirect('/');
    }
}
