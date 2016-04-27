<?php

namespace Noah\Library\Traits\Controller;

use Storage;

trait ImageResponse {

    /**
     * Sends the image response.
     *
     * @param      $path
     * @param bool $storage
     * @return mixed
     *
     * @author Cali
     */
    protected function imageResponse($path, $storage = true)
    {
        return response($storage ? Storage::get($path) :
            file_get_contents(public_path($path)), 200, [
            'Content-type'                => 'image',
            'Access-Control-Allow-Origin' => request()->secure() ? 'https://' : 'http://' . root_domain()
        ]);
    }
}