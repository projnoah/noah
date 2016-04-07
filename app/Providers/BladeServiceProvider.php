<?php

namespace Noah\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @author Cali
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @author Cali
     */
    public function register()
    {
        $this->registerTransDirective();
        $this->registerUrlDirective();
        $this->registerRouteDirective();
        $this->registerSiteDirective();
    }

    /**
     * Register @trans(...).
     *
     * @see trans()
     * @author Cali
     */
    private function registerTransDirective()
    {
        Blade::directive('trans', function ($expression) {
            return "<?php echo trans{$expression} ?>";
        });
    }

    /**
     * Register @url(...).
     *
     * @see url()
     * @author Cali
     */
    private function registerUrlDirective()
    {
        Blade::directive('url', function ($expression) {
            return "<?php echo url{$expression} ?>";
        });
    }

    /**
     * Register @route(...).
     *
     * @see route()
     * @author Cali
     */
    private function registerRouteDirective()
    {
        Blade::directive('route', function ($expression) {
            return "<?php echo route{$expression} ?>";
        });
    }

    /**
     * Register @site(...).
     *
     * @see \Noah\Library\Facades\Site
     * @author Cali
     */
    private function registerSiteDirective()
    {
        Blade::directive('site', function ($expression) {
            return "<?php echo Site::callByExpression{$expression} ?>";
        });
    }
}
