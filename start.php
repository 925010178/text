<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019\9\3 0003
 * Time: 15:56
 */
use \Workerman\Worker;
require_once __DIR__.'/vendor/autoload.php';

//$global_uid = 0;
//
//// 当客户端连上来时分配uid，并保存连接，并通知所有客户端
//function handle_connection($connection)
//{
//    global $text_worker, $global_uid;
//    file_put_contents('1.txt',$global_uid);
//    // 为这个连接分配一个uid
//    $connection->uid = ++$global_uid;
//    $connection->send(json_encode(['type'=>'connect','id'=>$connection->id]));
//}
//
//// 当客户端发送消息过来时，转发给所有人
//function handle_message($connection, $data)
//{
//
//    global $text_worker;
//    $data=json_decode($data,true);
//    foreach($text_worker->connections as $conn)
//    {
//        switch ($data['type']){
//            case 'login':
//                $conn->send(json_encode(['type'=>'login','id'=>$connection->id,'name'=>$data['name']]));
//                break;
//            case 'msg':
//                $conn->send(json_encode(['type'=>'msg','id'=>$connection->id,'name'=>$data['name'],'msg'=>$data['msg']]));
//                break;
//            case 'ping':
//                $conn->send(json_encode(['type'=>'ping','id'=>$connection->id,'name'=>$data['name']]));
//                break;
//        }
//    }
//}
//
//// 当客户端断开时，广播给所有客户端
//function handle_close($connection)
//{
//    global $text_worker;
//    foreach($text_worker->connections as $conn)
//    {
//        $conn->send(json_encode(['type'=>'logout','id'=>$connection->id]));
//    }
//}
//
//// 创建一个文本协议的Worker监听2347接口
//$text_worker = new Worker("websocket://0.0.0.0:2347");
//
//// 只启动1个进程，这样方便客户端之间传输数据
//$text_worker->count = 1;
//
//$text_worker->onConnect = 'handle_connection';
//$text_worker->onMessage = 'handle_message';
//$text_worker->onClose = 'handle_close';

Worker::runAll();