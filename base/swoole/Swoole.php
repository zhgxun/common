<?php

namespace common\base\swoole;

class Swoole
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
     * 返回服务器启动成功后swoole_server对象
     * $service->master_pid;  //主进程的PID，通过向主进程发送SIGTERM信号可安全关闭服务器
     * $service->manager_pid;  //管理进程的PID，通过向管理进程发送SIGUSR1信号可实现柔性重启
     * @return \swoole_server
     */
    public function connect()
    {
        $service = new \swoole_server('0.0.0.0', 9501);
        $service->set([
            'worker_num' => 2,
            'daemonize' => false,
            'max_request' => 100,
            'dispatch_mode' => 2,
            'debug_mode' => 1
        ]);

        $service->on('Start', [$this, 'onStart']);
        $service->on('Connect', [$this, 'onConnect']);
        $service->on('Receive', [$this, 'onReceive']);
        $service->on('Close', [$this, 'onClose']);
        $service->start();

        return $service;
    }

    /**
     * 服务器成功启动时回调，可以输出一些日志
     * @param \swoole_server $server
     */
    public function onStart(\swoole_server $server)
    {
        echo "Start...\n";
    }

    /**
     * 客户端成功连接时触发的回调
     * @param \swoole_server $server
     * @param int $fd 连接的描述符
     * @param int $fromId reactor的id，无用
     */
    public function onConnect(\swoole_server $server, $fd, $fromId)
    {
        $server->send($fd, "Hello, fd: {$fd}");
    }

    /**
     * 接收数据的回调
     * @param \swoole_server $service
     * @param int $fd
     * @param int $fromId
     * @param mixed $request 接收到的数据
     */
    public function onReceive(\swoole_server $service, $fd, $fromId, $request)
    {
        echo "Get message from client fd: {$fd}, requet: " . var_export($request);
    }

    /**
     * 连接关闭时的回调
     * @param \swoole_server $server
     * @param $fd
     * @param $fromId
     */
    public function onClose(\swoole_server $server, $fd, $fromId)
    {
        echo "Client fd:{$fd} close connection";
    }
}
