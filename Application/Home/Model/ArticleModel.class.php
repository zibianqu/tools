<?php
/**
 * 文章模型
 * @author Administrator
 *
 */

namespace Home\Model;
use Think\Model;
use Home\Logic\CommLogic;
class ArticleModel extends Model {
	private $M;
	public function __construct(){
		$this->M=M('article');
	}
	
	/**
	 * 根据id获取文章
	 * @param unknown $id 文章id
	 * @return Ambigous <\Home\Model\Ambigous, string, \Home\Model\mixed, mixed, \Think\mixed, boolean, NULL, multitype:, unknown, object>|Ambigous <\Home\Model\Ambigous, \Think\mixed, boolean, NULL, multitype:, mixed, unknown, string, object>
	 */
	public function get($id){
		$id=intval($id);//转化一下
		switch (C('CACHE_TYPE')){//缓存方式
			case 'redis':
				return $this->redis_get($id);
			default:
				return $this->_get($id);			
		}
	}
	
	/**
	 * 根据id获取文章，获取redis缓存，redis中没有则获取数据库的数据
	 * @param unknown $id 文章id
	 * @return Ambigous <string, \Home\Model\mixed, mixed, \Think\mixed, boolean, NULL, multitype:, unknown, object>
	 */
	private function redis_get($id){
		$redis=new RedisModel();
		$res='';
		if($redis->hash_hExists('article', $id)){//判断文章是否已经保存到redis
			$res= $redis->hash_hGet('article', $id);
		}else{
			$res=$this->_get($id);//获取文章
			if($res['id']>0)$redis->hash_hSet('article', $id, $res);//查询出结果放入redis中
		}
		return $res;
	}
	
	/**
	 * 根据id获取文章，数据库中获取
	 * @param unknown $id 文章id
	 * @return Ambigous <\Think\mixed, boolean, NULL, multitype:, mixed, unknown, string, object>
	 */
	private function _get($id){
		$arr['id']=$id;
		return $this->M->where($arr)->find();
	}
	
	/**
	 * 根据id获取文章   过时的方法
	 * @param unknown $id
	 * @return Ambigous <\Think\mixed, boolean, NULL, multitype:, mixed, unknown, string, object>
	 */
	public function old_get($id){
		$arr['id']=$id;
		switch (C('CACHE_TYPE')){//缓存方式
			case 'redis':
				$redis=new RedisModel();
				$res='';
				if($redis->hash_hExists('article', $id)){//判断文章是否已经保存到redis
					$res= $redis->hash_hGet('article', $id);
				}else{
					$res=$this->M->where($arr)->find();
					if($res['id']>0)$redis->hash_hSet('article', $id, $res);//查询出结果放入redis中
				}
				return $res;
			default:
				return $this->M->where($arr)->find();
				break;
		}
		
	}
	
	/**
	 * 获取相关文章
	 * @param unknown $id
	 * @param unknown $t
	 * @return string
	 */
	public function getRelated($id,$t){
		switch ($t){
			case 'prev':
				return $this->M->field('id,title')->where('id<'.$id.' and status=1')->order('id desc')->limit(1)->select();
			case 'next':
				return $this->M->field('id,title')->where('id>'.$id.' and status=1')->order('id asc')->limit(1)->select();
			case 'recom':
				return $this->M->field('id,title')->where('id<>'.$id.' and status=1 and recom=1')->order('id desc')->limit(C('NUMBER_RECOM'))->select();
			default:
				return '';
		}		
	} 

	/**
	 * 修改阅读数
	 * @param unknown $id
	 */
	public function old_readNum($id){
		$res=$this->get($id);
		$res['readnum']+=1;
		switch (C('CACHE_TYPE')){//缓存方式,下面为修改方式
			case 'redis':
				$redis=new RedisModel();
				$redis->hash_hSet('article', $id, $res);
				break;
			default:
				$this->M->save($res);
				break;
		}
	}
	
	/**
	 * 修改文章阅读数
	 * @param unknown $id 文章id
	 */
	public function readNum($id){
		$id=intval($id);//转化一下
		switch (C('CACHE_TYPE')){//缓存方式,下面为修改方式
			case 'redis':
				$this->redis_readNum($id);
				break;
			default:
				$this->_readNum($id);
				break;
		}
	}
	
	/**
	 * 修改文章阅读数，保存到redis
	 * @param unknown $id 文章id
	 */
	private function redis_readNum($id){
		$res=$this->get($id);//获取文章
		$res['readnum']+=1;//将阅读数+1
		$redis=new RedisModel();
		$redis->hash_hSet('article', $id, $res);
		$redis->list_lRem(readNum, 0, $id);
		$redis->list_rPush('readNum', $id);
	}
	
	/**
	 * 修改文章的阅读数,保存到数据库
	 * @param unknown $id 文章id
	 */
	private function _readNum($id){
		$res=$this->get($id);//获取文章
		$res['readnum']+=1;//将阅读数+1
		$this->M->save($res);
	}
	
	
	/**
	 * 保存数据
	 * @param unknown $arr
	 * @return number|Ambigous <boolean, unknown>
	 */
	public function saveData($arr=array()){
		if(empty($arr)){
			return -1;
		}
		return $this->M->save($arr);
	}

	/**
	 * 获取文章
	 * @param unknown $arr
	 * @param string $order
	 * @param number $limit
	 */
	public function lists($arr,$order='id desc',$limit=6){
		return $this->M->where($arr)->order($order)->limit($limit)->select();
	}
	
	
	/**
	 * 分页获取文章列表
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
	
	/**
	 * 异步获取列表
	 * @param unknown $arr
	 * @param unknown $pageIndex
	 */
	public function asyncLists($arr,$pageIndex){
		$pageSize=C('NUMBER_DISPLAY');//每页显示数量
		$list = $this->M->where($arr)->order('id desc')->page($pageIndex.','.$pageSize)->select();//获取文章
		$art_html='<li><div class="l_a_div"><p class="l_a_title">art_title</p><p class="l_a_time">art_date</p><p class="l_a_content">art_content</p><p class="l_a_read"><a href="art_url">阅读全文</a></p></div></li>';
		foreach ($list as $key=>$val){//给每篇文章添加链接
			$list[$key]['url']=U('/art/article',array('id'=>$val['id']));
			$list[$key]['createtime']=date('Y-m-d',$val['createtime']);
			$list[$key]['content']=cut_str(strip_html_tags($val['content']), 1500);
		}
		$html_conf=array('html'=>$art_html,'data'=>$list,'fields'=>array('title'=>'/art_title/i','createtime'=>'/art_date/i','content'=>'/art_content/i','url'=>'/art_url/i'));
		$comml=new CommLogic();
		return $comml->parse_html($html_conf);
	}
}