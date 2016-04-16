<?php

namespace Noah;

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
        // TODO: Dynamic
        return url('favicon.png');
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
        env_put('MAIL_USERNAME', $request->input('admin_email'));
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
        if (($on = $request->input('auto_locale', 'no') == 'on' ? 1 : 0) != site('autoLocale'))
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
        if (($on = $request->input('force_ssl', 'no') == 'on' ? 1 : 0) != site('forceSsl'))
            static::forceSsl($on);
        if (($on = $request->input('powered_by', 'no') == 'on' ? 1 : 0) != site('poweredBy'))
            static::poweredBy($on);
        
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
}