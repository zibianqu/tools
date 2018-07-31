<?php
/**
 * 文章模型
 * @author Administrator
 *
 */

namespace Home\Model;
use Think\Model;
class TypeModel extends Model {
	private $M;
	public function __construct(){
		$this->M=M('type');
	}
	
	/**
	 * 根据id获取分类
	 * @param unknown $id
	 * @return Ambigous <\Think\mixed, boolean, NULL, multitype:, mixed, unknown, string, object>
	 */
	public function get($id){
		$arr['id']=$id;
		return $this->M->where($arr)->find();
	}
   
	/**
	 * 添加修改保存分类(non-PHPdoc)
	 * @see \Think\Model::save()
	 */
	public function save($arr){}
	
	/**
	 * 删除分类(non-PHPdoc)
	 * @see \Think\Model::delete()
	 */
	public function delete($id){}
	
	/**
	 * 获取子级分类
	 * @param unknown $arr
	 * @param number $is_zuhe
	 * @return unknown|Ambigous <multitype:, unknown>
	 */
	function types($arr,$is_zuhe=1){
		if(empty($arr)){
			$arr[0]['id']=0;
		}
		$parent_id_str="";
		foreach ($arr as $key=>$val){
			if($parent_id_str==""){
				$parent_id_str.=$val['id'];
			}else{
				$parent_id_str.=','.$val['id'];
			}
		}
		$res=$this->get_type_by_parent($parent_id_str);
		if(!$is_zuhe)return $res;//这里直接返回查询出来的子级分类
		
		//组成新的数组
		$newarray=array();
		foreach ($arr as $a=>$aval){
			foreach ($res as $b=>$bval){
				if($aval['id']==$bval['parent_id'])
				$newarray[$aval['id']][]=$bval;
			}
		}
		return $newarray;
	}
	
	/**
	 * 根据父级ID获取分类
	 * @param unknown $parent_id_str
	 */
	function get_type_by_parent($parent_id_str){
		$arr['parent_id']=array("in",$parent_id_str);
		return $this->M->where($arr)->order('`order` asc,id asc')->select();
	}
	
	/**
	 * 分类列表查询
	 * @param unknown $arr
	 */
	public function lists($arr=array()){
		 return $this->M->where($arr)->order('`order` asc,id asc')->select();
	}
	
	
}