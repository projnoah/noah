<?php

namespace Noah\Library\Facades;

use Illuminate\Support\Facades\Facade;

class Mailer extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return mixed
     */
    protected static function getFacadeAccessor()
    {
        return \Noah\Library\Models\Mailer::class;
    }
}