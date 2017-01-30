<?php

namespace common\models\log;

/**
 * 请求日志
 *
 * @property string $date
 * @property string $type
 * @property string $ip
 * @property string $method
 * @property string $user_host
 * @property string $user_agent
 * @property string $host_info
 * @property string $reqest_uri
 * @property string $get
 * @property string $post
 * @property string $raw_body
 * @property integer $request_user_id
 */
class RequestLog
{
    /**
     * 资源
     * @return null|object
     */
    public static function getDb()
    {
        return \Yii::$app->get('elasticsearch');
    }

    /**
     * 索引
     * @return string
     */
    public static function index()
    {
        return 'request_log';
    }

    /**
     * 类型
     * @return string
     */
    public static function type()
    {
        return 'request_log';
    }

    /**
     * 映射
     * @return array
     */
    public static function mapping()
    {
        return [
            'index' => self::index(),
            'body' => [
                'mappings' => [
                    self::type() => [
                        'properties' => [
                            'date' => ['type' => 'string'],
                            'type' => ['type' => 'string'],
                            'ip' => ['type' => 'string'],
                            'method' => ['type' => 'string'],
                            'user_host' => ['type' => 'string'],
                            'user_agent' => ['type' => 'string'],
                            'host_info' => ['type' => 'string'],
                            'reqest_uri' => ['type' => 'string'],
                            'get' => ['type' => 'string'],
                            'post' => ['type' => 'string'],
                            'raw_body' => ['type' => 'string'],
                            'request_user_id' => ['type' => 'integer'],
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * 属性规则
     * @return array
     */
    public function rules()
    {
        return [
            [['date', 'type', 'ip', 'method', 'user_host', 'user_agent', 'host_info', 'reqest_uri', 'get', 'post', 'raw_body'], 'string'],
            ['request_user_id', 'integer']
        ];
    }

    /**
     * 属性描述
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'date' => '请求日期',
            'type' => '请求类型，前端|后端',
            'ip' => '请求的ip地址',
            'method' => '请求方法',
            'user_host' => '请求主机',
            'user_agent' => '请求浏览器等信息',
            'host_info' => '主机信息',
            'reqest_uri' => '请求路径',
            'get' => 'get参数',
            'post' => 'post参数',
            'raw_body' => '请求内容体',
            'request_user_id' => '请求用户id'
        ];
    }

    /**
     * 属性
     * @return array
     */
    public function attributes()
    {
        return ['date', 'type', 'ip', 'method', 'user_host', 'user_agent', 'host_info', 'reqest_uri', 'get', 'post', 'raw_body', 'request_user_id'];
    }
}
