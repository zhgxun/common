<?php

namespace common\base\log;

use Elasticsearch\ClientBuilder;

class RequestLog
{
    public static $instance;
    protected $hosts = [
        'elastic:changeme@127.0.0.1:9200'
    ];

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * 实例化客户端
     * @return \Elasticsearch\Client
     */
    public function client()
    {
        return ClientBuilder::create()->setHosts($this->hosts)->build();
    }

    /**
     * 创建索引
     */
    public function create()
    {
        $client = $this->client();
        $client->indices()->create(\common\models\log\RequestLog::mapping());
    }

    /**
     * 添加日志
     * @param array $row
     * @return array
     */
    public function add($row = [])
    {
        $params = [
            'index' => \common\models\log\RequestLog::index(),
            'type' => \common\models\log\RequestLog::type(),
            'body' => $row
        ];
        $client = $this->client();
        return $client->index($params);
    }

    /**
     * 删除索引
     */
    public function delete()
    {
        $params = [
            'index' => \common\models\log\RequestLog::index()
        ];
        $client = $this->client();
        $client->indices()->delete($params);
    }
}
