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
            '2' => '添加管理员'
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
            'done'                => '设置完成，一切已准备就绪',
            'done_button'         => '开启全新站点',
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
    ]
];