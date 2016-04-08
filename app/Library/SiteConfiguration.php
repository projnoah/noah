<?php

namespace Noah\Library;

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
     * Get the title suffix in views
     * 获取视图中的标题后缀
     *
     * @return string
     * 
     * @author Cali
     */
    public static function title()
    {
        return static::separator() . " " . static::siteTitle();
    }
    
    /**
     * Get the site logo.
     *
     * @return string
     * 
     * @author Cali
     */
    public static function logo()
    {
        // TODO: Dynamic
        return url('favicon.png');
    }
}
