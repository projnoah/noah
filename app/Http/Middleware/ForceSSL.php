<?php

namespace Noah\Http\Middleware;

use Closure;

class ForceSSL {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $request->isSecure() && noah_installed() && site('forceSsl') == '1') {
            return redirect($request->path(), 302, [], true);
        }

        return $next($request);
    }
}
