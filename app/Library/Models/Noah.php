<?php

namespace Noah\Library\Models;

use File;
use Cache;
use Artisan;
use Carbon\Carbon;
use GuzzleHttp\Client;

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
    const UPGRADE_BASE_URL = "https://upgrade.projnoah.com/archives/";

    /**
     * Noah query url for fetching updates.
     */
    const UPGRADE_QUERY_URL = "https://upgrade.projnoah.com/api/version";

    /**
     * Upgrade Noah to the latest version.
     *
     * @since 0.1.0
     *
     * @author Cali
     */
    public static function upgrade()
    {
        static::log('');

        $file_path = 'v' . self::getNewVersion() . '.zip';
        $file_url = self::UPGRADE_BASE_URL . $file_path;

        self::checkDirectory();

        // Open maintenance mode
        self::maintenanceMode();

        try {
            self::fetchZip($file_url, $file_path);
            self::unzipFile($file_path);
        } catch (\Exception $e) {
            // TODO: Something went wrong...
            return $e->getMessage();
        }

        // Post-upgrade actions
        self::dumpAutoload();
        self::migrateDatabase();

        Cache::forget('new_version');

        // Bring up the app
        self::maintenanceMode(false);

        static::log(trans('views.upgrades.complete'));
        static::log('=========== UPGRADE_COMPLETE ===========');
    }

    /**
     * Get the new version string.
     *
     * @return string
     */
    public static function getNewVersion()
    {
        if (! Cache::has('new_version')) {
            $client = new Client;
            $response = $client->get(self::UPGRADE_QUERY_URL);
            $version = json_decode($response->getBody()->getContents());

            if ($version->version != self::VERSION) {
                Cache::put('new_version', $version->version, Carbon::now()->addDays(2));
            } else {
                Cache::put('new_version', $version->version, 10);
            }

            return $version->version;
        } else {
            return Cache::get('new_version', self::VERSION);
        }
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
     * Get upgrade base url.
     *
     * @return string
     * @author Cali
     */
    public static function getUpgradeQueryUrl()
    {
        return static::UPGRADE_QUERY_URL;
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
     * Dump autoload in and generate class loader.
     *
     * @author Cali
     */
    private static function dumpAutoload()
    {
        Artisan::call('config:clear');
        Artisan::call('clear-compiled');
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('optimize');

        static::log(trans('views.upgrades.optimize'));
    }

    /**
     * Migrate the database changes.
     *
     * @author Cali
     */
    private static function migrateDatabase()
    {
        static::log(trans('views.upgrades.migrate'));

        Artisan::call('migrate', ['--force' => true]);
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
     * Get the currently supported oAuth applications.
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
     * Currently active oAuth applications.
     *
     * @return mixed
     * @author Cali
     */
    public static function activeOAuths()
    {
        $actives = collect([]);

        foreach (static::supportedOAuths() as $service) {
            if (site($service . 'On') == '1')
                $actives->push($service);
        }

        return $actives;
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
        $noah_installed_time = Carbon::parse(str_replace('Installed at ', '', File::get(base_path('noah.lock'))));

        try {
            $server_software = $_SERVER['SERVER_SOFTWARE'];
        } catch (\Exception $e) {
            $server_software = 'Unknown';
        }

        return compact('php_version', 'mysql_version', 'operating_system', 'server_software', 'noah_installed_time');
    }

    /**
     * Unzip a file.
     *
     * @param $file_path
     * @author Cali
     */
    public static function unzipFile($file_path)
    {
        static::log(trans('views.upgrades.unzip'));

        $zip = new \ZipArchive;
        if ($zip->open(public_path('upgrades/' . $file_path)) === true) {
            $zip->extractTo(base_path());
            $zip->close();
        }
    }

    /**
     * Fetch the zip file.
     *
     * @param $file_url
     * @param $file_path
     *
     * @author Cali
     */
    public static function fetchZip($file_url, $file_path)
    {
        static::log(trans('views.upgrades.fetch-zip.fetching'));

        $stream = fopen(public_path('upgrades/' . $file_path), 'w');

        $curl = static::prepareCurl($file_url);
        curl_setopt($curl, CURLOPT_FILE, $stream);
        curl_exec($curl);

        curl_close($curl);
        fclose($stream);

        static::log(trans('views.upgrades.fetch-zip.done'));
    }

    /**
     * Prepare curl connection.
     *
     * @param $url
     * @return mixed
     *
     * @author Cali
     */
    public static function prepareCurl($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 3600);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

        return $curl;
    }

    /**
     * Log the message into file.
     *
     * @param $message
     * @author Cali
     */
    public static function log($message = null)
    {
        $path = storage_path('logs/upgrade.log');

        if (is_null($message)) {
            $fp = fopen($path, 'r');
            fseek($fp, - 1, SEEK_END);
            $s = '';

            while (($c = fgetc($fp)) !== false) {
                if ($c == PHP_EOL && $s) break;
                $s = $c . $s;
                fseek($fp, - 2, SEEK_CUR);
            }
            fclose($fp);

            return $s;
        } else {
            if (! File::exists($path)) {
                File::put($path, '# ' . $message . PHP_EOL);
            } else {
                File::append($path, '# ' . $message . PHP_EOL);
            }
        }
    }

    /**
     * Open/close maintenance mode.
     *
     * @param bool $open
     * @author Cali
     */
    public static function maintenanceMode($open = true)
    {
        Artisan::call($open ? 'down' : 'up');
        static::log(trans('views.upgrades.maintenance.' . ($open ? 'down' : 'up')));
    }
}