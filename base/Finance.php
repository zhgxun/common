<?php

namespace common\base;

class Finance
{
    public static $instance;
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public $status = [
        ['type' => 1, 'description' => '开启'],
        ['type' => 2, 'description' => '关闭'],
        //['type' => 9, 'description' => '删除'],
    ];

    public $type = [
        ['type' => 1, 'description' => '收入'],
        ['type' => 2, 'description' => '消费'],
    ];

    public function getStatusKV()
    {
        return \yii\helpers\ArrayHelper::map($this->status, 'type', 'description');
    }

    public function statusToDes($type)
    {
        $statusList = $this->getStatusKV();
        return isset($statusList[$type]) ? $statusList[$type] : '';
    }

    public function getTypeKV()
    {
        return \yii\helpers\ArrayHelper::map($this->type, 'type', 'description');
    }

    public function typeToDes($type)
    {
        $typeList = $this->getTypeKV();
        return isset($typeList[$type]) ? $typeList[$type] : '';
    }
}
