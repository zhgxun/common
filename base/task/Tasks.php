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
     * 任务类型
     * @var array
     */
    public $taskType = [
        ['type' => 'crontab', 'description' => '定时任务'],
        ['type' => 'temporary', 'description' => '临时任务']
    ];

    /**
     * 任务状态
     * @var array
     */
    public $taskStatus = [
        ['type' => 'untreated', 'description' => '未处理'],
        ['type' => 'init', 'description' => '初始化'],
        ['type' => 'running', 'description' => '运行中'],
        ['type' => 'over', 'description' => '结束'],
    ];

    /**
     * 处理状态
     * @var array
     */
    public $auditStatus = [
        ['type' => 'untreated', 'description' => '未处理'],
        ['type' => 'pass', 'description' => '通过'],
        ['type' => 'forbid', 'description' => '禁止'],
    ];

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

    public function getTaskTypeKV()
    {
        return \yii\helpers\ArrayHelper::map($this->taskType, 'type', 'description');
    }

    public function getTaskTypeToDes($taskType)
    {
        $taskTypeList = $this->getTaskTypeKV();
        return isset($taskTypeList[$taskType]) ? $taskTypeList[$taskType] : '未知';
    }

    public function getTaskStatusKV()
    {
        return \yii\helpers\ArrayHelper::map($this->taskStatus, 'type', 'description');
    }

    public function getTaskStatusToDes($taskStatus)
    {
        $taskTypeList = $this->getTaskStatusKV();
        return isset($taskTypeList[$taskStatus]) ? $taskTypeList[$taskStatus] : '未知';
    }

    public function getAuditStatusKV()
    {
        return \yii\helpers\ArrayHelper::map($this->auditStatus, 'type', 'description');
    }

    public function getAuditStatusToDes($auditStatus)
    {
        $taskTypeList = $this->getAuditStatusKV();
        return isset($taskTypeList[$auditStatus]) ? $taskTypeList[$auditStatus] : '未知';
    }
}
