<?php

namespace Noah;

use Artisan;
use Illuminate\Http\Request;
use Noah\Library\Models\Configuration;

class SiteConfiguration extends Configuration {

    /*
    |------------------------------------------------------------
    | SiteConfiguration Model Class
    | 站点设置 模型类
    |------------------------------------------------------------
    |
    | @project Project Noah
    | @author Cali
    |
    */

    /**
     * The keys that need to prepend a prefix.
     *
     * @var array
     */
    protected $needPrefixKeys = [
        "url", "title", "description", "separator", "keywords"
    ];

    /**
     * The prefix to be prepended on $needPrefixKeys.
     *
     * @var string
     */
    protected $prefix = 'site_';

    /**
     * Get the title suffix in views.
     * 获取视图中的标题后缀
     *
     * @return string
     * @author Cali
     */
    public static function title()
    {
        return static::separator() . " " . static::siteTitle();
    }

    /**
     * Get the admin title suffix in admin views.
     * 获取后台管理标题后缀
     *
     * @return string
     * @author Cali
     */
    public static function adminTitle()
    {
        return static::separator() . " " . trans('views.admin.main-title') . " " . static::title();
    }

    /**
     * Get the site logo.
     *
     * @return string
     * @author Cali
     */
    public static function logo()
    {
        return url('assets/logo.png?ver=' . static::logoVersion() ?: '0');
    }

    /**
     * Update general basics settings.
     *
     * @param Request $request
     * @author Cali
     */
    public static function saveGeneralBasicsSettings(Request $request)
    {
        if ((! ! site('registrationOn')) ^ $on = ($request->input('registration') === 'yes')) {
            static::registrationOn($on ? '1' : '0');
        }

        static::massiveUpdate($request->except(['_token', 'registration']));
        env_put('ADMIN_EMAIL', $request->input('admin_email'));
    }

    /**
     * Update general seo settings.
     *
     * @param Request $request
     * @author Cali
     */
    public static function saveGeneralSeoSettings(Request $request)
    {
        if (($keywords = implode(',', $request->input('site_keywords'))) != site('keywords')) {
            static::keywords($keywords);
        }
        if (($ignoreUris = implode(',', $request->input('site_robot_ignores'))) != site('siteRobotIgnores')) {
            static::siteRobotIgnores($ignoreUris);
        }

        static::massiveUpdate($request->only(['site_separator', 'site_description']));
    }

    /**
     * Update general region settings.
     *
     * @param Request $request
     * @author Cali
     */
    public static function saveGeneralRegionSettings(Request $request)
    {
        if (($timezone = $request->input('timezone')) != env('TIMEZONE'))
            env_put('TIMEZONE', $timezone);
        if (($locale = $request->input('locale')) !== app()->getLocale())
            env_put('LOCALE', $locale);
        if (($on = $request->input('auto_locale', 'no') == 'on' ? '1' : '0') !== site('autoLocale'))
            static::autoLocale($on);
    }

    /**
     * Update general extra settings.
     *
     * @param Request $request
     * @author Cali
     */
    public static function saveGeneralExtraSettings(Request $request)
    {
        if (($sslOn = $request->input('force_ssl', 'no') == 'on' ? '1' : '0') !== site('forceSsl'))
            static::forceSsl($sslOn);
        if (($powerOn = $request->input('powered_by', 'no') == 'on' ? '1' : '0') !== site('poweredBy'))
            static::poweredBy($powerOn);

        static::massiveUpdate($request->only('icp'));
    }

