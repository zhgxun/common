<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sentence".
 *
 * @property integer $id
 * @property string $title
 * @property string $author
 * @property string $quote
 * @property string $content
 * @property integer $status
 * @property integer $ctime
 * @property integer $utime
 */
class Sentence extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sentence';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['status', 'ctime', 'utime'], 'integer'],
            [['title', 'quote'], 'string', 'max' => 120],
            [['author'], 'string', 'max' => 64],
            [['content'], 'string', 'max' => 255]
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
            'author' => 'Author',
            'quote' => 'Quote',
            'content' => 'Content',
            'status' => 'Status',
            'ctime' => 'Ctime',
            'utime' => 'Utime',
        ];
    }
}
