<?php

namespace common\base;

class Menu
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

    /**
     * 通过父级ID获取菜单名
     * @param int $parentId 父级ID
     * @return string
     */
    public function getLabelByParentId($parentId)
    {
        $parent = \common\models\Menu::findOne(['id' => intval($parentId)]);
        if ($parent !== null) {
            return $parent['label'];
        }
        return '根分类';
    }

    /**
     * 菜单列表
     * @param int $parentId 父级ID
     * @param int $status 状态 默认开启
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getList($parentId = 0, $status = 1)
    {
        $query = \common\models\Menu::find();
        $query->where(' `pid` = :parentId AND `status` = :status', [
            ':parentId' => intval($parentId),
            ':status' => intval($status),
        ]);
        $list = $query->asArray()->all();
        return $list;
    }

    /**
     * 菜单导航
     * @param int $parentId 父级ID
     * @param int $status 默认开启
     * @return array
     */
    public function getMenuListKV($parentId = 0, $status = 1)
    {
        $list = $this->getList($parentId, $status);
        $menus = [];
        foreach ($list as $key => $value) {
            \common\base\TaskLog::getInstance()->writeLog($value);
            if (!$this->checkAccess($value['url'])) {
                continue;
            }
            $menus[] = [
                'label' => $value['label'],
                'url' => [$value['url']],
            ];
            $items = $this->getMenuListKV($value['id']);
            if ($items) {
                $menus[$key]['items'] = $items;
            }
        }

        return $menus;
    }

    /**
     * 菜单下拉列表展示
     * @param int $parentId 父级ID
     * @param int $level 嵌套层级
     * @param int $status 默认开启
     * @return array
     */
    public function getMenuOptionList($parentId = 0, $level = 0, $status = 1)
    {
        $list = $this->getList($parentId, $status);
        $menus = [];
        $prefix = '|--';
        for ($i = $level; $i > 0; $i--) {
            $prefix .= '--';
        }
        foreach ($list as $key => $value) {
            $menus[$value['id']] = $prefix . $value['label'];
            $childList = $this->getMenuOptionList($value['id'], $level + 1);
            if (!$childList) {
                continue;
            }
            $menus = $menus + $childList; // 不会重建索引
        }
        ksort($menus);
        return $menus;
    }

    /**
     * 获取当前浏览器访问的权限资源名称
     * 比如访问 backend.com/index.php?r=site/index
     * $appId = app-backend 在配置文件main.php中配置
     * $moduleId = app-backend
     * $controllerId site
     * $actionId index
     * @param $action
     * @return string
     */
    public function getPermissionName($action)
    {
        $appId = \Yii::$app->id;
        $moduleId = $action->controller->module->id;
        $controllerId = $action->controller->id;
        $actionId = $action->id;

        // 如果模块名和应用名相等,则本身不包含其它模块
        if ($appId == $moduleId) {
            return '/' . $controllerId . '/' . $actionId;
        } else {
            return '/' . $moduleId . '/' . $controllerId . '/' . $actionId;
        }
    }

    /**
     * 使用系统提供的Yii::$app->getUser()->can($permissionName) 方法检查权限
     * @param string $permissionName 权限资源标识
     * @return bool
     */
    public function checkAccess($permissionName)
    {
        // 如果是root账号,直接返回真
        if ($this->root()) {
            return true;
        }
        $user = \Yii::$app->getUser();
        $routeList = explode('/', $permissionName);
        // /moduleId/ControllerId/actionId
        if (count($routeList) == 4) {
            $moduleId = $routeList[1];
            $controllerId = $routeList[2];
            return ($user->can('/' . $moduleId . '/*/*') || $user->can('/' . $moduleId . '/' . $controllerId . '/*')) ? true : false;
            // /controllerId/actionId
        } elseif (count($routeList) == 3) {
            $controllerId = $routeList[1];
            return $user->can('/' . $controllerId . '/*');
        } else {
            return $user->can($permissionName);
        }
    }

    /**
     * 系统管理员,账号ID = 1 或 角色包含有root的用户
     * @param string $role
     * @return bool
     */
    public function root($role = 'root')
    {
        $user = \Yii::$app->getUser()->getIdentity();
        // 第一个用户
        if ($user['id'] == 1 || $user['role'] == 1 || $user['level'] == 1) {
            return true;
        }
        // 角色包含root的用户
        $auth = \Yii::$app->getAuthManager();
        $roles = $auth->getRolesByUser($user['id']);
        $rolesList = \yii\helpers\ArrayHelper::getColumn($roles, 'name');
        return in_array($role, $rolesList);
    }
}
