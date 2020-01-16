<?php


namespace learn\workerman\channel;


use Channel\Server;

class ChannelService
{

    /**
     * @var Server
     */
    private static $service;

    /**
     * 监听地址
     * @var string
     */
    const LISTENHOST = '0.0.0.0';

    /**
     * 监听端口
     * @var string
     */
    const LISTENPORT = 1995;

    /**
     * construct
     * ChannelService constructor.
     */
    public function __construct()
    {
        self::start(self::LISTENHOST,self::LISTENPORT);
    }

    /**
     * 启动
     * @param string $ip
     * @param int $port
     */
    public static function start($ip = '0.0.0.0', $port = 1996)
    {
        self::$service = new Server($ip, $port);
    }
}