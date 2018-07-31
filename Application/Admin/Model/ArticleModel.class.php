<?php
/**
 * 文章模型
 * @author Administrator
 *
 */

namespace Admin\Model;
use Think\Model;
class ArticleModel extends Model {
	private $M;
	public function __construct(){
		$this->M=M('article');
	}
	
	/**
	 * 根据id获取文章
	 * @param unknown $id
	 * @return Ambigous <\Think\mixed, boolean, NULL, multitype:, mixed, unknown, string, object>
	 */
	public function get($id){
		$arr['id']=$id;
		return $this->M->where($arr)->find();
	}
   
	/**
	 * 添加修改保存文章(non-PHPdoc)
	 * @see \Think\Model::save()
	 */
	public function save($arr){
		$arr['createtime']=time();
		$do=isset($arr['id'])?'save':'add';
		if($this->M->$do($arr)){
			return Re(true,'操作成功');
		}else{
			return Re(false,'操作失败	error:'.$this->M->getDbError());
		}
	}
	
	/**
	 * 删除文章(non-PHPdoc)
	 * @see \Think\Model::delete()
	 */
	public function delete($id){
		$arr['id']=$id;
		$res=$this->get($id);
		if(empty($res)){
			return Re(false,'不存在文章');
		}
		if($this->M->where($arr)->delete()){
			return Re(true,'删除成功');
		}else{
			return Re(false,'删除失败');
		}
	}
	
	/**
	 * 对文章进行显示、隐藏操作
	 * @param unknown $arr
	 * @return stdClass
	 */
	public function status($arr){
		if($arr['status']>3 || $arr['status']<0){
			return Re(false,'操作失败');
		}
		$res=$this->get($arr['id']);
		if(empty($res)){
			return Re(false,'不存在文章');
		}
		if($this->M->save($arr)){
			return Re(true,'操作成功');
		}else{
			return Re(false,'操作失败	error:'.$this->M->getDbError());
		}
		
	}
	
	/**
	 * 列表查询
	 * @param unknown $arr
	 */
	public function lists($arr){
		return $this->M->where($arr)->order('id desc')->select();
	}
	
	/**
	 * 分页列表查询
	 * @param unknown $arr
	 * @param unknown $pageIndex
	 * @return multitype:string unknown
	 */
	public function listsPage($arr,$pageIndex){
		// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
		$pageSize=C('NUMBER_DISPLAY');
		$list = $this->M->where($arr)->order('id desc')->page($pageIndex.','.$pageSize)->select();
		$count      = $this->M->where($arr)->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,$pageSize);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		return array('list'=>$list,'page'=>$show);
	}
}