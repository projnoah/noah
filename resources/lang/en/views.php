<?php

return [
    /*
     |------------------------------------------------------------
     | Views Language Lines
     | 视图相关本地化语言文件
     |------------------------------------------------------------
     |
     | @project Project Noah
     | @author Cali
     |
     */

    // Installation process
    'installation' => [
        'title'         => 'Installation Guide',
        'steps'         => [
            '1' => 'Fill out the blanks',
            '2' => 'Assign administrator',
        ],
        'subtitles'     => [
            '1' => 'Verify credentials',
            '2' => 'Assign an admin account',
        ],
        'inputs'        => [
            'db_host'            => 'Database host',
            'db_host_tip'        => 'Usually: localhost or 127.0.0.1',
            'db_name'            => 'Name of the database',
            'db_name_tip'        => 'This database must exist',
            'db_user'            => 'Username of database',
            'db_password'        => 'Password of database',
            'db_prefix'          => 'Table prefix',
            'admin_username'     => 'Admin\'s username',
            'admin_username_tip' => 'This is used for logging you in',
            'admin_password'     => 'Admin\'s password',
            'admin_password_tip' => 'Memorize it',
            'admin_email'        => 'Admin\'s email',
            'admin_email_tip'    => 'All emails will be sent via this email address',
        ],
        'confirm'       => 'Confirm',
        'confirm_title' => 'Correct and confirm',
        'next'          => 'Next',
        'refresh'       => 'Retry / Refresh',
        'errors'        => [
            'empty'                  => 'This is required',
            'email'                  => 'Please fill out a valid email',
            'env_denied'             => '.env file in your root directory cannot be written',
            'env_not_found'          => '.env file in your root directory cannot be found',
            'database_access_denied' => 'Invalid username or password',
            'database_not_found'     => 'No such database found',
            'connection_refused'     => 'Database connection refused',
            'unwritable'             => ':path directory is unwritable',
            'unknown'                => 'Unknown issues occurred, retry'
        ],
        'success'       => [
            'writable'            => 'All directories checked out',
            'database_connection' => 'Database connected',
            'next'                => 'Next step',
        ],
    ],

    // Authentication
    // 用户验证
    'auth'         => [
        'title'    => 'Login or Register',
        // Login page
        // 登录页面
        'login'    => [
            'header_title'    => 'Login',
            'username'        => 'Username',
            'password'        => 'Password',
            'remember_me'     => 'Remember me!',
            'forgot_password' => 'Forgot your password?',
            'register'        => 'Register',
            'error'           => 'Error',
        ],
        // Registration page
        // 注册页面
        'register' => [
            'header_title'     => 'Register',
            'username'         => 'Username',
            'password'         => 'Password',
            'email'            => 'Email address',
            'confirm_password' => 'Confirm password',
        ],
        // Password reset page
        // 密码重置页面
        'reset'    => [
            'title'       => 'Reset Password',
            'button'      => 'Send reset request',
            'placeholder' => 'Which email address you want to send to...',
            'success'     => 'Reset email sent',
            'error'       => 'Error occurred',
        ],
        // Social connect page
        // 社交平台绑定页面
        'social'   => [
            'title'    => 'Connect account',
            'headings' => [
                'connect' => 'Connect through :service',
                'tip'     => 'Please fill out the information'
            ],
            'errors'   => [
                'empty' => 'Emtpy content',
                'email' => 'Invalid email'
            ],
            'inputs'   => [
                'username' => 'Username',
                'name'     => 'Nickname',
                'email'    => 'Email'
            ],
            'success'  => 'Connected!',
            'failed'   => 'Something went wrong, please retry',
            'loading'  => 'Loading...',
            'services' => [
                'qq'     => 'QQ',
                'weibo'  => 'Weibo',
                'wechat' => 'WeChat'
            ]
        ],
    ],
    'dashboard'    => [
        'home' => [
            'title' => 'Home'
        ]
    ],
    'admin'        => [
        'main-title'            => 'Manage',
        'titles'                => [
            'dashboard'   => 'Dashboard',
            'users'       => [
                'main' => 'Users',
                'sub'  => [
                    'index'       => 'Manage users',
                    'profile'     => 'Edit profile',
                    'invitations' => 'Invitation codes'
                ]
            ],
            'media'       => [
                'main' => 'Media',
                'sub'  => [

                ]
            ],
            'data-center' => [
                'main' => 'Data Center',
                'sub'  => [
                    'index'   => 'Statistics',
                    'factory' => 'Model Factory'
                ]
            ],
            'settings'    => [
                'main' => 'Site settings',
                'sub'  => [
                    'general'  => 'Generals',
                    'advanced' => [
                        'main'        => 'Advanced',
                        'develop'     => 'Developer',
                        'database'    => 'Database',
                        'cache'       => 'Cache',
                        'sub-domains' => 'Sub-domains'
                    ],
                    'display'  => 'Displays',
                    'services' => 'Services',
                    'upgrade'  => 'Upgrade',
                ]
            ]
        ],
        'theme-color-changed'   => 'Theme color changed',
        'theme-setting-changed' => ':type has changed',
        'navbar'                => [
            'settings' => [
                'fixed-header'   => 'Fixed header',
                'fixed-sidebar'  => 'Fixed sidebar',
                'horizontal-bar' => 'Sidebar horizontal/vertical',
                'toggle-sidebar' => 'Toggle sidebar',
                'compact-menu'   => 'Compact menu',
                'hover-menu'     => 'Mouse hover menu',
                'theme-color'    => 'Theme color',
                'reset'          => 'Reset',
                'errors'         => [
                    'static-header-horizontal-bar' => 'Static header and horizontal bar are not compatible one another',
                    'fixed-sidebar-hover-menu'     => 'Fixed sidebar and hover menu are not compatible one another'
                ]
            ],
            'logout'   => 'Logout'
        ],
        'footer'                => [
            'current-version' => 'Current Version'
        ],
        'navigation'            => [

        ],
        'pages'                 => [
            'dashboard'   => [
                'new-users-this-month'  => 'New users this month',
                'page-views-this-month' => 'Page views this month',
                'unique-ips-today'      => 'Unique IPs today',
                'unique-visitors-today' => 'UVs today',
                'visitors'              => 'Visitors',
                'browser-stats'         => 'Browser stats',
                'city-stats'            => 'City stats',
                'uri'                   => 'Page rank',
                'home'                  => 'Home'
            ],
            'users'       => [
                'index'       => [
                    'heading'         => 'Manage users',
                    'search-heading'  => 'Search users about :keyword',
                    'table'           => [
                        'registered_at' => 'Registered at',
                        'count'         => ':perPage users per page, total :total users'
                    ],
                    'search'          => 'Search users',
                    'bulk-actions'    => 'Bulk actions',
                    'delete'          => 'Delete',
                    'delete-messages' => [
                        'title'   => "Are you sure to delete this user?",
                        'text'    => 'Data cannot be restored after deletion',
                        'cancel'  => "Nope",
                        'confirm' => "Yep, do it!",
                        'success' => 'User deleted'
                    ],
                    'no-result'       => 'No result'
                ],
                'profile'     => [
                    'basics'   => [
                        'heading' => 'Basics',
                    ],
                    'password' => [
                        'heading' => 'Password settings',

                    ],
                    'social'   => [
                        'heading'        => 'Social accounts',
                        'not-found'      => 'No social platform enabled',
                        'tips'           => 'Using this can eliminate the disadvantage of typing passwords',
                        'bind'           => 'Bind',
                        'unbind'         => 'Unbind',
                        'bound'          => 'Bound',
                        'unbound'        => 'Unbound',
                        'bind-success'   => 'Successfully bound with :service',
                        'bind-error'     => 'Your :service has already bound with other user',
                        'unbind-success' => 'Unbind :service successfully',
                    ],
                    'avatar'   => [
                        'heading'        => 'Avatar settings',
                        'update-success' => 'Updated',
                        'update-failure' => 'Failed'
                    ]
                ],
                'invitations' => [
                    'tips'        => 'Send invitation codes to friends, and visit this link',
                    'unavailable' => 'Registration already on',
                    'heading'     => 'Generate invitations',
                    'quantity'    => 'Quantity',
                    'generate'    => 'Generate',
                    'table'       => [
                        'code' => 'Code',
                        'date' => 'Date'
                    ],
                    'generated'   => 'Generated'
                ]
            ],
            'data-center' => [
                'index'   => [
                    'total-users'      => 'Total users',
                    'total-page-views' => 'Total page views',
                    'total-blogs'      => 'Total blogs',
                    'total-comments'   => 'Total comments',
                    'visitor-records'  => 'Visitor records',
                    'most'             => ':item most',
                    'attributes'       => [
                        'browser'  => 'Browser',
                        'platform' => 'Platform',
                        'city'     => 'City',
                        'device'   => 'Device',
                        'uri'      => 'Page'
                    ]
                ],
                'factory' => [
                    'heading'       => 'Welcome to Model Factory',
                    'tips'          => 'Model Factory is one of the features in Project Noah, for quick data-seeding purposes, like generate 50 users, 100 blogs, etc.',
                    'model'         => 'Select model',
                    'quantity'      => 'Select quantity',
                    'quantity-tips' => 'The more you generate the longer it\'ll take, choose wisely',
                    'models'        => [
                        'user' => 'User model',
                        'blog' => 'Blog model'
                    ],
                    'create'        => 'Create',
                    'created'       => ':q :model have generated',
                    'half-created'  => 'An error occurred because of data unicity conflicts, partially generated'
                ]
            ],
            'settings'    => [
                'general'       => [
                    'basics' => [
                        'heading'             => 'Basics',
                        'site-title'          => 'Site title',
                        'home-uri'            => 'Home URI',
                        'home-uri-help'       => 'Home address, site entry point',
                        'social-uri'          => 'Social URI',
                        'social-uri-help'     => 'Social address, SNS like sharing pictures and videos',
                        'post-uri'            => 'Post URI',
                        'post-uri-help'       => 'Posts address, CMS like posting articles',
                        'admin-uri'           => 'Admin URI',
                        'admin-uri-help'      => 'Admin address, change wisely',
                        'registration-on'     => 'Registration',
                        'registration-on-yes' => 'Everybody can register',
                        'registration-on-no'  => 'Invitation only',
                        'admin-email'         => 'Admin\'s email address',
                        'admin-email-help'    => 'All emails will be sent by this address',
                        'admin-email-setting' => 'Go to email settings'
                    ],
                    'seo'    => [
                        'heading'          => 'SEO',
                        'separator'        => 'Title separator',
                        'separator-help'   => 'For separating html title, like "Page :: Site"',
                        'description'      => 'Description',
                        'description-help' => 'A short description for your web site, what your purpose or goal is',
                        'keywords'         => 'Keywords',
                        'keywords-help'    => 'Keywords that\'ll be indexed in search engines',
                        'ignores'          => 'Ignores',
                        'ignores-help'     => 'The URIs that you don\'t want to be indexed',
                    ],
                    'region' => [
                        'heading'          => 'Region',
                        'timezone'         => 'Timezone',
                        'locale'           => 'Main language',
                        'locale-help'      => 'Default User Interface language',
                        'auto-locale'      => 'Auto select',
                        'auto-locale-on'   => 'On',
                        'auto-locale-help' => 'Depends on what the user\'s browser language is, if not matched, main language will be applied',
                    ],
                    'extra'  => [
                        'heading'         => 'Extra',
                        'icp'             => 'ICP',
                        'ssl'             => 'SSL Encryption',
                        'ssl-on'          => 'Force SSL',
                        'ssl-help'        => 'SSL Protocol(https) makes your website more secure, auto redirection will be applied, correct certificates required',
                        'powered-by'      => 'Powered By',
                        'powered-by-on'   => 'Proudly display',
                        'powered-by-help' => 'Leaving this option on would be your support for Project Noah, thanks',
                    ]
                ],
                'services'      => [
                    'oauth'   => [
                        'heading'  => 'OAuth Services',
                        'redirect' => 'Redirect URL',
                        'apply'    => 'Apply link',
                        'on'       => 'On',
                        'on-text'  => 'Turn on',
                        'tips'     => 'To quickly let user log into your website, this is the best approach'
                    ],
                    'email'   => [
                        'heading'                   => 'Email service',
                        'tips'                      => 'Registration confirm emails, email subscriptions, take a very important role in your web site',
                        'on'                        => 'Turn on',
                        'mail_driver'               => 'Driver',
                        'mail_host'                 => 'Host',
                        'mail_host-placeholder'     => 'like smtp.exmail.qq.com',
                        'mail_port'                 => 'Port',
                        'mail_port-placeholder'     => 'Encrypted: 465',
                        'mail_username'             => 'Username',
                        'mail_username-placeholder' => 'no-reply@example.com',
                        'mail_password'             => 'Password',
                        'mail_encryption'           => 'Encryption',
                        'test-heading'              => 'Test email',
                        'test-placeholder'          => 'Send test email to...',
                        'test-tip'                  => '(Save first, test second)If still no email received after a couple of minutes, check out in your email trash box',
                        'test-success'              => 'Email sent, check it out',
                        'test-failure'              => 'Failed, re-fill the credentials'
                    ],
                    'push'    => [
                        'heading' => 'Real-time push notifications',
                        'tips'    => 'Real-time service can be used for real-time chat, push notifications, data monitors, without refreshing the page',
                        'pusher'  => [
                            'on' => 'Turn Pusher on',
                        ]
                    ],
                    'storage' => [
                        'heading'       => 'Storage',
                        'tips'          => 'Cloud storage can free up your server space, and use CDN to distribute contents even quicker',
                        'disks'         => [
                            'local'     => 'Local storage',
                            'ftp'       => 'FTP server',
                            's3'        => 'Amazon s3 (aws)',
                            'rackspace' => 'Rackspace',
                            'qiniu'     => 'Qiniu'
                        ],
                        'warning'       => 'If you\'re using cloud storage, please make sure the credentials are correct',
                        'ftp_host'      => 'FTP host',
                        'qiniu_notify'  => 'Notify URL (optional)',
                        'qiniu_default' => 'Default domain',
                        'qiniu_https'   => 'Https domain',
                        'qiniu_custom'  => 'Custom domain',
                    ]
                ],
                'advanced'      => [
                    'warning-title' => 'Warning!',
                    'warning-text'  => 'This page isn\'t for everyone, only change it if you know what you\'re doing, always think twice',
                    'develop'       => [
                        'title'                  => 'Development mode',
                        'environment'            => 'Environment',
                        'environment-local'      => 'Local environment',
                        'environment-production' => 'Production environment',
                        'debug'                  => 'Debug mode',
                        'debug-tips'             => 'If something went wrong, to debug you need to turn it on',
                        'maintenance'            => 'Maintenance mode',
                        'maintenance-tips'       => 'After turning on, users will be redirected to 503 page',
                        'maintenance-warning'    => 'Or you could manually delete /storage/framework/down file to bring up your application',
                        'admin-ignores'          => 'Ignores admin users',
                        'admin-ignores-tips'     => 'Only admin users can visit while in maintenance mode',
                        'server-info'            => 'Server info',
                        'noah-installed'         => 'Installed at',
                        'php-ver'                => 'PHP version',
                        'mysql-ver'              => 'MySQL version',
                        'os'                     => 'Operating system',
                        'server-software'        => 'Server software',
                        'developed-by'           => 'Developed by'
                    ],
                    'cache'         => [
                        'title'              => 'Cache management',
                        'tips'               => 'To increase speed of your website, you can always use cache',
                        'main-cache'         => 'Settings cache',
                        'main-cache-warning' => 'Remember always come back here to refresh cache after making a setting change',
                        'route-cache'        => 'Route URL cache',
                        'view-cache'         => 'View cache',
                        'refresh'            => 'Refresh',
                        'clear'              => 'Clear',
                        'refreshed'          => ':type has been refreshed',
                        'cleared'            => ':type has been cleared'
                    ],
                    'database'      => [
                        'title'  => 'Database overview',
                        'tables' => [
                            'name'          => 'Name',
                            'engine'        => 'Engine',
                            'rows'          => 'Rows',
                            'size'          => 'Size',
                            'collation'     => 'Collation',
                            'total_count'   => 'Total :count tables',
                            'total_records' => ':count'
                        ]
                    ],
                    'sub-domains'   => [
                        'avatar-sub-domain'         => 'Avatar sub-domain',
                        'avatar-uri'                => 'Sub-domain address',
                        'user-sub-domain'           => 'User sub-domain',
                        'switch'                    => 'Switch',
                        'sub-domain-name-exclusion' => 'Excludes'
                    ]
                ],
                'display'       => [
                    'upload-logo' => [
                        'title'       => 'Site LOGO',
                        'upload'      => 'Select file',
                        'upload-tips' => '1:1 ratio recommended, no larger than 500px',
                        'uploaded'    => 'Logo uploaded',
                    ]
                ],
                'upgrade'       => [
                    'heading'        => 'Upgrade',
                    'latest-version' => 'Up to date',
                    'new-version'    => 'New version available',
                    'details'        => 'Upgrade details',
                    'tips'           => 'Tips: Before upgrading, back up database and files, just in case.<br>Don\'t close this page while upgrading',
                    'manual'         => 'Manually upgrade:',
                    'official'       => 'Official upgrade site'
                ],
                'update-button' => 'Update',
                'updated'       => ':setting has updated',
                'new-version'   => 'NEW'
            ]
        ]
    ],

    'datatable' => [
        'info'          => "Results from _START_ to _END_, total _TOTAL_ records",
        'infoEmpty'     => 'Empty',
        'infoFiltered'  => '(filtered _MAX_ records)',
        'lengthMenu'    => 'Displaying _MENU_ records',
        'loadingRecord' => 'Loading...',
        'processing'    => 'Processing...',
        'search'        => 'Search:',
        'zeroRecords'   => 'No records found',
        'paginate'      => [
            'first'    => 'First page',
            'last'     => 'Last page',
            'next'     => 'Next',
            'previous' => 'Previous'
        ]
    ],

    'logout' => [
        'title'   => 'Are you sure to log out',
        'text'    => 'After logging out, certain pages will be unavailable',
        'confirm' => 'Confirm',
        'cancel'  => 'Nevermind'
    ],

    'dropzone' => [
        'drag-here' => 'Drag files here or click'
    ],

    'unavailable' => [
        'coming-soon'    => 'Coming Soon',
        'in-development' => 'In Development'
    ],

    'upgrades' => [
        'maintenance' => [
            'up'   => 'Shut down maintenance mode',
            'down' => 'Turn on maintenance mode'
        ],
        'fetch-zip'   => [
            'fetching' => 'Fetching upgrade file',
            'done'     => 'Upgrade file downloaded'
        ],
        'unzip'       => 'Unzipping file...',
        'optimize'    => 'Clear out cache, refresh directories',
        'migrate'     => 'Migrating database...',
        'complete'    => 'Upgrade complete, thanks for using Project Noah'
    ]
];