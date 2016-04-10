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

    // Authentication
    // 用户验证
    'auth'      => [
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
    'dashboard' => [
        'home' => [
            'title' => '主页'
        ]
    ]
];