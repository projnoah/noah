<?php

namespace Noah;

use Illuminate\Database\Eloquent\Model;

class SiteConfiguration extends Model {

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
     * The attributes that are mass assignable.
     * 可批量赋值的白名单
     *
     * @var array
     *
     * @author Cali
     */
    protected $fillable = [
        "key", "value"
    ];

    /**
     * Get configuration value by the given key
     * 根据制定键获取值
     *
     * @param $key
     * @return string
     *
     * @author Cali
     */
    public static function getConfigurationByKey($key)
    {
        return static::where('key', $key)->first()->value;
    }

    /**
     * Get the title suffix in views
     * 获取视图中的标题后缀
     *
     * @return string
     *
     * @author Cali
     */
    public static function title()
    {
        return static::siteSeparator() . " " . static::siteTitle();
    }

    /**
     * Get the description of the site / SEO
     * 获取站点介绍
     *
     * @return string
     *
     * @author Cali
     */
    public static function description()
    {
        return static::getConfigurationByKey("site_description");
    }

    /**
     * Get the keywords of the site / SEO
     * 获取站点关键字
     *
     * @return string
     *
     * @author Cali
     */
    public static function keywords()
    {
        return static::getConfigurationByKey("site_keywords");
    }

    /**
     * Get the site title separator
     * 获取站点标题分隔符
     *
     * @return string
     *
     * @author Cali
     */
    public static function siteSeparator()
    {
        return static::getConfigurationByKey("site_separator");
    }

    /**
     * Get the site title
     * 获取站点名称
     *
     * @return string
     *
     * @author Cali
     */
    public static function siteTitle()
    {
        return static::getConfigurationByKey("site_title");
    }
}
