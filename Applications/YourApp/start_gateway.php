<?php 
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
use \Workerman\Worker;
use \Workerman\WebServer;
use \GatewayWorker\Gateway;
use \GatewayWorker\BusinessWorker;
use \Workerman\Autoloader;

// 自动加载类
require_once __DIR__ . '/../../vendor/autoload.php';

//// gateway 进程，这里使用Text协议，可以用telnet测试
//$gateway = new Gateway("tcp://0.0.0.0:8282");
//// gateway名称，status方便查看
//$gateway->name = 'YourAppGateway';
//// gateway进程数
//$gateway->count = 4;
//// 本机ip，分布式部署时使用内网ip
//$gateway->lanIp = '127.0.0.1';
//// 内部通讯起始端口，假如$gateway->count=4，起始端口为4000
//// 则一般会使用4000 4001 4002 4003 4个端口作为内部通讯端口
//$gateway->startPort = 2900;
//// 服务注册地址
//$gateway->registerAddress = '127.0.0.1:1238';

$gateway_tcp        = new Gateway("tcp://0.0.0.0:3344");
$gateway_tcp->name  = 'gateway_userinfo';
$gateway_tcp->count = 2;
$gateway_tcp->lanIp = '127.0.0.1';
// 施永杰: 要求改为15分钟检测 2018-07-23
$gateway_tcp->pingInterval          = 300;    // if live then 45s
$gateway_tcp->pingNotResponseLimit  = 2;        // 30s*2=60s no response dead (after 2min)
$gateway_tcp->pingData              = '';       // client has heart beat
$gateway_tcp->startPort             = 14000;
$gateway_tcp->registerAddress       = '127.0.0.1:1238';// 服务注册地址


/**
 *  新增55250端口，开启socket连接
 */
$gateway_wss                         = new Gateway("websocket://0.0.0.0:8086");
$gateway_wss->name                   = 'gateway_wss_web';
$gateway_wss->count                  = 2;
$gateway_wss->lanIp                  = '127.0.0.1';
$gateway_wss->startPort              = 15000;
$gateway_wss->pingInterval           = 60;
$gateway_wss->pingNotResponseLimit   = 2;
$gateway_wss->pingData               = '{"type":"pong"}';
$gateway_wss->registerAddress        = '127.0.0.1:1238';

// 心跳间隔
//$gateway->pingInterval = 10;
// 心跳数据
//$gateway->pingData = '{"type":"ping"}';

/* 
// 当客户端连接上来时，设置连接的onWebSocketConnect，即在websocket握手时的回调
$gateway->onConnect = function($connection)
{
    $connection->onWebSocketConnect = function($connection , $http_header)
    {
        // 可以在这里判断连接来源是否合法，不合法就关掉连接
        // $_SERVER['HTTP_ORIGIN']标识来自哪个站点的页面发起的websocket链接
        if($_SERVER['HTTP_ORIGIN'] != 'http://kedou.workerman.net')
        {
            $connection->close();
        }
        // onWebSocketConnect 里面$_GET $_SERVER是可用的
        // var_dump($_GET, $_SERVER);
    };
}; 
*/

// 如果不是在根目录启动，则运行runAll方法
if(!defined('GLOBAL_START'))
{
    Worker::runAll();
}

