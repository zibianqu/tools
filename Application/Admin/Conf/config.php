<?php
return array(
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
				'__JS__' => __ROOT__ . '/Public/admin/js',
				'__CSS__' => __ROOT__ . '/Public/admin/css',
				'__IMAGES__' => __ROOT__ . '/Public/admin/images',
				//'__DATA__' => __ROOT__ . '/Data/'
		),
	'DEFAULT_FILTER'        =>  'htmlspecialchars,strip_tags,stripslashes',
	'NUMBER_DISPLAY'=>10,
);