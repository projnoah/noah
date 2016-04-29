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

        // Password Reset Routes...
        Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm')->name('reset');
        Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail')->name('reset-password');
        Route::post('password/reset', 'Auth\PasswordController@reset');

        // Email Confirmation...
        Route::get('auth/confirm', 'Auth\AuthController@confirmRegistration')->name('confirm-email');

        if (noah_installed() && ! ! site('registrationOn')) {
            // Registration Routes...
            Route::get('register', 'Auth\AuthController@showRegistrationForm')->name('sign-up');
            Route::post('register', 'Auth\AuthController@register');

            // Third Party Authentications...
            Route::get('auth/{service}', 'Auth\AuthController@socialLogin')->name('social');
            Route::post('auth', 'Auth\AuthController@connect')->name('social-connect');
        }
        Route::get('auth/{service}/callback', 'Auth\AuthController@callback')->name('social-callback');

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
        Route::group(['namespace' => 'Dashboard',], function () {
            Route::get('/', 'HomeController@home')->name('home');
            Route::get('dashboard', 'HomeController@home')->name('dashboard');
            Route::get('inbox', 'HomeController@inbox')->name('inbox');
            Route::get('search/{keyword?}', 'HomeController@search')->name('search');
        });

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
        Route::group(['prefix' => 'install'], function () {
            Route::get('step/{step?}', 'InstallationController@install');
            Route::post('step/{step}', 'InstallationController@postInstall')->name('install');
            Route::get('done', 'InstallationController@done')->name('install-done');
        });

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
        Route::get('language/{language}', 'Dashboard\HomeController@changeLanguage');

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
            'prefix'     => site('adminUri') ?: 'admin',
            'namespace'  => 'Admin',
            'as'         => 'admin.',
            'middleware' => ['auth', 'role:administrator'],
        ], function () {
            Route::get('/', 'ManageController@showDashboard')->name('dashboard');
            Route::patch('save/settings', 'ManageController@changeSetting')->name('change-settings');
            Route::patch('save/settings/color', 'ManageController@changeThemeColor')->name('change-theme-color');

            // Users management.
            Route::group([
                'prefix' => 'users',
                'as'     => 'users.'
            ], function () {
                Route::get('/', 'UsersController@showIndex')->name('index');
                Route::get('search/{keyword}', 'UsersController@searchUsers')->name('search');
                Route::get('invitations', 'UsersController@showInvitations')->name('invitations');
                Route::delete('{user?}', 'UsersController@deleteUser')->name('delete');
                Route::patch('bulk', 'UsersController@bulkAction')->name('bulk');
                Route::post('invitations', 'UsersController@generateInvitationCode');

                Route::group(['prefix' => 'edit', 'as' => 'edit.'], function () {
                    Route::get('{user}', 'UsersController@showUserProfile')->name('profile');
                    Route::patch('{user}', 'UsersController@updateUserProfile')->name('update');
                    Route::patch('{user}/password', 'UsersController@updateUserPassword')->name('password');
                });

                Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
                    Route::get('/', 'UsersController@showProfile')->name('index');

                    Route::patch('save', 'UsersController@saveProfile')->name('save');
                    Route::patch('password', 'UsersController@updatePassword')->name('update-password');
                    Route::post('oauth/{service}', 'UsersController@bindOrUnbindOAuth')->name('oauth');
                    Route::get('oauth/{service}', 'UsersController@redirectToService');
                    Route::post('avatar', 'UsersController@uploadAvatar')->name('upload-avatar');
                    Route::post('resize', 'UsersController@resizeAvatar')->name('resize-avatar');
                });
            });

            Route::group([
                'prefix' => 'center',
                'as'     => 'center.',
            ], function () {
                Route::get('/', 'CenterController@showIndex')->name('index');
                Route::get('factory', 'CenterController@showFactory')->name('factory');

                Route::post('factory', 'CenterController@createFactory');
            });

            // Site settings.
            Route::group([
                'prefix' => 'settings',
                'as'     => 'settings.'
            ], function () {

                Route::get('/', 'SettingsController@showGeneralSettings')->name('general');
                Route::get('services', 'SettingsController@showServicesSettings')->name('services');

                Route::group(['prefix' => 'advanced', 'as' => 'advanced.'], function () {
                    Route::get('/', 'SettingsController@showAdvancedSettings')->name('index');
                    Route::post('/', 'SettingsController@saveAdvancedDevelopSettings')->name('save-develop');
                    Route::get('database', 'SettingsController@showDatabaseSettings')->name('database');
                    Route::get('cache', 'SettingsController@showCacheSettings')->name('cache');
                    Route::get('sub-domains', 'SettingsController@showSubDomainsSettings')->name('sub-domains');
                    Route::patch('sub-domains', 'SettingsController@saveSubDomainsSettings');
                    Route::patch('cache/{type}/{action?}', 'SettingsController@doCacheByType')->name('do-cache');
                });

                Route::group(['prefix' => 'display', 'as' => 'display.'], function () {
                    Route::get('/', 'SettingsController@showDisplaySettings')->name('index');
                    Route::post('logo', 'SettingsController@uploadLogo')->name('upload-logo');
                });

                Route::get('upgrade', 'SettingsController@showUpgradeSettings')->name('upgrade');
                Route::patch('upgrade', 'SettingsController@upgrade');
                Route::post('upgrade', 'SettingsController@getUpgradeLog');

                Route::post('general/{type}', 'SettingsController@saveGeneralSettings')->name('save-general');
                Route::group(['prefix' => 'service'], function () {
                    Route::post('oauth/{service}', 'SettingsController@saveServicesOAuthSettings')->name('save-oauth');
                    Route::post('email', 'SettingsController@saveServicesEmailSettings')->name('save-email');
                    Route::post('email/test', 'SettingsController@sendTestEmail')->name('send-test');
                    Route::post('push', 'SettingsController@saveServicesPushSettings')->name('save-push');
                    Route::post('storage', 'SettingsController@saveServicesStorageSettings')->name('save-storage');
                    Route::post('storage/{disk}', 'SettingsController@saveServicesDiskSettings')->name('save-disk');
                });
            });
        });

        return new static;
    }

    /**
     * Get the robots.txt file dynamically.
     *
     * @return static
     * @author Cali
     */
    public static function robots()
    {
        Route::get('robots.txt', 'Dashboard\HomeController@generateRobotsTxt');
        Route::get('test', function () {
            Noah\Person::create();
            
            return Noah\Person::first();
        });

        return new static;
    }

    /**
     * User related routes.
     *
     * @return static
     * @author Cali
     */
    public static function users()
    {
        if (site('avatarsSubDomain') != '1') {
            Route::group([
                'namespace' => 'User',
                'prefix'    => 'users',
                'as'        => 'users.'
            ], function () {
                Route::get('avatars/{user?}', 'ProfileController@getAvatar')->name('avatar');
            });
        } else {
            Route::group([
                'namespace' => 'User',
                'as'        => 'users.',
                'domain'    => site('avatarSubDomainName') ?: 'avatars.' . str_replace('http://', '', str_replace('https://', '', env('APP_URL')))
            ], function () {
                Route::get('u/{user?}', 'ProfileController@getAvatar')->name('avatar');
            });
        }

        return new static;
    }
}