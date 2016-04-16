<?php

namespace Noah\Library\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model {

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        "key", "value"
    ];

    /**
     * The keys that need to prepend a prefix.
     * 
     * @var array
     */
    protected $needPrefixKeys = [];

    /**
     * The prefix to be prepended on $needPrefixKeys.
     * 
     * @var string
     */
    protected $prefix = '';

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
        return ($conf = static::where('key', $key)->first()) ? $conf->value : null;
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

        $method = $this->filterKey($method);

        return !!count($parameters) ?
            $this->updateOrCreate($method, $parameters) :
            $this->getConfiguration($method);
    }

    /**
     * Get the filtered key.
     *
     * @param $key
     * @return string
     *
     * @author Cali
     */
    public function filterKey($key)
    {
        return in_array($key, $this->needPrefixKeys) ?
            snake_case($this->prefix . $key) :
            snake_case($key);
    }

    /**
     * Get configuration according to the method.
     *
     * @param $key
     * @return string
     *
     * @author Cali
     */
    protected function getConfiguration($key)
    {
        return static::getConfigurationByKey($key);
    }

    /**
     * Update or create a new config by the key.
     *
     * @param $key
     * @param $values
     * @return bool|int|static
     *
     * @author Cali
     */
    public function updateOrCreate($key, $values)
    {
        $attributes = [
            'key'   => $key,
            'value' => implode(',', $values)
        ];

        return is_null(static::where('key', $key)->first()) ?
            static::create($attributes) :
            static::where('key', $key)
                ->update($attributes);
    }
}