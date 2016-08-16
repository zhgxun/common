<?php

namespace common\base;

class Helper
{
    public static $instance;

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * 过滤邮箱
     * @param string $email 要过滤的邮箱
     * @return mixed
     */
    public function isEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * 控制台输出显示
     * @param mixed $input 输入值
     * @param mixed $exit 是否退出
     */
    public function echoLn($input, $exit = 0)
    {
        if (is_string($input)|| is_numeric($input)) {
            echo $input . PHP_EOL;
        } else if (is_array($input)) {
            print_r($input);
        } else {
            var_dump($input);
        }
        if ($exit) {
            exit();
        }
    }

    /**
     * 获取文件名
     * @param string $filePath 文件路径
     * @return string
     */
    public function getFileName($filePath)
    {
        $fileName = basename($filePath);
        return substr($fileName, 0, strrpos($fileName, '.'));
    }

    /**
     * 生成一个随机字符串
     * @param int $length 生成的字符串长度
     * @param int $type 使用的字符类型
     * @return string
     */
    public static function getRandString($length = 8, $type = 3)
    {
        switch ($type) {
            //小写字母加数字  剔除了一些 易混淆字符
            case 1:
                $chars = ['2','3','4','5','6','7','8','9','a','b','c','d','e','f','g','h','i','j','k','m','n','p','q','r','s','t','u','v','w','x','y','z'];
                break;
            //字母 + 数字
            case 2:
                $chars = [ 'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O', 'P','Q','R','S','T','U','V','W','X','Y','Z', '0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
                break;
            //字母 + 数字 + 部分特殊符号
            case 3:
                $chars = ['0','1','2','3','4','5','6','7','8','9', 'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O', 'P','Q','R','S','T','U','V','W','X','Y','Z', '!','@','#','$','%','^','&','*','(',')','_','-','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o', 'p','q','r','s','t','u','v','w','x','y','z'];
                break;
            //数字
            case 4:
                $chars = ['0','1','2','3','4','5','6','7','8','9'];
                break;
            //小写字母
            case 5:
                $chars = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o', 'p','q','r','s','t','u','v','w','x','y','z'];
                break;
            //字母 + 数字   剔除了一些 易混淆字符
            default:
                $chars = ['A','B','C','D','E','F','G','H','J','K','L','M','N','P','R','S','T','U','V','W','X','Y','2','3','4','5','6','7','8','9','a','b','c','d','e','f','g','h','i','j','k','l','m','n','p','q','r','s','t','u','v','w','x','y','z'];
        }
        $count = count($chars) - 1;
        $str = '';
        for($i=0; $i < $length; $i++) {
            $str .= $chars[mt_rand(0, $count)];
        }
        return $str;
    }

    /**
     * 生成密码
     * @param string $password 输入密码
     * @param int $cost 加密强度
     * @return string
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function getPassword($password, $cost = 15)
    {
        return \Yii::$app->security->generatePasswordHash($password, $cost);
    }
}
