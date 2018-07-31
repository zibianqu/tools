<?php 
/**
 * 文章类
 * @author Administrator
 *
 */
namespace Home\Controller;
use Think\Controller;
use Home\Model\ArticleModel;
use Home\Model\CommModel;
use Home\Logic\CommLogic;
class ArtController extends Controller{
	function _initialize(){
		$this->assign('nav',2);
	}
	
	/**
	 * 文章列表
	 */
	public function lists(){
		$c=isset($_REQUEST['c'])?$_REQUEST['c']:'';
		if(!empty($c)){
			$comml=new CommLogic();
			if($comml->searchTime()){
				echo 1;exit;
			}else{
				echo 0;exit;
			}
		}
		$pageIndex=isset($_REQUEST['p'])?intval($_REQUEST['p']):0;
    	$title=isset($_REQUEST['t'])?I('t'):'';
    	$type=isset($_REQUEST['ty'])?intval($_REQUEST['ty']):0;
    	
    	$comm=new CommModel();
    	$comm->keyWord($title);
    	$article=new ArticleModel();
    	if(!empty($title))$arr['title']=array('like','%'.$title.'%');
    	if(!empty($title))$arr['keyword']=array('like','%'.$title.'%');
    	if($type>0)$arr['type']=$type;
    	$arr['_logic'] = 'or';
    	$data=$article->listsPage($arr, $pageIndex);
    	$this->assign('lists',$data['list']);
    	$this->assign('title',$title);
    	$this->assign('page',$data['page']);
    	$res=$comm->keyWordList(20);
    	$this->assign('keyword',$res);
    	$this->display();
	}
	
	/**
	 * 异步获取文章列表
	 */
	public function async_lists(){
		$pageIndex=isset($_REQUEST['p'])?intval($_REQUEST['p']):0;
		$title=isset($_REQUEST['t'])?I('t'):'';
		$comm=new CommModel();
		$comm->keyWord($title);
		$article=new ArticleModel();
		if(!empty($title))$arr['title']=array('like','%'.$title.'%');
		if(!empty($title))$arr['keyword']=array('like','%'.$title.'%');
		$arr['_logic'] = 'or';
		$html=$article->asyncLists($arr, $pageIndex);
		$this->ajaxReturn($html);
	}
	
	/**
	 * 文章
	 */
	public function article(){
		$id=intval($_REQUEST['id']);
		$art=new ArticleModel();
		$res=$art->get($id);
		if(empty($res)){
			$this->error('404 很抱歉未找到该页面',U('/'));
			exit;
		}
		if($res['status']!=1){
			$this->error('404 很抱歉未找到该页面',U('/'));
		}
		$this->assign('art',$res);
		$comml=new CommLogic();
		$comml->recordReakNum($id);
		$prev=$art->getRelated($id, 'prev');
		$next=$art->getRelated($id, 'next');
		$recom=$art->getRelated($id, 'recom');
		$this->assign('prev',$prev[0]);
		$this->assign('next',$next[0]);
		$this->assign('recom',$recom);
		
		//推荐工具菜单
		$recomtool=toolsRecom();
		$this->assign('recomtool',$recomtool);
		$this->display('art');
	}
	
}
?>