<?php

namespace Noah\Listeners\User;

use Crypt;
use Illuminate\Mail\Message;
use Mailer;
use Noah\Events\User\Auth\UserWasReset;
use Illuminate\Queue\InteractsWithQueue;
use Noah\Events\User\Auth\UserWasLogged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Noah\Events\User\Auth\UserWasRegistered;

class EmailConfirmation {

    /**
     * Handle when the user registered.
     *
     * @param  UserWasRegistered $event
     * @author Cali
     */
    public function handleRegistered(UserWasRegistered $event)
    {
        // Create the token
        $token = Crypt::encrypt($event->user->email);
        // Send it to the user
        Mailer::subject(trans('emails.auth.registered.subject'))->user($event->user)
            ->load('auth.emails.registered')->with(compact('token'))->send();
    }

    /**
     * Handle when the user logged in.
     *
     * @param UserWasLogged $event
     * @author Cali
     */
    public function handleLoggedIn(UserWasLogged $event)
    {

    }

    /**
     * Handle when the user reset the password.
     *
     * @param UserWasReset $event
     * @author Cali
     */
    public function handleReset(UserWasReset $event)
    {
        Mailer::subject(trans('passwords.email.success'))->user($event->user)
            ->load('auth.emails.reset-success')->send();
    }
}