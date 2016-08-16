<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "link".
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property string $content
 * @property integer $status
 * @property integer $ctime
 * @property integer $utime
 */
class Link extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'url'], 'required'],
            [['status', 'ctime', 'utime'], 'integer'],
            [['title'], 'string', 'max' => 120],
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
            'title' => 'Title',
            'url' => 'Url',
            'content' => 'Content',
            'status' => 'Status',
            'ctime' => 'Ctime',
            'utime' => 'Utime',
        ];
    }
}
