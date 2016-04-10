var elixir = require('laravel-elixir');
// elixir.config.sourcemaps = false;

require('laravel-elixir-vueify');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {

    /*
     |------------------------------------------------------------
     | Main App Assets
     |------------------------------------------------------------
     |
     | @project Project Noah
     | @author Cali
     |
     */
    mix.sass(['app.scss'], 'public/assets/css/app.css')
        .scripts([
            'jquery/jquery.min.js',
            'classie.js',
            'pusher.min.js',
            'jquery/icheck.min.js',
            'notification/notification.custom.js',
            'notification/notificationFx.js',
            'vendor/uiProgressButton.js',
            'vendor/dialogFx.js',
            'vendor/sweetalert.min.js',
            'vendor/TweenMax.min.js',
        ], 'resources/assets/js/builds/app.js')
        .browserify([
            'helpers.js',
            'listeners.js'
        ], 'resources/assets/js/builds/helpers.js')
        .scripts([
            'builds/app.js',
            'builds/helpers.js'
        ], 'public/assets/js/app.js');

    /*
     |------------------------------------------------------------
     | Login Page Assets
     |------------------------------------------------------------
     |
     | @project Project Noah
     | @author Cali
     |
     */
    mix.sass(['pages/login.scss'], 'public/assets/css/pages/login.css')
        .browserify(
            'pages/login.js', 'public/assets/js/pages/login.js'
        );

    /*
     |------------------------------------------------------------
     | Social Auth Assets
     |------------------------------------------------------------
     |
     | @project Project Noah
     | @author Cali
     |
     */
    mix.sass(['pages/social.scss'], 'public/assets/css/pages/social.css')
        .scripts([
            'vendor/stepsForm.js',
            'pages/social.js'
        ], 'public/assets/js/pages/social.js');

    /*
     |------------------------------------------------------------
     | Dashboard Assets
     |------------------------------------------------------------
     |
     | @project Project Noah
     | @author Cali
     |
     */
    mix.browserify([
        'vendor/jquery.waypoints.min.js',
        'vendor/waypoints/infinite.min.js',
        'vendor/waypoints/sticky.min.js',
        'vendor/waypoints/inview.min.js',
        'pages/dashboard.js',
    ], 'public/assets/js/pages/dashboard.js');
    
    //mix.version();
});
