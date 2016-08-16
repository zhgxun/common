<?php

namespace common\base;

class Recommend
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
        //['type' => 3, 'description' => '删除'],
    ];

    public $type = [
        ['type' => 1, 'description' => '技术'],
        ['type' => 2, 'description' => '普通'],
    ];

    public function getStatusKV()
    {
        return \yii\helpers\ArrayHelper::map($this->status, 'type', 'description');
    }

    public function statusToDes($type)
    {
        $statusList = $this->getStatusKV();
        return isset($statusList[$type]) ? $statusList[$type] : '未知';
    }

    public function getTypeKV()
    {
        return \yii\helpers\ArrayHelper::map($this->type, 'type', 'description');
    }

    public function typeToDes($type)
    {
        $typeList = $this->getTypeKV();
        return isset($typeList[$type]) ? $typeList[$type] : '未知';
    }

    public function getById($id)
    {
        $row = \common\models\Recommend::findOne(intval($id));
        return $row ? $row->toArray() : null;
    }

    /**
     * 推荐阅读
     * @param int $type 1 技术 2 普通
     * @param int $status
     * @param int $limit
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getList($type, $status = 1, $limit = 5)
    {
        $query = \common\models\Recommend::find();
        $query->where(' `type` = :type AND `status` = :status', [
            ':type' => intval($type),
            ':status' => intval($status),
        ]);
        $query->orderBy(' `id` DESC');
        $query->limit(intval($limit));
        $list = $query->asArray()->all();

        return $list;
    }
}