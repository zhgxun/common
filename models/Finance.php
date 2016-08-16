<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "finance".
 *
 * @property integer $id
 * @property integer $type
 * @property string $name
 * @property string $date
 * @property string $cost
 * @property string $content
 * @property integer $status
 * @property string $ctime
 * @property string $utime
 */
class Finance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'finance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'status'], 'integer'],
            [['date', 'ctime', 'utime'], 'safe'],
            [['name', 'cost'], 'string', 'max' => 120],
            [['content'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '理财记录主键',
            'type' => '理财类型1收入2消费',
            'name' => '消费或收入的项目名称',
            'date' => '记录日期',
            'cost' => '消费或收入数量',
            'content' => '备注',
            'status' => '状态1正常9删除',
            'ctime' => '创建时间',
            'utime' => '更新时间',
        ];
    }
}
