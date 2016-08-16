<?php

namespace common\base;

/**
 * 文章
 * @package common\base
 */
class Article
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
        return isset($statusList[$type]) ? $statusList[$type] : '未知';
    }

    /**
     * 文章详情, 缓存一天
     * @param int $id 文章ID
     * @return array|bool|null|string
     * @throws \Exception
     */
    public function getById($id)
    {
        $row = \common\models\Article::findOne(intval($id));
        if ($row) {
            return $row->toArray();
        }
        return null;
    }
}
