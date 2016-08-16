<?php

namespace common\base;

class Navigation
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
        ['type' => 9, 'description' => '删除'],
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

    public function getById($id)
    {
        $navigation = \common\models\Navigation::findOne(intval($id));
        if ($navigation !== null) {
            return $navigation;
        }
        return null;
    }

    public function getNameById($id)
    {
        $navigation = $this->getById($id);
        return isset($navigation['label']) ? $navigation['label'] : '未知';
    }

    public function getList($status = 1)
    {
        $query = \common\models\Navigation::find();
        $query->where(' `status` = :status', [
            ':status' => intval($status),
        ]);
        $list = $query->asArray()->all();

        return $list;
    }

    /**
     * 导航列表KV
     * @return array
     */
    public function getNavigationKV()
    {
        $navigations = $this->getList();
        return \yii\helpers\ArrayHelper::map($navigations, 'id', 'label');
    }

    /**
     * 导航获取
     * @param int $status 默认开启
     * @return array
     */
    public function getMenuItems($status = 1)
    {
        $items = $this->getList($status);
        $menus = [];
        foreach ($items as $item) {
            $menus[] = [
                'label' => $item['label'],
                'url' => [
                    $item['url'],
                    'type' => $item['id'],
                ]
            ];
        }
        return $menus;
    }
}
