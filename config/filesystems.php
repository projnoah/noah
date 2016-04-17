<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. A "local" driver, as well as a variety of cloud
    | based drivers are available for your choosing. Just store away!
    |
    | Supported: "local", "ftp", "s3", "rackspace", "qiniu"
    |
    */

    'default' => env('DISK_TYPE', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => 's3',

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root'   => storage_path('app'),
        ],

        'ftp' => [
            'driver'   => 'ftp',
            'host'     => env('FTP_HOST', 'ftp.example.com'),
            'username' => env('FTP_USERNAME', 'your-username'),
            'password' => env('FTP_PASSWORD'),

            // Optional FTP Settings...
            // 'port'     => 21,
            // 'root'     => '',
            // 'passive'  => true,
            // 'ssl'      => true,
            // 'timeout'  => 30,
        ],

        's3' => [
            'driver' => 's3',
            'key'    => env('S3_KEY'),
            'secret' => env('S3_SECRET'),
            'region' => env('S3_REGION'),
            'bucket' => env('S3_BUCKET'),
        ],

        'rackspace' => [
            'driver'    => 'rackspace',
            'username'  => env('RACKSPACE_USERNAME'),
            'key'       => env('RACKSPACE_KEY'),
            'container' => env('RACKSPACE_CONTAINER'),
            'endpoint'  => env('RACKSPACE_ENDPOINT', 'https://identity.api.rackspacecloud.com/v2.0/'),
            'region'    => env('RACKSPACE_REGION', 'IAD'),
            'url_type'  => env('RACKSPACE_URL_TYPE', 'publicURL'),
        ],

        'qiniu' => [
            'driver'     => 'qiniu',
            'domains'    => [
                'default' => env('QINIU_DEFAULT', 'xxxxx.com1.z0.glb.clouddn.com'),
                'https'   => env('QINIU_HTTPS', 'dn-yourdomain.qbox.me'),
                'custom'  => env('QINIU_CUSTOM', 'static.abc.com'),
            ],
            'access_key' => env('QINIU_ACCESS_KEY'),
            'secret_key' => env('QINIU_SECRET_KEY'),
            'bucket'     => env('QINIU_BUCKET'),
            'notify_url' => env('QINIU_NOTIFY_URL'),
        ],
    ],

];
