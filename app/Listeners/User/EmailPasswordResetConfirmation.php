<?php

namespace Noah\Listeners\User;

use Mailer;
use Noah\Events\User\Auth\UserHasReset;

class EmailPasswordResetConfirmation {

    /**
     * Handle the event.
     *
     * @param  UserHasReset $event
     * @author Cali
     */
    public function handle(UserHasReset $event)
    {
        Mailer::subject(trans('passwords.email.success'))->user($event->user)
            ->load('auth.emails.reset-success')->send();
    }
}
