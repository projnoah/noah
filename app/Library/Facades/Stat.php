<?php

namespace Noah\Library\Facades;

use Illuminate\Support\Facades\Facade;

class Stat extends Facade {

    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return \Noah\Statistic::class;
    }
}