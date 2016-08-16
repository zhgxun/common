<?php

namespace common\base;

class User
{
    public static $instance;
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public $level = [
        ['type' => 1, 'description' => '系统'],
        ['type' => 2, 'description' => '测试'],
    ];

    public function getLevelKV()
    {
        return \yii\helpers\ArrayHelper::map($this->level, 'type', 'description');
    }

    public function getNameByLevel($level)
    {
        $levelList = $this->getLevelKV();
        return isset($levelList[$level]) ? $levelList[$level] : '未知';
    }

    public function getById($id)
    {
        $row = \common\models\User::findOne(intval($id));
        return $row ? $row->toArray() : null;
    }

    public function getNameById($id)
    {
        $row = $this->getById($id);
        return isset($row['username']) ? $row['username'] : '未知';
    }

    /**
     * 通过用户名获取用户信息
     * @param string $userName 用户名
     * @return array|null|\yii\db\ActiveRecord
     */
    public function getByUserName($userName)
    {
        $query = \common\models\User::find();
        $query->where(' `username` = :username', [
            ':username' => trim(strip_tags($userName)),
        ]);
        $one = $query->one();
        return $one;
    }

    /**
     * 通过邮箱获取用户信息
     * @param string $email 邮箱
     * @return array|null|\yii\db\ActiveRecord
     */
    public function getByEmail($email)
    {
        $query = \common\models\User::find();
        $query->where(' `email` = :email', [
            ':email' => trim(strip_tags($email)),
        ]);
        $one = $query->one();
        return $one;
    }
}
