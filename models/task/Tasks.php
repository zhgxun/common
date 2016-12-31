<?php

namespace common\models\task;

use Yii;

/**
 * This is the model class for table "{{%tasks}}".
 *
 * @property integer $id
 * @property string $user_name
 * @property string $audit_name
 * @property string $task_type
 * @property string $ipaddress
 * @property string $code_branch
 * @property string $data_year
 * @property string $command
 * @property string $parameters
 * @property string $content
 * @property string $audit_date
 * @property string $task_status
 * @property string $audit_status
 * @property string $start_date
 * @property string $end_date
 * @property string $report
 * @property string $out_subscribe
 * @property string $error_subscribe
 * @property string $report_subscribe
 * @property string $out_file_path
 * @property string $error_file_path
 * @property string $report_file_path
 * @property string $ctime
 * @property string $utime
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tasks}}';
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
            [['task_type', 'parameters', 'task_status', 'audit_status', 'report', 'out_subscribe', 'error_subscribe', 'report_subscribe'], 'string'],
            [['ipaddress', 'code_branch', 'command'], 'required'],
            [['audit_date', 'start_date', 'end_date', 'ctime', 'utime'], 'safe'],
            [['user_name', 'audit_name'], 'string', 'max' => 50],
            [['ipaddress'], 'string', 'max' => 15],
            [['code_branch', 'command', 'content', 'out_file_path', 'error_file_path', 'report_file_path'], 'string', 'max' => 255],
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
            'user_name' => '创建任务人',
            'audit_name' => '审核者',
            'task_type' => '任务类型定时/临时',
            'ipaddress' => '执行任务主机IP地址',
            'code_branch' => '代码分支',
            'data_year' => '查询数据年份',
            'command' => '执行的命令',
            'parameters' => '命令参数',
            'content' => '备注',
            'audit_date' => '审核时间',
            'task_status' => '任务状态未处理/执行中/结束',
            'audit_status' => '审核状态通过/禁止',
            'start_date' => '任务开始时间',
            'end_date' => '任务结束时间',
            'report' => 'Report',
            'out_subscribe' => '正常输出发送者',
            'error_subscribe' => '异常发送者',
            'report_subscribe' => '报告发送者',
            'out_file_path' => '输出文件路径',
            'error_file_path' => '异常文件路径',
            'report_file_path' => '输出文件路径',
            'ctime' => '任务创建时间',
            'utime' => '任务修改时间',
        ];
    }
}
