<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,

    //七牛云存储配置
    'qiniu' => [
        'ak' => '***',
        'sk' => '***',
        'bucket' => '***',
        'prefix' => '',
        'baseurl' => '***',
    ],

    // 日志文件保存位置
    'logPath' => '/Users/zhgxun/Public/html/logs',

    // 任务管理执行主机IP地址列表
    'hosts' => [
        1 => '127.0.0.1'
    ],

    // 数据年份
    'dataYear' => [
        1 => '2016'
    ],
];
