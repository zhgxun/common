<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        // 配置rbac权限控制
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // system default controller
        ],

        // 基本数据
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=new_zoulu',
            'username' => 'root',
            'password' => '********',
            'charset' => 'utf8',
        ],

        // 任务管理数据库
        'task' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=task_manage',
            'username' => 'root',
            'password' => '********',
            'charset' => 'utf8',
        ],

        // 邮件
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false, // false发送邮件，true只是生成邮件在runtime文件夹下，不发邮件
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.163.com',
                'username' => '***@163.com',
                'password' => '***',
                'port' => '25',
                'encryption' => 'tls', //tls or ssl
            ],
        ],
    ],
];
