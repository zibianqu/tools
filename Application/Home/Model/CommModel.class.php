<?php
/**
 * 文章模型
 * @author Administrator
 *
 */

namespace Home\Model;
use Think\Model;
class CommModel extends Model {
	
	public function __construct(){}
	/**
	 * 添加或者修改查询的关键字
	 * @param unknown $name
	 * @return void|boolean
	 */
	public function keyWord($name){
		if(empty($name))return;
		if(strlen($name)>50)return ;
		$arrc['name']=$name;
		$arr=M('keywords')->where($arrc)->find();
		$do='add';
		if(!empty($arr)){
			$do='save';
			$arr['num']=$arr['num']+1;
		}else{
			$arr['name']=$name;
			$arr['num']=1;
		}
		$arr['recordtime']=time();
		if(M('keywords')->$do($arr)){
			return true;
		}else{
			return false;
		}
	}
	
	
	/**
	 * 查询关键字列表
	 * @param number $limit
	 * @return unknown
	 */
	public function keyWordList($limit=10){
		$res=M('keywords')->where(array())->order('`order` asc,num desc')->limit($limit)->select();
		return $res;
	}
	
}