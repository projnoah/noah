<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Password Reset Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are the default lines which match reasons
    | that are given by the password broker for a password update attempt
    | has failed, such as for an invalid token or invalid new password.
    |
    */

    'password' => '密码必须至少为6个字符, 并且两次输入一致.',
    'reset'    => '您的密码被重置了!',
    'sent'     => '我们已将密码重置的邮件发到了您的邮箱!',
    'token'    => '该请求无效.',
    'user'     => "无法找到此邮箱相关用户.",
    'email'    => [
        'description'  => '您的帐号申请了重置密码, 如果该请求不是您的操作可以忽视本邮件.',
        'click'        => '如果您确定重置该邮箱的密码, 请点击下面的链接.',
        'reset-button' => '重置密码',
        'fallback'     => '如果上面的链接点击无效, 请尝试手动复制访问:',
        'subject'      => '您的密码重置申请',
        'success' => '您的密码已被重置',
        'success-description' => '若该操作不是您发起的, 那么您的帐号可能存在盗号风险.'
    ]

];
