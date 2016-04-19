<?php

namespace Noah\Library\Traits\User;

trait UserMetas {
    
    /**
     * Get or set the user's meta.
     *
     * @param      $key
     * @param null $value
     * @return bool|string|object
     *
     * @author Cali
     */
    public function meta($key, $value = null)
    {
        $meta = $this->metas()->where('key', $key)->first();

        if ($value) {
            if (! $meta) {
                $meta = $this->metas()->create([
                    'key'   => $key,
                    'value' => $value
                ]);
            } else {
                $meta->value = $value;
                $meta->save();
            }
        }

        return is_null($meta) ? false : (json_decode($meta->value) ?: $meta->value);
    }

    /**
     * Helper reader method for metas.
     *
     * @param      $key
     * @param      $property
     * @param bool $default
     * @return bool
     *
     * @author Cali
     */
    public function metaReader($key, $property, $default = false)
    {
        $meta = $this->meta($key);

        if ($meta) {
            return property_exists($meta, $property) ? $meta->{$property} : $default;
        } else {
            return $default;
        }
    }
}