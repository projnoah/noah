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
     * Current version.
     */
    const VERSION = "1.0.0";

    /**
     * Update base url.
     */
    const UPDATE_BASE_URL = "https://www.projnoah.com/upgrades/";

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
}