<?php

namespace Noah\Http\Middleware;

use Closure;

class RedirectIfNotInstalled {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! noah_installed() && ! $request->is('install/step*')) {
            return redirect(route('install', ['step' => 1]));
        }

        return $next($request);
    }
}
