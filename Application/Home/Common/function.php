<?php
/**
 * 模块类公用方法
 */

/**
 * 返回菜单信息
 * @param unknown $name 方法名
 * @param unknown $int	1：一级菜单key，2：一级菜单名，3：二级菜单名，4：二级菜单url，5：返回二级菜单数组
 * @return Ambigous <mixed, void, NULL, multitype:>|Ambigous <>|number
 */
function returnMenu($name,$int){
	$types=C('type');
	$two_type=C('two_type');//所有二级菜单分类
	foreach ($two_type as $key=>$val){
		if(empty($val))continue;
		foreach ($val as $k=>$v){
			if($name===$v['function']){
				if($int===1){
					return $key;
				}else if($int===2){
					return $types[$key];
				}else if($int===3){
					return $v['name'];
				}else if($int===4){
					return $v['url'];
				}else {
					return $v;
				}
			}
		}
	}
	return 0;
}

/**
 * 返回工具菜单
 * @param unknown $key
 * @return string
 */
function toolsMenu($key){
	$two_type=C('two_type');//所有二级菜单分类
	if(empty($two_type[$key]))return '';
	$menu_html='';
	foreach ($two_type[$key] as $k=>$v){
		$menu_html.='<a href="'.U('/tools/'.$v['function']).'" class="button- button--wayra">'.$v['name'].'</a>';
	}
	return $menu_html;
}

/**
 * 返回推荐工具菜单数组
 * @return multitype:Ambigous <mixed, void, NULL, multitype:>
 */
function toolsRecom(){
	$two_type=C('two_type');//所有二级菜单分类
	$recom=array();
	foreach ($two_type as $val){
		foreach ($val as $v){
			if($v['recom']==1){
				$recom[]=$v;
			}
		}
	}
	return $recom;
}

//写入日志
function writelog($data,$t=1){
	if($t==1)$log='log.txt';
	if($t==2)$log=date('Y-m-d H:i:s').'_log.txt';
	$path='./Public/files/log/'.$log;
	file_put_contents($path, $data,FILE_APPEND);
}

