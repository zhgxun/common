<?php

namespace common\base;

class Sentence
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

    public function statusToDes($status)
    {
        $statusList = $this->getStatusKV();
        return isset($statusList[$status]) ? $statusList[$status] : '未知';
    }

    public function getById($id)
    {
        $row = \common\models\Sentence::findOne(intval($id));
        return $row ? $row->toArray() : null;
    }

    public function getSentence()
    {
        $query = \common\models\Sentence::find();
        $query->where(' `status` = :status', [
            ':status' => 1
        ]);
        $query->orderBy(' `id` DESC');
        $row = $query->one();

        return $row ? $row->toArray() : null;
    }
}
