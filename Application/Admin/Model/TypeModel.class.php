<?php
/**
 * 文章模型
 * @author Administrator
 *
 */

namespace Admin\Model;
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
	public function save($arr){
		$do=isset($arr['id'])?'save':'add';
		if($this->M->$do($arr)){
			return Re(true,'操作成功');
		}else{
			return Re(false,'操作失败	error:'.$this->M->getDbError());
		}
	}
	
	/**
	 * 删除分类(non-PHPdoc)
	 * @see \Think\Model::delete()
	 */
	public function delete($id){
		$arr['id']=$id;
		$res=$this->get($id);
		if(empty($res)){
			return Re(false,'不存在该分类');
		}
		if($this->M->where($arr)->delete()){
			return Re(true,'删除成功');
		}else{
			return Re(false,'删除失败');
		}
	}
	
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
	public function lists($arr){
		 return $this->M->where($arr)->order('`order` asc,id asc')->select();
	}
	
	
}