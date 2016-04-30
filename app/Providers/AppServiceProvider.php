<?php

namespace Noah\Providers;

use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;
use Noah\SiteConfiguration as Site;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->generateKeyIfNotGiven();
        $this->registerSiteSingleton();
    }

    /**
     * Registers the site configuration singleton.
     * 
     * @author Cali
     */
    private function registerSiteSingleton()
    {
        $this->app->singleton('Site', function () {
            return new Site;
        });
    }

    /**
     * Always check if the key is generated.
     * 
     * @author Cali
     */
    protected function generateKeyIfNotGiven()
    {
        $config = $this->app->make('config')->get('app');

        if (! Str::startsWith($config['key'], 'base64:')) {
            $key = 'base64:' . base64_encode(random_bytes(
                    $config['cipher'] == 'AES-128-CBC' ? 16 : 32
                ));

            env_put('APP_KEY', $key);

            $this->app['config']['app.key'] = $key;
        }
    }
}
