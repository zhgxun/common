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
    public static function isEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * 控制台输出显示
     * @param $input
     * @param int $exit
     */
    public static function echoLn($input, $exit = 0)
    {
        if (is_string($input)|| is_numeric($input)) {
            echo $input . PHP_EOL;
        } else if (is_array($input)) {
            print_r($input);
        } else {
            var_export($input);
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
    public static function getFileName($filePath)
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
        for ($i = 0; $i < $length; $i++) {
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
    public static function getPassword($password, $cost = 15)
    {
        return \Yii::$app->security->generatePasswordHash($password, $cost);
    }

    /**
     * 获取本机IP地址
     * @return null|string
     */
    public function getLocalIp()
    {
        static $ip = null;
        if (!$ip) {
            // debian
            $ip = exec("/sbin/ifconfig eth0 2>&1 | grep -E 'inet ' | awk '{split($2,a,\":\");print a[2]}'");
            // centos
            if (!$ip) {
                $ip = exec("/sbin/ifconfig em1 2>&1 | grep -E 'inet ' | awk '{split($2,a,\":\");print a[2]}'");
            }
            // mac
            if (!$ip) {
                $ip = exec("/sbin/ifconfig en0 | grep -E 'inet ' |  awk '{print $2}'");
            }
            if (!$ip) {
                $ip = exec("/sbin/ifconfig en1 | grep -E 'inet ' |  awk '{print $2}'");
            }
        }
        return $ip;
    }

    /**
     * 返回左闭合右开的时间区间
     *
     * @example
     * $startDate = '2016-10-01'
     * $endDate = '2016-10-03'
     * return 2016-10-01,2016-10-02
     * @param string $startDate 开始时间
     * @param string $endDate 结束时间
     * @return array
     */
    public function datesBetween($startDate, $endDate)
    {
        $date = array();
        $currentDate = $startDate;
        while ($currentDate != $endDate) {
            $date[] = $currentDate;
            $currentDate = date("Y-m-d", strtotime("+1 day", strtotime($currentDate)));
        }
        return $date;
    }

    /**
     * 返回上一天
     * @param string $date 当前日期
     * @return string
     */
    public function nextMonth($date)
    {
        return date("Y-m-d", strtotime("+1 month", strtotime($date)));
    }
}
