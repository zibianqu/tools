<?php
/**
 * 文章模型
 * @author Administrator
 *
 */

namespace Admin\Model;
use Think\Model;
use Home\Logic\CommLogic;
class CommModel extends Model {
	
	public function __construct(){
		
	}
	
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
	 * 添加文章标签
	 * @param unknown $arr
	 * @return stdClass
	 */
	public static function addKeyWord($arr){
		if(empty($arr['name'])){
			return Re(true,'添加失败');
		}
		$arr['recordtime']=time();
		$do='add';
		if(isset($arr['id']) && $arr['id']>0){
			$do='save';
		}
		if(M('keywords')->$do($arr)){
			return Re(true,$do.' success');
		}else{
			return Re(true,$do.' fail');
		}
	}
	
	/**
	 * 文章标签列表
	 * @param unknown $arr
	 * @param unknown $pageIndex
	 * @return multitype:string unknown
	 */
	public static function keyWordList($arr,$pageIndex){
		$pageSize=C('NUMBER_DISPLAY');
		$list = M('keywords')->where($arr)->order('`order` asc,num desc')->page($pageIndex.','.$pageSize)->select();
		$count      = M('keywords')->where($arr)->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,$pageSize);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		return array('list'=>$list,'page'=>$show);
	}
	
	/**
	 * 删除文章标签
	 * @param unknown $id
	 * @return stdClass
	 */
	public static function deleteKeyWord($id){
		$arr['id']=$id;
		$res=M('keywords')->where($arr)->find();
		if(empty($res)){
			return Re(false,'不存在文章');
		}
		if(M('keywords')->where($arr)->delete()){
			return Re(true,'删除成功');
		}else{
			return Re(false,'删除失败');
		}
	}
	
	/**
	 * 批量删除文章标签
	 * @param unknown $num1
	 * @param unknown $num2
	 * @return stdClass
	 */
	public static function deleteLotSizeKeyWord($num1,$num2){
		if(($num1<1 && $num2<1) || ($num1>$num2)){
			return Re(false,'删除失败');
		}
		if($num1>0)$arr['num']=array('egt',$num1);
		if($num2>0)$arr['num']=array('elt',$num2);
		$arr['order']=array('eq',20);
		if(M('keywords')->where($arr)->delete()){
			return Re(true,'删除成功');
		}else{
			return Re(false,'删除失败');
		}
	}
	
	/**
	 * 清除缓存
	 * @param unknown $default
	 * @param unknown $redis
	 */
	public static function clearCache($default,$redis){
		if($default){
			unlinkDir($_SERVER['DOCUMENT_ROOT'].'/Application/Runtime/Cache/Home');
		}
		if($redis){
			$comml=new CommLogic();
			$comml->drop_redisCache();//清除redis缓存
		}
	}
	
	
	/**
	 * 将缓存数据同步到数据库
	 * @param unknown $redis
	 */
	public static function syschroData($redis){
		if($redis){
			$comml=new CommLogic();
			$comml->save_readNum();//同步阅读数
		}
	}
	
}