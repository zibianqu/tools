<?php
/**
 * 模块类公用方法
 */


/**
 * 操作后需要返回的东西
 * @param string $status
 * @param string $msg
 * @param string $data
 * @return stdClass
 */
function Re($status=true,$msg='',$data=null){
	$std=new stdClass();
	$std->status=$status;
	if(!empty($msg))$std->msg=$msg;
	if(!empty($data))$std->data=$data;
	return $std;
}
