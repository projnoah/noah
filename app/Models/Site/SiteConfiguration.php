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

        static::massiveUpdate($request->except(['_token', 'site_keywords']));
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
}