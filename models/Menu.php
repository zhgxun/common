<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property integer $pid
 * @property string $label
 * @property string $url
 * @property integer $sortorder
 * @property string $content
 * @property integer $status
 * @property integer $ctime
 * @property integer $utime
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'sortorder', 'status', 'ctime', 'utime'], 'integer'],
            [['label', 'url'], 'required'],
            [['label'], 'string', 'max' => 64],
            [['url'], 'string', 'max' => 255],
            [['content'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pid' => 'Pid',
            'label' => 'Label',
            'url' => 'Url',
            'sortorder' => 'Sortorder',
            'content' => 'Content',
            'status' => 'Status',
            'ctime' => 'Ctime',
            'utime' => 'Utime',
        ];
    }
}
