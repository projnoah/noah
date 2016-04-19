<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => Noah\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'github' => [
        'client_id'     => env('GITHUB_ID'),
        'client_secret' => env('GITHUB_SECRET'),
        'redirect'      => env('GITHUB_REDIRECT'),
    ],

    'facebook' => [
        'client_id'     => env('FACEBOOK_ID'),
        'client_secret' => env('FACEBOOK_SECRET'),
        'redirect'      => env('FACEBOOK_REDIRECT'),
    ],

    'google' => [
        'client_id'     => env('GOOGLE_ID'),
        'client_secret' => env('GOOGLE_SECRET'),
        'redirect'      => env('GOOGLE_REDIRECT'),
    ],

    'twitter' => [
        'client_id'     => env('TWITTER_ID'),
        'client_secret' => env('TWITTER_SECRET'),
        'redirect'      => env('TWITTER_REDIRECT'),
    ],

    'disqus' => [
        'client_id'     => env('DISQUS_KEY'),
        'client_secret' => env('DISQUS_SECRET'),
        'redirect'      => env('DISQUS_REDIRECT'),
    ],

    'dribbble' => [
        'client_id'     => env('DRIBBBLE_ID'),
        'client_secret' => env('DRIBBBLE_SECRET'),
        'redirect'      => env('DRIBBBLE_REDIRECT'),
    ],

    'linkedin' => [
        'client_id'     => env('LINKEDIN_ID'),
        'client_secret' => env('LINKEDIN_SECRET'),
        'redirect'      => env('LINKEDIN_REDIRECT'),
    ],

    'qq' => [
        'client_id'     => env('QQ_ID'),
        'client_secret' => env('QQ_SECRET'),
        'redirect'      => env('QQ_REDIRECT'),
    ],

    'slack' => [
        'client_id'     => env('SLACK_ID'),
        'client_secret' => env('SLACK_SECRET'),
        'redirect'      => env('SLACK_REDIRECT'),
    ],

    'spotify' => [
        'client_id'     => env('SPOTIFY_ID'),
        'client_secret' => env('SPOTIFY_SECRET'),
        'redirect'      => env('SPOTIFY_REDIRECT'),
    ],

    'weibo' => [
        'client_id'     => env('WEIBO_ID'),
        'client_secret' => env('WEIBO_SECRET'),
        'redirect'      => env('WEIBO_REDIRECT'),
    ],
    
    'weixin' => [
        'client_id'     => env('WEIXIN_ID'),
        'client_secret' => env('WEIXIN_SECRET'),
        'redirect'      => env('WEIXIN_REDIRECT'),
    ],

    'youtube' => [
        'client_id'     => env('YOUTUBE_ID'),
        'client_secret' => env('YOUTUBE_SECRET'),
        'redirect'      => env('YOUTUBE_REDIRECT'),
    ],

    'open-weather-map' => [
        'api_key' => env('OPEN_WEATHER_MAP_KEY')
    ]
];
