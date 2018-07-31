<?php 
/**
 * 菜单名称和url配置
 */
return array(
	'type'=>array(1=>'开发者工具',2=>'站长工具',3=>'便民工具',4=>'其他工具'),//工具分类
	'two_type'=>array(//二级菜单工具
		1=>array(
				array('function'=>'unixtime','name'=>'时间戳转换','url'=>'','recom'=>1),
				array('function'=>'unicode','name'=>'Unicode编码转换','url'=>'','recom'=>1),
				array('function'=>'json','name'=>'JSON校验','url'=>'','recom'=>1),
				array('function'=>'jshtml','name'=>'JS/HTML格式化','url'=>'','recom'=>1),
				array('function'=>'qrcode','name'=>'二维码生成','url'=>'','recom'=>1),
				array('function'=>'regex','name'=>'在线正则','url'=>'','recom'=>1),
		),
		2=>array(
				array('function'=>'iplocation','name'=>'ip/域名地址查询','url'=>'','recom'=>0),
		),
		3=>array(
				array('function'=>'fdjsq','name'=>'房贷计算器','url'=>'','recom'=>0),
				array('function'=>'imgcrop','name'=>'图片剪裁','url'=>'','recom'=>1),
				//array('function'=>'chat','name'=>'在线聊天','url'=>''),
				array('function'=>'admaker','name'=>'在线banner制作','url'=>'','recom'=>0),
		),
	),
);
?>