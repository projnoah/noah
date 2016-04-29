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
     * @since 0.1.0
     *
     * @return bool
     * @author Cali
     */
    function noah_installed()
    {
        return file_exists(base_path('noah.lock'));
    }
}

if (! function_exists('noah_version')) {
    /**
     * Get the Noah version.
     * 
     * @since 0.1.0
     * 
     * @return string
     * @author Cali
     */
    function noah_version()
    {
        return Noah\Library\Models\Noah::VERSION;
    }
}

if (! function_exists('env_put')) {
    /**
     * Store or update an environment variable.
     *
     * @since 0.1.0
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
            $content = $new_line ? "\n\r{$key}={$value}" : "\n{$key}={$value}";

            if (is_null(env($key))) {
                try {
                    file_put_contents($path, $content, FILE_APPEND);
                } catch (Exception $e) {
                    return ENV_DENIED;
                }
            } else {
                $content = str_replace($new_line ? "\n\r" : "\n", "", $content);

                $v = env($key);
                if (is_bool($v)) {
                    $v = strval($v ? 'true' : 'false');
                }

                try {
                    file_put_contents($path,
                        str_replace("{$key}={$v}", $content, file_get_contents($path))
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
     * @since 0.1.0
     *
     * @param $name
     * @return string|null|bool
     *
     * @author Cali
     */
    function site($name)
    {
        if (! noah_installed())
            return false;

        $site = app('Site');

        return call_user_func_array([$site, $name], []);
    }
}

if (! function_exists('resize_avatar')) {
    /**
     * Resize avatar by the given path.
     *
     * @since 0.1.0
     * 
     * @param $path
     * @return bool
     *
     * @author Cali
     */
    function resize_avatar($path, $width, $height, $x, $y)
    {
        switch (getimagesize($path)['mime']) {
            case 'image/gif':
                $source_image = imagecreatefromgif($path);
                break;
            case 'image/jpeg':
                $source_image = imagecreatefromjpeg($path);
                break;
            case 'image/png':
                $source_image = imagecreatefrompng($path);
                break;
        }

        $cropped_image = imagecreatetruecolor($width, $height);
        imagecopy($cropped_image, $source_image, 0, 0,
            $x, $y, $width, $height);

        $resized_avatar = imagejpeg($cropped_image, $path);

        imagedestroy($source_image);
        imagedestroy($cropped_image);

        return $resized_avatar;
    }
}

if (! function_exists('root_domain')) {
    /**
     * Get the root domain of the url.
     *
     * @since 0.1.0
     * 
     * @param $url
     * @return string
     *
     * @author Cali
     */
    function root_domain($url = null)
    {
        $url = $url ?: config('app.url');
        if (preg_match('%[^:\.\/]+(?:(?<ext>\.(?:com|net|org|edu|gov|biz|tv|me|pro|name|cc|co|info|cm|dev))|(?<ctr>\.(?:cn|us|hk|tw|uk|it|fr|br|in|de))|\k<ext>\k<ctr>)+$%i', $url, $match)) {
            return $match[0];
        }

        return $url;
    }
}