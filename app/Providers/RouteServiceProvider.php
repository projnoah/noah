<?php

namespace Noah\Providers;

use Site;
use Noah;
use Carbon\Carbon;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {

    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Noah\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router $router
     * @author Cali
     */
    public function boot(Router $router)
    {
        $this->setTimeLocale();
        $this->adjustLocale();

        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router $router
     * @author Cali
     */
    public function map(Router $router)
    {
        $this->mapWebRoutes($router);

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param  \Illuminate\Routing\Router $router
     * @author Cali
     */
    protected function mapWebRoutes(Router $router)
    {
        $router->group([
            'namespace' => $this->namespace, 'middleware' => 'web',
        ], function ($router) {
            require app_path('Http/Routes/entry.php');
        });
    }

    /**
     * Set the Carbon locale.
     *
     * @author Cali
     */
    protected function setTimeLocale()
    {
        Carbon::setLocale(substr($this->app->getLocale(), 0, 2));
    }

    /**
     * Adjust the locale with different browser languages.
     *
     * @author Cali
     */
    private function adjustLocale()
    {
        if (request()->hasCookie('lang')) {
            $this->setLocale(Crypt::decrypt(request()->cookie('lang')));
        } else {
            if (site('autoLocale') != '0') {
                // TODO: Uncomment when we're ready
//            request()->header('accept-language') ? $this->setLocale(substr(request()->header('accept-language'), 0, 2)) : null;
            }
        }
    }

    /**
     * Switch locale
     *
     * @param $locale
     */
    private function setLocale($locale)
    {
        if (in_array($locale, Noah::supportedLocales())) {
            app()->setLocale($locale);
        }
    }
}
