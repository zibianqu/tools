<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',true);
//define('BIND_MODULE', 'Home');
// 定义应用目录
define('APP_PATH','./Application/');

// 最大数据 8K
define( 'WEBSOCKET_MAX', 1024 * 8 );

// 最大使用内存
define( 'WEBSOCKET_MEMORY', '1024M' );

// 最大同时在线数
define( 'WEBSOCKET_ONLINE', 1024 );

// HOST
define( 'WEBSOCKET_HOST', '127.0.0.1' );

// PORT
define( 'WEBSOCKET_PORT', 844 );

// 允许的域名
define( 'WEBSOCKET_DOMAIN', '' );

// api 的key
define( 'WEBSOCKET_KEY', 'Q#WHJGIOU*(&_}{:?PO-78SE#$%^&*()O' );

// 管理员密码
define( 'ADMIN_PASS', '123456' );

ignore_user_abort( true );
set_time_limit( 0 );
ini_set( 'memory_limit', WEBSOCKET_MEMORY );

$_REQUEST['c']='ChatServer';
$_REQUEST['a']='index';
$_GET['c']='ChatServer';
$_GET['a']='index';
// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单