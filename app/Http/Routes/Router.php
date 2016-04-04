<?php

class Router {

    /*
     |------------------------------------------------------------
     | Router Wrapper Class
     | 主路由分配 类
     |------------------------------------------------------------
     |
     |
     |
     | @project Project Noah
     | @author Cali
     |
     */

    /**
     * Auth & Register Related Routes
     * 验证 & 注册相关路由
     * 
     * @return static
     * 
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
        Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm')->name('reset-password');
        Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
        Route::post('password/reset', 'Auth\PasswordController@reset');

        return new static;
    }

    /**
     * Dashboards Related Routes
     * 仪表盘相关路由
     * 
     * @return static
     * 
     * @author Cali
     */
    public static function dashboards()
    {
        Route::group(['namespace' => 'Dashboard'], function() {
            Route::get('/', 'HomeController@index')->name('home');
            Route::get('dashboard', 'HomeController@index')->name('dashboard');
        });

        return new static;
    }
}