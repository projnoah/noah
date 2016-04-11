<?php

namespace Noah\Library\Facades;

use Illuminate\Support\Facades\Facade;

class Noah extends Facade {

    protected static function getFacadeAccessor()
    {
        return \Noah\Library\Models\Noah::class;
    }
}