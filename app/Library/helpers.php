<?php

/**
 * Invalid database username or password, access denied.
 */
const DATABASE_ACCESS_DENIED = 1045;

/**
 * Database not found.
 */
const DATABASE_NOT_FOUND = 1049;

/**
 * Connection refused.
 */
const CONNECTION_REFUSED = 2002;

/**
 * Environment file not found.
 */
const ENV_NOT_FOUND = - 1;

/**
 * Environment file is not writable.
 */
const ENV_DENIED = - 2;

/**
 * Environment file updated.
 */
const ENV_UPDATED = 1;

if (! function_exists('noah_installed')) {
    /**
     * Determine if Noah is installed.
     *
     * @since 1.0.0
     *
     * @return bool
     * @author Cali
     */
    function noah_installed()
    {
        return file_exists(base_path('noah.lock'));
    }
}

if (! function_exists('env_put')) {
    /**
     * Store or update an environment variable.
     *
     * @since 1.0.0
     *
     * @param      $key
     * @param      $value
     * @param bool $new_line
     * @return int
     *
     * @author Cali
     */
    function env_put($key, $value, $new_line = false)
    {
        $path = base_path('.env');
        $key = strtoupper($key);

        if (str_contains($value, " ")) {
            $value = str_replace(" ", "-", $value);
        }

        if (file_exists($path)) {
            $content = $new_line ? "\n\r$key=$value" : "\n$key=$value";

            if (! env($key)) {
                try {
                    file_put_contents($path, $content, FILE_APPEND);
                } catch (Exception $e) {
                    return ENV_DENIED;
                }
            } else {
                $content = str_replace($new_line ? "\n\r" : "\n", "", $content);

                try {
                    file_put_contents($path,
                        str_replace("$key=" . env($key), $content, file_get_contents($path))
                    );
                } catch (Exception $e) {
                    return ENV_DENIED;
                }
            }

            return ENV_UPDATED;
        }

        return ENV_NOT_FOUND;
    }
}

if (! function_exists('site')) {
    /**
     * Helper for getting the site configuration.
     *
     * @since 1.0.0
     *
     * @param $name
     * @return string|null
     *
     * @author Cali
     */
    function site($name)
    {
        $site = app('Site');

        return call_user_func_array([$site, $name], []);
    }
}