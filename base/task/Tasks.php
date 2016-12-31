<?php

namespace common\base\task;

use common\base\TaskLog;

class Tasks
{
    public static $instance;
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * 添加任务
     * @param array $data
     * @return bool|int
     */
    public function add($data = [])
    {
        $model = new \common\models\task\Tasks();
        $model->setAttributes($data);
        if ($model->save()) {
            $model->loadDefaultValues();
            return $model->id;
        }
        TaskLog::getInstance()->writeLog($model->getErrors());
        return false;
    }
}
