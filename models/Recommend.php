<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "recommend".
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property string $source
 * @property integer $type
 * @property string $content
 * @property integer $status
 * @property integer $ctime
 * @property integer $utime
 */
class Recommend extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recommend';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'url', 'source'], 'required'],
            [['type', 'status', 'ctime', 'utime'], 'integer'],
            [['title', 'source'], 'string', 'max' => 120],
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
            'source' => 'Source',
            'type' => 'Type',
            'content' => 'Content',
            'status' => 'Status',
            'ctime' => 'Ctime',
            'utime' => 'Utime',
        ];
    }
}
