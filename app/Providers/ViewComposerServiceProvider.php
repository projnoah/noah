<?php

namespace Noah\Providers;

use DB;
use Noah;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->fetchServerInfo();
        $this->fetchDatabaseInfo();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Fetch server info.
     *
     * @author Cali
     */
    protected function fetchServerInfo()
    {
        view()->composer('admin.settings.related.advanced-server-info', function ($view) {
            return $view->with(Noah::advancedServerInfo());
        });
    }

    /**
     * Fetch database info.
     * 
     * @author Cali
     */
    protected function fetchDatabaseInfo()
    {
        view()->composer('admin.settings.related.database-info', function ($view) {
            // Fetch tables
            $tables = collect([]);
            $total_records = 0;
            $total_size = 0.0;

            foreach (DB::getPdo()->query('show tables')->fetchAll() as $t) {
                $status = DB::getPdo()->query("show table status like '{$t[0]}'")->fetchAll()[0];
                $tables->push([
                    'name'   => $t[0],
                    'status' => [
                        'engine'    => $status['Engine'],
                        'rows'      => $status['Rows'],
                        'size'      => $status['Data_length'] / 1024.0,
                        'collation' => $status['Collation']
                    ]
                ]);
                $total_records += $status['Rows'];
                $total_size += $status['Data_length'] / 1024.0;
            }
            
            $view->with(compact('tables', 'total_records', 'total_size'));
        });
    }
}
