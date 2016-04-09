<?php

namespace Noah\Listeners\User;

use Crypt;
use Mailer;
use Noah\Events\User\Auth\UserHasRegistered;

class EmailRegisterConfirmation {

    /**
     * Handle the event.
     *
     * @param  UserHasRegistered $event
     * @author Cali
     */
    public function handle(UserHasRegistered $event)
    {
        // Create the token
        $token = Crypt::encrypt($event->user->email);
        // Send it to the user
        Mailer::subject(trans('emails.auth.registered.subject'))->user($event->user)
            ->load('auth.emails.registered')->with(compact('token'))->send();
    }
}
