<?php

namespace common\models;

use yii\base\Model;

class RoleForm extends Model
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
            'name' => '角色唯一表示符',
            'description' => '角色描述',
        ];
    }
}
