<?php

namespace Noah\Library\Traits\Auth;

use Site;
use Auth;
use Mailer;
use Password;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Noah\Events\User\Auth\UserWasReset;
use Illuminate\Foundation\Auth\RedirectsUsers;

trait ResetsPasswords {

    /*
     |------------------------------------------------------------
     | Resets Passwords Trait
     | 密码重置 Trait
     |------------------------------------------------------------
     |
     | It is responsible for making password reset request
     | and also handles when the user clicked via email.
     | Log the user in after reset validation passes.
     |
     | @project Project Noah
     | @author Cali
     |
     */
    
    use RedirectsUsers;

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     * @author Cali
     */
    public function getEmail()
    {
        return $this->showLinkRequestForm();
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     * @author Cali
     */
    public function showLinkRequestForm()
    {
        if (property_exists($this, 'linkRequestView')) {
            return view($this->linkRequestView);
        }

        if (view()->exists('auth.passwords.email')) {
            return view('auth.passwords.email');
        }

        return view('auth.password');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @author Cali
     */
    public function postEmail(Request $request)
    {
        return $this->sendResetLinkEmail($request);
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @author Cali
     */
    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), ['email' => 'required|email']);

        if ($validator->fails()) {
            return [
                'status'  => 'error',
                'message' => array_values($validator->messages()->toArray())
            ];
        }

        $broker = $this->getBroker();

        $response = Password::broker($broker)->sendResetLink(
            $request->only('email'), $this->resetEmailBuilder()
        );

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return $this->getSendResetLinkEmailSuccessResponse($response);

            case Password::INVALID_USER:
            default:
                return $this->getSendResetLinkEmailFailureResponse($response);
        }
    }

    /**
     * Get the Closure which is used to build the password reset email message.
     *
     * @return \Closure
     * @author Cali
     */
    protected function resetEmailBuilder()
    {
        return function (Message $message) {
            $message->from(Site::adminEmail(), Site::siteTitle());
            $message->subject($this->getEmailSubject());
        };
    }

    /**
     * Get the e-mail subject line to be used for the reset link email.
     *
     * @return string
     * @author Cali
     */
    protected function getEmailSubject()
    {
        return property_exists($this, 'subject') ? $this->subject : trans('passwords.email.subject');
    }

    /**
     * Get the response for after the reset link has been successfully sent.
     *
     * @param  string $response
     * @return \Symfony\Component\HttpFoundation\Response
     * @author Cali
     */
    protected function getSendResetLinkEmailSuccessResponse($response)
    {
        return request()->ajax() ? [
            'status' => 'succeeded',
            'message' => trans($response)
        ] : redirect()->back()->with('status', trans($response));
    }

    /**
     * Get the response for after the reset link could not be sent.
     *
     * @param  string $response
     * @return \Symfony\Component\HttpFoundation\Response
     * @author Cali
     */
    protected function getSendResetLinkEmailFailureResponse($response)
    {
        return request()->ajax() ? [
            'status'  => 'error',
            'message' => trans($response)
        ] : redirect()->back()->withErrors(['email' => trans($response)]);
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string|null              $token
     * @return \Illuminate\Http\Response
     * @author Cali
     */
    public function getReset(Request $request, $token = null)
    {
        return $this->showResetForm($request, $token);
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string|null              $token
     * @return \Illuminate\Http\Response
     * @author Cali
     */
    public function showResetForm(Request $request, $token = null)
    {
        if (is_null($token)) {
            return $this->getEmail();
        }

        $email = $request->input('email');

        if (property_exists($this, 'resetView')) {
            return view($this->resetView)->with(compact('token', 'email'));
        }

        if (view()->exists('auth.passwords.reset')) {
            return view('auth.passwords.reset')->with(compact('token', 'email'));
        }

        return view('auth.reset')->with(compact('token', 'email'));
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @author Cali
     */
    public function postReset(Request $request)
    {
        return $this->reset($request);
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @author Cali
     */
    public function reset(Request $request)
    {
        $this->validate($request, $this->getResetValidationRules());

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $broker = $this->getBroker();

        $response = Password::broker($broker)->reset($credentials, function ($user, $password) {
            $this->resetPassword($user, $password);
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                return $this->getResetSuccessResponse($response);

            default:
                return $this->getResetFailureResponse($request, $response);
        }
    }

    /**
     * Get the password reset validation rules.
     *
     * @return array
     * @author Cali
     */
    protected function getResetValidationRules()
    {
        return [
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|confirmed|min:6',
        ];
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword $user
     * @param  string                                      $password
     * @author Cali
     */
    protected function resetPassword($user, $password)
    {
        $user->password = bcrypt($password);

        $user->save();

        Auth::guard($this->getGuard())->login($user);
    }

    /**
     * Get the response for after a successful password reset.
     *
     * @param  string $response
     * @return \Symfony\Component\HttpFoundation\Response
     * @author Cali
     */
    protected function getResetSuccessResponse($response)
    {
        Auth::user()->passwordHasReset();

        return redirect($this->redirectPath())->with('status', trans($response));
    }

    /**
     * Get the response for after a failing password reset.
     *
     * @param  Request $request
     * @param  string  $response
     * @return \Symfony\Component\HttpFoundation\Response
     * @author Cali
     */
    protected function getResetFailureResponse(Request $request, $response)
    {
        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return string|null
     * @author Cali
     */
    public function getBroker()
    {
        return property_exists($this, 'broker') ? $this->broker : null;
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return string|null
     * @author Cali
     */
    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }
}