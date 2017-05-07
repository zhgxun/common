<?php

namespace common\base;

/**
 * 处理进程PID文件
 * @package common\base
 */
class PidStatus
{
    /**
     * 进程和执行程序分隔符，比如 30374 : 启动 "./yii default/test"
     * 将被转化为 30374  default/test
     *
     * @var string 默认制表符
     */
    protected static $separate = '\t';

    /**
     * 将内容写入文件
     *
     * @param $pid
     * @param $name
     * @param $path
     */
    public static function write($pid, $name, $path)
    {
        file_put_contents($path, sprintf("%d%s%s\n", $pid, self::$separate, $name), FILE_APPEND);
    }

    /**
     * 读取内容
     *
     * @param $pid
     * @param $path
     * @return bool|mixed
     */
    public static function read($pid, $path)
    {
        $files = self::content($path);
        return isset($files[$pid]) ? $files[$pid] : false;
    }

    /**
     * 删除内容，并重写新内容
     *
     * @param $pid
     * @param $path
     */
    public static function delete($pid, $path)
    {
        $files = self::content($path);
        if (isset($files[$pid])) {
            unset($files[$pid]);
            self::reWrite($files, $path);
        }
    }

    /**
     * 以数组方式读取文件
     *
     * @param $path
     * @return array
     */
    public static function content($path)
    {
        $target = [];

        $list = file($path);
        foreach ($list as $value) {
            list($pid, $name) = explode(self::$separate, $value);
            // 相同命令只获取一次
            $target[$pid] = $name;
        }
        unset($list);

        return $target;
    }

    /**
     * 复写文件
     *
     * @param array $files
     * @param string $path
     */
    public static function reWrite($files = [], $path = '')
    {
        // 清空文件
        file_put_contents($path, '');

        foreach ($files as $pid => $name) {
            self::write($pid, $name, $path);
        }
    }
}
