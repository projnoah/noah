<?php

namespace Noah\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Noah\Library\Traits\Controller\APIResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, APIResponse;
}
