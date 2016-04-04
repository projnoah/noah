var elixir = require('laravel-elixir');

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

elixir(function(mix) {

    // === Public app ===
    mix.sass([
        'app.scss'
    ], 'public/assets/css/build-app.css');

    // === Login page ===
    mix.sass([
        'login.scss'
    ], 'public/assets/css/pages/login.css');

    // === JS mixes ===
    mix.scripts([
        'jquery/jquery.min.js',
        'classie.js',
        'jquery/icheck.min.js',
        'notification/notification.custom.js',
        'notification/notificationFx.js',
        'uiProgressButton.js',
        'dialogFx.js'
    ], 'public/assets/js/app.js');
    
    mix.browserify('pages/login.js', 'public/assets/js/pages/login.js');

    //mix.version();
});
