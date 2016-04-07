<?php

namespace Noah\Library\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model {

    /**
     * The attributes that are mass assignable.
     * 可批量赋值的白名单
     *
     * @var array
     */
    protected $fillable = [
        "key", "value"
    ];

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
     * Call dynamic method by string.
     * 
     * @param $expression
     * @return mixed
     * 
     * @author Cali
     */
    public static function callByExpression($expression)
    {
        return static::__callStatic($expression, []);
    }
    
    /**
     * Handle dynamic method calls into the model.
     *
     * @param string $method
     * @param array  $parameters
     * @return mixed
     *
     * @author Cali
     */
    public function __call($method, $parameters)
    {
        if (in_array($method, ['increment', 'decrement'])) {
            return call_user_func_array([$this, $method], $parameters);
        }

        $query = $this->newQuery();

        if (in_array($method, get_class_methods($query))) {
            // Call its query builder
            return call_user_func_array([$query, $method], $parameters);
        }

        return $this->getConfiguration($method);
    }

    /**
     * Get configuration according to the method.
     * 
     * @param $method
     * @return string
     * 
     * @author Cali
     */
    protected function getConfiguration($method)
    {
        return static::getConfigurationByKey(
            in_array($method, $this->needPrefixKeys) ?
                snake_case($this->prefix . $method) :
                snake_case($method));
    }

}