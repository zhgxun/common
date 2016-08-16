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
    ],
];
