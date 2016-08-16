<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "navigation".
 *
 * @property integer $id
 * @property string $label
 * @property string $url
 * @property string $content
 * @property integer $status
 * @property integer $ctime
 * @property integer $utime
 */
class Navigation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'navigation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'ctime', 'utime'], 'integer'],
            [['label'], 'string', 'max' => 64],
            [['url', 'content'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'label' => 'Label',
            'url' => 'Url',
            'content' => 'Content',
            'status' => 'Status',
            'ctime' => 'Ctime',
            'utime' => 'Utime',
        ];
    }
}
