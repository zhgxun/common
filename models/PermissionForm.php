<?php

namespace common\models;

use yii\base\Model;

class PermissionForm extends Model
{
    public $name;
    public $description;
    public $isNewRecord;

    public function rules()
    {
        return [
            [['name', 'description'], 'string', 'max' => 32]
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '资源唯一标识符',
            'description' => '资源描述',
        ];
    }
}
