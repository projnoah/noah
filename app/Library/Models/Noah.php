<?php

namespace Noah\Library\Models;

use File;
use Artisan;
use Composer\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;

class Noah {

    /*
     |------------------------------------------------------------
     | Noah Operations
     |------------------------------------------------------------
     |
     | @project Project Noah
     | @author Cali
     |
     */

    /**
     * Current noah version.
     */
    const VERSION = "0.1.0";

    /**
     * Beta version.
     */
    const IS_BETA = true;
    
    /**
     * Noah home URL.
     */
    const URL = "https://projnoah.com";
    
    /**
     * Noah update base url.
     */
    const UPDATE_BASE_URL = "https://projnoah.com/upgrades/";

    /**
     * Update Noah to the latest version.
     * 
     * @since 1.0.0
     * 
     * @return array
     * @author Cali
     */
    public static function update()
    {
        $output = [];
        $file_path = 'v' . self::getNewVersion() . '.zip';
        $file_url = self::UPDATE_BASE_URL . $file_path;

        self::checkDirectory();

        try {
            exec("cd upgrades && curl -O $file_url", $output);
            exec("cd upgrades && unzip $file_path", $output);
        } catch (\Exception $e) {
            // TODO: Something went wrong...
            return $output;
        }

        self::overwriteFiles($file_path);

        self::dumpAutoload();
        self::migrateDatabase();
        
        return $output;
    }

    /**
     * Get the new version string.
     * 
     * @return string
     */
    public static function getNewVersion()
    {
        // TODO: Fetch from server
        return "1.0.0";
    }

    /**
     * Get the current version of Project Noah.
     * 
     * @return string
     * @author Cali
     */
    public static function getCurrentVersion()
    {
        return static::VERSION;
    }

    /**
     * Get Noah home url.
     * 
     * @return string
     * @author Cali
     */
    public static function getHomeUrl()
    {
        return static::URL;
    }

    /**
     * Is the current version in beta.
     * 
     * @return bool
     * @author Cali
     */
    public static function isBeta()
    {
        return static::IS_BETA;
    }

    /**
     * Get the currently supported locales.
     * 
     * @return array
     * @author Cali
     */
    public static function supportedLocales()
    {
        return ['en', 'zh'];
    }

    /**
     * Dump autoload in Composer.
     * 
     * @author Cali
     */
    private static function dumpAutoload()
    {
        // Change to root directory
        chdir('../');
        
        putenv('COMPOSER_HOME=' . base_path('vendor/bin/composer'));

        $input = new ArrayInput(['command' => 'dump-autoload']);
        
        $application = new Application();
        $application->setAutoExit(false);
        $application->run($input);
        
        // Change back in
        chdir('public');
    }

    /**
     * Migrate the database changes.
     * 
     * @author Cali
     */
    private static function migrateDatabase()
    {
        Artisan::call('migrate');
    }

    /**
     * Overwrite the updated files.
     * 
     * @param $file_path
     * @author Cali
     */
    private static function overwriteFiles($file_path)
    {
        $dir_path = str_replace('.zip', "", $file_path);
        $directories = File::directories("upgrades/$dir_path");

        foreach ($directories as $directory) {
            File::copyDirectory($directory, '../' . File::name($directory));
        }
        
        File::deleteDirectory("upgrades/$dir_path");
    }

    /**
     * Check upgrades directory. Create if not exists.
     * 
     * @author Cali
     */
    private static function checkDirectory()
    {
        if (! File::isDirectory('upgrades')) {
            File::makeDirectory('upgrades');
        }
    }

    /**
     * Get the currently supported oAuths applications.
     * 
     * @return array
     * @author Cali
     */
    public static function supportedOAuths()
    {
        return [
            'facebook', 'weibo', 'qq', 'google',
            'weixin', 'youtube', 'github', 'linkedin',
            'dribbble', 'disqus', 'slack', 'spotify'
        ];
    }

    /**
     * Get advanced server information.
     * 
     * @return array
     * @author Cali
     */
    public static function advancedServerInfo()
    {
        $php_version = phpversion();
        $mysql_version = mysqli_get_server_info(mysqli_connect(config('database.connections.mysql.host'), config('database.connections.mysql.username'),
            config('database.connections.mysql.password')));
        $operating_system = PHP_OS;
        
        try {
            $server_software = $_SERVER['SERVER_SOFTWARE'];
        } catch (\Exception $e) {
            $server_software = 'Unknown';
        }
        
        return compact('php_version', 'mysql_version', 'operating_system', 'server_software');
    }
}