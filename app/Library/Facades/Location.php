<?php

namespace Noah\Library\Facades;

use Illuminate\Support\Facades\Facade;

class Location extends Facade {

    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return \Noah\Library\Models\Location::class;
    }
}