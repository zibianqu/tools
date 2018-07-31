<?php
$web_config=array(
	//'配置项'=>'配置值'
	
		
// 	'DB_TYPE'   => 'mysql', // 数据库类型
// 	'DB_HOST'   => '115.28.20.111', // 服务器地址
// 	'DB_NAME'   => 'tools', // 数据库名
// 	'DB_USER'   => 'fcl', // 用户名
// 	'DB_PWD'    => 'fcl160830', // 密码
// 	'DB_PORT'   => 3306, // 端口
		
		
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => 'localhost', // 服务器地址
	'DB_NAME'   => 'tuers', // 数据库名
	'DB_USER'   => 'root', // 用户名
	'DB_PWD'    => 'root', // 密码
	'DB_PORT'   => 3306, // 端口
	'TMPL_PARSE_STRING' => array(
			'__PUBLIC__' => __ROOT__ . '/Public',
			'__JS__' => __ROOT__ . '/Public/js',
			'__CSS__' => __ROOT__ . '/Public/css',
			'__IMAGES__' => __ROOT__ . '/Public/images',
			//'__DATA__' => __ROOT__ . '/Data/'
	),
	'TMPL_CACHE_ON'   => false,  // 默认开启模板编译缓存 false 的话每次都重新编译模板
	'ACTION_CACHE_ON'  => false,  // 默认关闭Action 缓存
	'HTML_CACHE_ON'   => false,   // 默认关闭静态缓存
	'NUMBER_DISPLAY'=>6,
	'NUMBER_RECOM'=>6,
	'LOAD_EXT_FILE' => 'chat',
	
	//微信开发者id
	//'appID'=>'wxae2e16eca74f73cf',
	//'appsecret'=>'e8cf389c9168140edf5df5d49a7d7262',
	//微信测试号
	'appID'=>'wx1d77f6f0ba41dc95',
	'appsecret'=>'ba63d1f3a2fae9601731f39b37f552fe',
		
);

$menu_config=include 'menu.php';

return array_merge($web_config,$menu_config);
