<?php

namespace Noah\Http\Middleware;

use Closure;
use Noah\Statistic;

class RecordStatistics {

    protected $excludes = [
        ['route' => 'admin.dashboard', 'all' => true],
        ['route' => 'users.avatar', 'all' => true]
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (noah_installed() && strtoupper($request->method()) === 'GET') {
            if ($this->filterExclusions($request)) {
                Statistic::visited($request);
            }
        }

        return $next($request);
    }

    /**
     * Filter excluded paths that is unnecessary to record in statistics.
     *
     * @param $request
     * @return bool
     *
     * @author Cali
     */
    protected function filterExclusions($request)
    {
        foreach ($this->excludes as $exclude) {
            if ($exclude['all']) {
                if ($request->is(substr(route($exclude['route'], [], false), 1) . '*')) {
                    return false;
                }
            } else {
                if ($request->is(substr(route($exclude['route'], [], false), 1))) {
                    return false;
                }
            }
        }

        return true;
    }
}
