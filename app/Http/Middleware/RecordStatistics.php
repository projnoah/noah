<?php

namespace Noah\Http\Middleware;

use Closure;
use Noah\Statistic;

class RecordStatistics {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (noah_installed() && strtoupper($request->method()) === 'GET' && 
            ! $request->is(substr(route('admin.dashboard', [], false), 1) . '*')) {
            Statistic::visited($request);
        }

        return $next($request);
    }
}
