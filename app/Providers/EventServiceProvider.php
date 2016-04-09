<?php

namespace Noah\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Noah\Events\User\Auth\UserHasRegistered' => [
            'Noah\Listeners\User\EmailRegisterConfirmation',
        ],
        'Noah\Events\User\Auth\UserHasLoggedIn'     => [
//            'Noah\Listeners\User\EmailConfirmation@handleLoggedIn',
        ],
        'Noah\Events\User\Auth\UserHasReset' => [
            'Noah\Listeners\User\EmailPasswordResetConfirmation',
        ]
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
