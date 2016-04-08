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
        'Noah\Events\User\Auth\UserWasRegistered' => [
            'Noah\Listeners\User\EmailConfirmation@handleRegistered',
        ],
        'Noah\Events\User\Auth\UserWasLogged'     => [
            'Noah\Listeners\User\EmailConfirmation@handleLoggedIn',
        ],
        'Noah\Events\User\Auth\UserWasReset' => [
            'Noah\Listeners\User\EmailConfirmation@handleReset',
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
