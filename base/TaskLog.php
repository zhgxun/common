<?php

namespace common\base;

/**
 * 日志类
 *
 * @package common\base
 */
class TaskLog
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
     * 记录日志文件
     *
     * @param mixed $log 日志字串
     * @param string $dir 目录路径
     * @return bool
     */
    public function writeLog($log, $dir = 'logs')
    {
        $path = \Yii::$app->getRuntimePath();
        $file = date("Y-m-d") . '.log';
        $logPath = $path . DIRECTORY_SEPARATOR . $file;
        if ($dir) {
            // 是否存在windows目录分隔符
            if (strpos($dir, '\\') !== false) {
                $dir = str_replace('\\', '/', $dir);
            }
            $dir = trim($dir, '/');
            $logPath = $path . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $file;
        }
        // 需要手动给父类目录设置写权限
        if (!file_exists($logPath)) {
            touch($logPath);
            chmod($logPath, 0777);
        }
        if (is_array($log) || is_object($log)) {
            $log = \yii\helpers\Json::encode($log);
        }
        $msg = date('H:i:s | ') . $log . PHP_EOL;

        return error_log($msg, 3, $logPath);
    }
}
