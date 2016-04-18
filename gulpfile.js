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
     | Install Page Assets
     |------------------------------------------------------------
     |
     | @project Project Noah
     | @author Cali
     |
     */
    mix.styles([
            'static/normalize.css',
            'pages/installation/install.css'
        ], 'public/assets/css/pages/install.css')
        .scripts([
            'classie.js',
            'vendor/fullscreenForm.js'
        ], 'public/assets/js/pages/install.js');

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
        .browserify([
            'vendor/stepsForm.js',
            'pages/social.js',
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

    /*
     |------------------------------------------------------------
     | Admin App Assets
     |------------------------------------------------------------
     |
     | @project Project Noah
     | @author Cali
     |
     */
    mix.sass([
        'pages/admin/dashboard.scss'
    ], 'resources/assets/css/builds/pages/admin/dashboard.css').styles([
            'admin/vendor/pace-theme-flash.css',
            'admin/vendor/uniform.default.min.css',
            'static/bootstrap.min.css',
            'admin/vendor/simple-line-icons.css',
            'admin/vendor/menu_cornerbox.css',
            'admin/vendor/waves.min.css',
            'admin/vendor/switchery.min.css',
            'admin/vendor/3d-bold-navigation.style.css',
            'admin/vendor/component.css',
            'admin/vendor/select2.min.css',
            'admin/vendor/weather-icons.min.css',
            'admin/vendor/jquery.datatables.min.css',
            'admin/vendor/MetroJs.min.css',
            'admin/vendor/toastr.min.css',
            'UI/dropzone.min.css',
            'admin/modern.css',
            'builds/pages/admin/dashboard.css'
        ], 'public/assets/css/admin/app.css')
        .browserify([
            'admin/app.js',
        ], 'resources/assets/js/builds/admin/app.js')
        .scripts([
            'jquery/jquery.min.js',
            'jquery/jquery.pjax.js',
            'jquery/jquery-ui.js',
            'admin/vendor/pace.min.js',
            'jquery/jquery.blockui.js',
            'vendor/bootstrap.js',
            'jquery/jquery.slimscroll.min.js',
            'admin/vendor/switchery.js',
            'jquery/jquery.uniform.min.js',
            'classie.js',
            'admin/vendor/off-canvas-menu.main.js',
            'admin/vendor/waves.js',
            'admin/vendor/3d-bold-navigation.main.js',
            'vendor/jquery.waypoints.min.js',
            'jquery/jquery.counterup.js',
            'admin/vendor/toastr.min.js',
            'vendor/select2.min.js',
            'jquery/flot/jquery.flot.min.js',
            'jquery/flot/jquery.flot.time.min.js',
            'jquery/flot/jquery.flot.symbol.min.js',
            'jquery/flot/jquery.flot.resize.min.js',
            'jquery/flot/jquery.flot.tooltip.min.js',
            'jquery/ajaxfileupload.js',
            'jquery/jquery.datatables.min.js',
            'admin/vendor/MetroJs.min.js',
            'admin/vendor/curvedLines.js',
            'admin/modern.js',
            'builds/admin/app.js',
        ], 'public/assets/js/admin/app.js');

    mix.browserify([
        'admin/pages/profile-users.js'    
    ], 'public/assets/js/admin/pages/profile-users.js');
    
    mix.browserify([
            'admin/pages/dashboard.js',
        ], 'public/assets/js/admin/pages/dashboard.js')
        .browserify([
            'admin/pages/general-settings.js'
        ], 'public/assets/js/admin/pages/general-settings.js')
        .browserify([
            'vendor/TweenMax.min.js',
            'admin/pages/services-settings.js',
        ], 'public/assets/js/admin/pages/services-settings.js')
        .browserify([
            'admin/pages/advanced-settings.js'
        ], 'public/assets/js/admin/pages/advanced-settings.js')
        .browserify([
            'admin/pages/cache-settings.js'
        ], 'public/assets/js/admin/pages/cache-settings.js')
        .browserify([
            'admin/pages/database-settings.js'
        ], 'public/assets/js/admin/pages/database-settings.js')
        .browserify([
            'admin/pages/display-settings.js'
        ], 'public/assets/js/admin/pages/display-settings.js');
    
    //mix.version();
});
