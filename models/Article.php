<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $title
 * @property integer $type
 * @property string $content
 * @property integer $userid
 * @property integer $readcount
 * @property string $remark
 * @property integer $status
 * @property integer $ctime
 * @property integer $utime
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['type', 'userid', 'readcount', 'status', 'ctime', 'utime'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 120],
            [['remark'], 'string', 'max' => 255]
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
            'type' => 'Type',
            'content' => 'Content',
            'userid' => 'Userid',
            'readcount' => 'Readcount',
            'remark' => 'Remark',
            'status' => 'Status',
            'ctime' => 'Ctime',
            'utime' => 'Utime',
        ];
    }
}
