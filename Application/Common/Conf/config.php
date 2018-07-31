<?php
return array(
	//'配置项'=>'配置值'
		'site_name'=>'我的工具,我的兔儿',
		//'MODULE_DENY_LIST'      =>  array('Common','Runtime','Api'),
		'MODULE_ALLOW_LIST'    =>    array('Home','Admin'),
		'DEFAULT_MODULE'=>'Home',
		'URL_HTML_SUFFIX'=>'.aspx',//后缀
		'DEFAULT_FILTER'        =>  'htmlspecialchars',
		'URL_CASE_INSENSITIVE' =>true,
		'URL_MODEL' => 2,//url模式
// 		'TMPL_EXCEPTION_FILE' => __ROOT__.'',
		'CACHE_TYPE'=>'defualt',  //默认default，目前有redis
		'DEFINE_LOG_PATH'=>'./Public/logs/',		
);