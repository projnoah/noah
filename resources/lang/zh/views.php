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
        'title'         => '安装向导',
        'steps'         => [
            '1' => '填写信息',
            '2' => '设置管理员',
        ],
        'subtitles'     => [
            '1' => '审核信息',
            '2' => '添加管理员',
        ],
        'inputs'        => [
            'db_host'            => '数据库服务器地址',
            'db_host_tip'        => '常用: localhost或127.0.0.1',
            'db_name'            => '数据库名称',
            'db_name_tip'        => '请确保此数据库已创建',
            'db_user'            => '数据库用户名',
            'db_password'        => '数据库密码',
            'db_prefix'          => '数据库表前缀',
            'admin_username'     => '管理员用户名',
            'admin_username_tip' => '用户名为登录凭证',
            'admin_password'     => '管理员密码',
            'admin_password_tip' => '请牢记该密码',
            'admin_email'        => '管理员邮箱',
            'admin_email_tip'    => '邮件通知将由本地址发出',
        ],
        'confirm'       => '确认信息',
        'confirm_title' => '确定并提交',
        'next'          => '下一项',
        'refresh'       => '刷新重试',
        'errors'        => [
            'empty'                  => '此项必填',
            'email'                  => '请填写一个有效的邮箱',
            'env_denied'             => '根目录下.env文件不可写',
            'env_not_found'          => '根目录下.env文件未找到',
            'database_access_denied' => '数据库用户名或密码错误',
            'database_not_found'     => '数据库未建立',
            'connection_refused'     => '数据库连接失败',
            'unwritable'             => ':path 目录不可写',
            'unknown'                => '数据库信息有误, 请重试'
        ],
        'success'       => [
            'writable'            => '文件目录检查完毕',
            'database_connection' => '数据库连接成功',
            'next'                => '前往下一步',
        ],
    ],

    // Authentication
    // 用户验证
    'auth'         => [
        'title'    => '登录或者注册',
        // Login page
        // 登录页面
        'login'    => [
            'header_title'    => '登录',
            'username'        => '用户名',
            'password'        => '密码',
            'remember_me'     => '记住我, 下次免登录',
            'forgot_password' => '忘记密码?',
            'register'        => '注册',
            'error'           => '填写错误',
        ],
        // Registration page
        // 注册页面
        'register' => [
            'header_title'     => '注册',
            'username'         => '用户名',
            'password'         => '密码',
            'email'            => '邮箱地址',
            'confirm_password' => '确认密码',
        ],
        // Password reset page
        // 密码重置页面
        'reset'    => [
            'title'       => '重置密码',
            'button'      => '重置',
            'placeholder' => '要重置密码的邮箱地址...',
            'success'     => '成功发送',
            'error'       => '出错了',
        ],
        // Social connect page
        // 社交平台绑定页面
        'social'   => [
            'title'    => '绑定帐号',
            'headings' => [
                'connect' => '通过:service绑定帐号',
                'tip'     => '请填入以下信息完成注册'
            ],
            'errors'   => [
                'empty' => '请输入内容',
                'email' => '邮箱格式不正确'
            ],
            'inputs'   => [
                'username' => '用户名',
                'name'     => '显示的昵称',
                'email'    => '电子邮件地址'
            ],
            'success'  => '成功绑定帐号!',
            'failed'   => '出错了, 请刷新重试',
            'loading'  => '加载中...',
            'services' => [
                'qq'     => 'QQ',
                'weibo'  => '微博',
                'wechat' => '微信'
            ]
        ],
    ],
    'dashboard'    => [
        'home' => [
            'title' => '主页'
        ]
    ],
    'admin'        => [
        'main-title'            => '后台管理',
        'titles'                => [
            'dashboard' => '仪表盘',
            'users'     => [
                'main' => '用户',
                'sub'  => [
                    'profile' => '修改个人资料'
                ]
            ],
            'settings'  => [
                'main' => '站点设置',
                'sub'  => [
                    'general'  => '常规设置',
                    'advanced' => '高级设置',
                    'display'  => '界面设置',
                    'services' => '第三方服务'
                ]
            ]
        ],
        'theme-color-changed'   => '主题已更换',
        'theme-setting-changed' => ':type 设置已更改',
        'navbar'                => [
            'settings' => [
                'fixed-header'   => '顶部导航固定',
                'fixed-sidebar'  => '边栏固定',
                'horizontal-bar' => '边栏水平/垂直',
                'toggle-sidebar' => '边栏最小化',
                'compact-menu'   => '小菜单',
                'hover-menu'     => '鼠标悬停菜单',
                'theme-color'    => '修改主题颜色',
                'reset'          => '重置设置',
                'errors'         => [
                    'static-header-horizontal-bar' => '非固定的顶部导航无法与固定水平边栏兼容, 已重新设置',
                    'fixed-sidebar-hover-menu'     => '固定边栏无法与悬停菜单兼容, 已重新设置'
                ]
            ],
            'logout'   => '注销'
        ],
        'footer'                => [
            'current-version' => '当前版本'
        ],
        'pages'                 => [
            'settings' => [
                'general'       => [
                    'basics' => [
                        'heading'             => '核心设置',
                        'site-title'          => '站点标题',
                        'home-uri'            => '主页地址',
                        'home-uri-help'       => '主页地址, 网站入口地址',
                        'social-uri'          => '社区地址',
                        'social-uri-help'     => '社区主页地址, 发布图文分享等SNS系统',
                        'post-uri'            => '文章地址',
                        'post-uri-help'       => '文章主页地址, 博文CMS系统',
                        'admin-uri'           => '后台地址',
                        'admin-uri-help'      => '后台管理地址, 请谨慎修改',
                        'registration-on'     => '用户注册',
                        'registration-on-yes' => '开放注册',
                        'registration-on-no'  => '仅注册码邀请',
                        'admin-email'         => '管理邮箱',
                        'admin-email-help'    => '将以该邮箱发邮件给网站用户',
                        'admin-email-setting' => '前往邮件设置'
                    ],
                    'seo'    => [
                        'heading'          => 'SEO设置',
                        'separator'        => '分隔符',
                        'separator-help'   => '用来分隔网站标题, 比如 页面 :: 站名',
                        'description'      => '站点介绍',
                        'description-help' => '简洁的话语来介绍描述您的网站, 将建站目的与网站功能告诉大家',
                        'keywords'         => '关键字',
                        'keywords-help'    => '希望用户通过搜索引擎的什么关键字来索引到网站',
                        'ignores'          => '不收录',
                        'ignores-help'     => '不希望被搜索引擎收录的地址URI',
                    ],
                    'region' => [
                        'heading'          => '地区设置',
                        'timezone'         => '时区',
                        'locale'           => '主要语言',
                        'locale-help'      => '网站的默认界面交互语言',
                        'auto-locale'      => '自动选择',
                        'auto-locale-on'   => '开启',
                        'auto-locale-help' => '根据用户浏览器语言来自动选择相应的界面语言, 若没有该语言将显示"主要语言"',
                    ],
                    'extra'  => [
                        'heading'         => '额外设置',
                        'icp'             => '备案号',
                        'ssl'             => '安全协议',
                        'ssl-on'          => '强制SSL',
                        'ssl-help'        => 'SSL协议(https)使网站访问更安全, 自动重定向用户, 请确保已安装证书并正确配置',
                        'powered-by'      => 'Powered By',
                        'powered-by-on'   => '自豪地显示',
                        'powered-by-help' => '如果喜欢本程序 望多多宣传并开启显示, 谢谢支持',
                    ]
                ],
                'services'      => [
                    'oauth' => [
                        'heading'  => '第三方登录',
                        'redirect' => '回调链接',
                        'apply'    => '申请链接',
                        'on'       => '开启',
                        'on-text'  => '开启本登录服务',
                        'tips'     => '使用第三方/社交登录可以让用户快速注册并绑定本地帐号'
                    ],
                    'email' => [
                        'heading'                   => '邮件服务',
                        'tips'                      => '通过邮件服务可以在用户注册时发送确认链接, 邮件订阅等服务, 对站点的作用必不可少',
                        'on'                        => '开启邮件服务',
                        'mail_driver'               => '邮件驱动',
                        'mail_host'                 => '主机地址',
                        'mail_host-placeholder'     => '如smtp.exmail.qq.com',
                        'mail_port'                 => '端口',
                        'mail_port-placeholder'     => '常用加密端口465',
                        'mail_username'             => '邮箱用户名',
                        'mail_username-placeholder' => '如no-reply@example.com',
                        'mail_password'             => '邮箱验证密码',
                        'mail_encryption'           => '加密方式',
                        'test-heading'              => '发送测试邮件',
                        'test-placeholder'          => '发送测试邮件到...',
                        'test-tip'                  => '(先保存设置后按发送)若一分钟内还没收到, 请检查是否被丢到垃圾箱内了',
                        'test-success'              => '邮件发送成功, 请查收',
                        'test-failure'              => '邮件信息有误, 请重新填写'
                    ],
                    'push'  => [
                        'heading' => '实时推送',
                        'tips' => '实时推送服务可以实时地聊天, 推送新通知, 监测新用户注册等, 而完全不用刷新页面',
                        'pusher'  => [
                            'on' => '开启Pusher推送服务',
                        ]
                    ],
                    'storage' => [
                        'heading' => '云存储服务',
                        'tips' => '云存储服务可以减轻本地服务器的资源压力, 使用CDN等高速分配资源是最佳选择',
                    ]
                ],
                'update-button' => '保存设置',
                'updated'       => ':setting 设置已更新'
            ]
        ]
    ]
];