    /**
     * Assign massive attributes at the same time.
     *
     * @param array $attributes
     * @author Cali
     */
    public static function massiveUpdate(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            if ($value !== site(camel_case($key))) {
                static::__callStatic(camel_case($key), [$value]);
            }
        }
    }

    /**
     * Save oAuth settings.
     * 
     * @param         $service
     * @param Request $request
     * @author Cali
     */
    public static function saveServicesOAuthSettings($service, Request $request)
    {
        if (($on = $request->input('on', 'off') == 'on' ? 1 : 0) != site("{$service}On")) {
            static::__callStatic("{$service}On", [$on]);
        }
        
        $service = strtoupper($service);
        
        env_put("{$service}_ID", trim($request->input('app_id')), true);
        env_put("{$service}_SECRET", trim($request->input('app_secret')));
        env_put("{$service}_REDIRECT", trim($request->input('redirect')));
    }

    /**
     * Save email settings.
     * 
     * @param Request $request
     * @author Cali
     */
    public static function saveServicesEmailSettings(Request $request)
    {
        $attributes = $request->except(['_token', 'on']);
        
        if (($on = $request->input('on', 'off') == 'on' ? 1 : 0) != site('smtpEmailOn')) {
            static::__callStatic("smtpEmailOn", [$on]);
        }

        foreach ($attributes as $attribute => $value) {
            env_put(strtoupper($attribute), trim($value));
        }
    }

    /**
     * Save pusher settings.
     *
     * @param Request $request
     * @author Cali
     */
    public static function saveServicesPushSettings(Request $request)
    {
        if (($on = $request->input('on', 'off') == 'on' ? 1 : 0) != site('pusherOn')) {
            static::__callStatic("pusherOn", [$on]);
        }
        
        env_put("PUSHER_APP_ID", trim($request->input('app_id')), true);
        env_put("PUSHER_KEY", trim($request->input('key')));
        env_put("PUSHER_SECRET", trim($request->input('secret')));
    }

    /**
     * Save storage type settings.
     * 
     * @param Request $request
     * @author Cali
     */
    public static function saveServicesStorageSettings(Request $request)
    {
        if (in_array($request->input('type'), array_keys(config('filesystems.disks'))) && 
            ($type = trim($request->input('type'))) != env('DISK_TYPE', 'local')) {
            env_put('DISK_TYPE', $type);
        }
    }

    /**
     * Save disk credentials.
     *
     * @param         $disk
     * @param Request $request
     *
     * @author Cali
     */
    public static function saveServicesDiskSettings($disk, Request $request)
    {
        $attributes = $request->except('_token');
        
        foreach ($attributes as $key => $value) {
            if (trim($value) != '') {
                env_put(str_contains($key, $disk) ? strtoupper($key) : strtoupper("{$disk}_{$key}"), trim($value));
            }
        }
    }

    /**
     * Save develop settings.
     * 
     * @param Request $request
     * @author Cali
     */
    public static function saveAdvancedDevelopSettings(Request $request)
    {
        if (($env = $request->input('environment', 'local')) != config('app.env')) {
            env_put('APP_ENV', $env);
        }

        $debug = $request->input('debug', 'off') == 'on' ? 'true' : 'false';
        env_put('APP_DEBUG', strval($debug));

        if (($ignores = $request->input('ignores_admin', 'off') == 'on' ? 1 : 0) != site('adminIgnoresMaintenance')) {
            static::adminIgnoresMaintenance($ignores);
        }

        if (($on = $request->input('maintenance', 'off') === 'on') ^ app()->isDownForMaintenance()) {
            Artisan::call($on ? 'down' : 'up');
        }
    }

    /**
     * Cache by different type.
     * 
     * @param        $type
     * @param string $action
     * 
     * @author Cali
     */
    public static function doCacheByType($type, $action = 'refresh')
    {
        switch ($type) {
            case 'main-cache':
                Artisan::call($action === 'refresh' ? 'config:cache' : 'config:clear');
                if ($action !== 'refresh') {
                    Artisan::call('cache:clear');
                }
                break;
            case 'route-cache':
                Artisan::call($action === 'refresh' ? 'route:cache' : 'route:clear');
                break;
            default:
                Artisan::call('view:clear');
                break;
        }
    }

    /**
     * Save sub domains settings.
     *
     * @param Request $request
     * @author Cali
     */
    public static function saveSubDomainsSettings(Request $request)
    {
        if (($subOn = $request->input('avatar_sub_domains_switch', 'off') == 'on' ? 1 : 0) != site('avatarsSubDomain')) {
            static::avatarsSubDomain($subOn);
        }
        if (($userSubOn = $request->input('user_sub_domains_switch', 'off') == 'on' ? 1 : 0) != site('usersSubDomain')) {
            static::usersSubDomain($userSubOn);
        }
        if (($exclusions = implode(',', $request->input('sub_domain_name_exclusions'))) != site('subDomainNameExclusions')) {
            static::subDomainNameExclusions($exclusions);
        }
        
        static::massiveUpdate($request->only('avatar_domain_name'));
    }

    /**
     * Initial setup for migration.
     * 
     * @author Cali
     */
    public static function initialSetup()
    {
        static::homeUri('home');
        static::socialUri('dashboard');
        static::postUri('posts');
        static::adminUri('admin');
        static::siteTitle("Project Noah");
        static::description("优雅, 现代, 简洁与全能. 服务于快速建网站的站长.");
        static::separator("::");
        static::keywords("modern", "noah", "project noah");
        static::siteRobotIgnores("admin");
        static::adminIgnoresMaintenance("1");
        static::adminEmail(env('ADMIN_EMAIL'));
        static::registrationOn("1");
        static::smtpEmailOn("0");
        static::forceSsl("0");
        static::subDomainNameExclusions("avatars");
    }
}