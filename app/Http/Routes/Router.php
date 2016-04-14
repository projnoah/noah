<?php

class Router {

    /*
     |------------------------------------------------------------
     | Router Wrapper Class
     | 主路由分配 类
     |------------------------------------------------------------
     |
     | @project Project Noah
     | @author Cali
     |
     */

    /**
     * Auth & Register Related Routes.
     * 验证 & 注册相关路由
     *
     * @return static
     * @author Cali
     */
    public static function auth()
    {
        // Authentication Routes...
        Route::get('login', 'Auth\AuthController@showLoginForm')->name('sign-in');
        Route::post('login', 'Auth\AuthController@login');
        Route::get('logout', 'Auth\AuthController@logout')->name('exit');

        // Registration Routes...
        Route::get('register', 'Auth\AuthController@showRegistrationForm')->name('sign-up');
        Route::post('register', 'Auth\AuthController@register');

        // Password Reset Routes...
        Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm')->name('reset');
        Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail')->name('reset-password');
        Route::post('password/reset', 'Auth\PasswordController@reset');

        // Email Confirmation...
        Route::get('auth/confirm', 'Auth\AuthController@confirmRegistration')->name('confirm-email');

        // Third Party Authentications...
        Route::get('auth/{service}/callback', 'Auth\AuthController@callback');
        Route::get('auth/{service}', 'Auth\AuthController@socialLogin')->name('social');
        Route::post('auth', 'Auth\AuthController@connect')->name('social-connect');

        return new static;
    }

    /**
     * Dashboards Related Routes.
     * 仪表盘相关路由
     *
     * @return static
     * @author Cali
     */
    public static function dashboards()
    {
        Route::group(['namespace' => 'Dashboard'], function () {
            Route::get('/', 'HomeController@home')->name('home');
            Route::get('dashboard', 'HomeController@home')->name('dashboard');
            Route::get('inbox', 'HomeController@inbox')->name('inbox');
            Route::get('search/{keyword?}', 'HomeController@search')->name('search');
        });


//        Route::get('test', function () {
//            return view('auth.emails.password', ['user' => Noah\User::first(), 'token' => 'safjl12asf']);
//        });

        return new static;
    }

    /**
     * Installation Routes.
     * 站点安装相关路由
     *
     * @return static
     * @author Cali
     */
    public static function installations()
    {
        if (! noah_installed()) {
            Route::group(['prefix' => 'install'], function () {
                Route::get('step/{step?}', 'InstallationController@install');
                Route::post('step/{step}', 'InstallationController@postInstall')->name('install');
                Route::get('done', 'InstallationController@done')->name('install-done');
            });
        }

        return new static;
    }

    /**
     * Language Routes.
     * 语言切换路由
     *
     * @return static
     * @author Cali
     */
    public static function language()
    {
        Route::get('language/{language}', function ($language) {
            return redirect()->back()
                ->withCookie(cookie()->forever('lang', $language));
        });

        return new static;
    }

    /**
     * Admin Routes.
     * 后台管理路由
     *
     * @return static
     * @author Cali
     */
    public static function admins()
    {
        Route::group([
            'prefix'     => 'admin',
            'namespace'  => 'Admin',
            'as'         => 'admin.',
            'middleware' => ['auth', 'role:administrator'],
        ], function () {
            Route::get('/', 'ManageController@showDashboard')->name('dashboard');
            Route::patch('save/settings', 'ManageController@changeSetting')->name('change-settings');
            Route::patch('save/settings/color', 'ManageController@changeThemeColor')->name('change-theme-color');

            // Users management.
            Route::group([
                'prefix'    => 'users',
                'as'        => 'users.'
            ], function () {
                Route::get('/', 'UsersController@showIndex')->name('index');
            });
            
            // Site settings.
            Route::group([
                'prefix'    => 'settings',
                'as'        => 'settings.'
            ], function () {
                Route::get('/', 'SettingsController@showGeneralSetting')->name('general');
                Route::get('services', 'SettingsController@showServicesSetting')->name('services');
            });
        });

        return new static;
    }
}