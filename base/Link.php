<?php

namespace common\base;

class Link
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

    public function getStatusKV()
    {
        return \yii\helpers\ArrayHelper::map($this->status, 'type', 'description');
    }

    public function statusToDes($type)
    {
        $statusList = $this->getStatusKV();
        return isset($statusList[$type]) ? $statusList[$type] : '';
    }

    public function getById($id)
    {
        $row = \common\models\Link::findOne(intval($id));
        return $row ? $row->toArray() : null;
    }

    public function getList($status = 1, $limit = 10)
    {
        $query = \common\models\Link::find();
        $query->where(' `status` = :status', [
            ':status' => intval($status),
        ]);
        $query->orderBy(' `id` DESC');
        $query->limit(intval($limit));
        $list = $query->asArray()->all();

        return $list;
    }
}