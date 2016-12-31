<?php

namespace common\models\task;

use Yii;

/**
 * This is the model class for table "{{%task_detail}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $task_id
 * @property string $command
 * @property string $parameters
 * @property string $data_year
 * @property string $task_status
 * @property string $start_date
 * @property string $end_date
 * @property string $error_log
 * @property string $out_log
 * @property string $report_log
 */
class TaskDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%task_detail}}';
    }

    /**
     * @return null|object
     */
    public static function getDb()
    {
        return Yii::$app->get('task');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'task_id'], 'integer'],
            [['parameters', 'task_status', 'error_log', 'out_log', 'report_log'], 'string'],
            [['start_date', 'end_date'], 'safe'],
            [['command'], 'string', 'max' => 255],
            [['data_year'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => '父进程id',
            'task_id' => '任务id',
            'command' => '命令名',
            'parameters' => '参数',
            'data_year' => '查询数据年份',
            'task_status' => '任务状态执行中/结束/错误/',
            'start_date' => '任务开始时间',
            'end_date' => '任务结束时间',
            'error_log' => '错误日志',
            'out_log' => '正常日志',
            'report_log' => '报告',
        ];
    }
}
