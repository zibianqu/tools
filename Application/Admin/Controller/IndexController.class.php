<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\AdminModel;
use Admin\Model\ArticleModel;
use Admin\Model\CommModel;
use Admin\Model\TypeModel;
class IndexController extends Controller {
	/**
	 * 初始化
	 */
	function __construct(){
		parent::__construct();
		if(!AdminModel::isLogin()){
			$this->redirect('/admin/login');
		}else{
			$this->assign('admin_name',$_SESSION['admin_']['user']);
		}
	}
	
	/**
	 * 首页
	 */
    public function index(){
        $this->display();
    }
    
    /**
     * 文章编辑
     */
    public function article(){
    	$id=isset($_REQUEST['id'])?intval($_REQUEST['id']):0;
    	$arr=array('id'=>0,'type'=>0,'title'=>'','keyword'=>'','author'=>'小兔','content'=>'');
    	$type=new TypeModel();
    	$tlist=$type->lists();
    	if($id>0){
    		$article=new ArticleModel();
    		$arr_article=$article->get($id);
    		if(!empty($arr_article))$arr=$arr_article;
    	}
    	$this->assign('tlist',$tlist);
    	$this->assign('a',$arr);
    	$this->display();
    }
    
    /**
     * 保存编辑的文章
     */
    public function SaveArticle(){
    	$arr['type']=I('type');
    	$arr['title']=I('title');
    	$arr['keyword']=I('keyword');
    	$arr['author']=I('author');
    	$arr['content']=I('content');
    	$id=intval(I('id'));
    	if($id>0){
    		$arr['id']=$id;
    	}    	
    	$imgurl=$this->upload();
    	if(!empty($imgurl))$arr['imgurl']=$imgurl;
    	$article=new ArticleModel();
    	$res=$article->save($arr);
    	$return=($res->status)?'success':'error';
    	$this->$return($res->msg,'',5);
    }
	
    /**
     * 上传图片
     * @return string
     */
    private function upload(){
    	$upload = new \Think\Upload();// 实例化上传类
    	$upload->maxSize   =     3145728 ;// 设置附件上传大小
    	$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    	$upload->rootPath  =     './Public/files/'; // 设置附件上传根目录
    	$upload->savePath  =     '/'; // 设置附件上传（子）目录
    	//echo $upload->rootPath;
    	$info   =   $upload->upload();
    	$_path='';
    	if(!$info) {// 上传错误提示错误信息
    		//$this->error($upload->getError());
    		return '';
    	}else{// 上传成功
    		foreach($info as $file){
    			$_path =  $upload->rootPath.$file['savepath'].$file['savename'];
    		}
    	}
    	return $_path;
    }
    
    
    /**
     * 文章列表
     */
    public function lists(){
    	$pageIndex=isset($_REQUEST['p'])?intval($_REQUEST['p']):0;
    	$title=isset($_REQUEST['t'])?I('t'):'';
    	$type=isset($_REQUEST['type'])?I('type'):'';
    	$article=new ArticleModel();
    	if(!empty($title))$arr['title']=array('like','%'.$title.'%');
    	if(!empty($type))$arr['type']=$type;
    	$data=$article->listsPage($arr, $pageIndex);
    	$typem=new TypeModel();
    	$tlist=$typem->lists();
    	$this->assign('type',$type);
    	$this->assign('tlist',$tlist);
    	$this->assign('lists',$data['list']);
    	$this->assign('page',$data['page']);
    	$this->assign('title',$title);
    	$this->display();
    }
    
    /**
     * 删除操作
     */
    public function delete(){
    	$id=intval(I('id'));
    	$article=new ArticleModel();
    	$res=$article->delete($id);
    	exit(json_encode($res));
    }
    
    /**
     * 显示、隐藏操作
     */
    public function status(){
    	$arr['id']=intval(I('id'));
    	$arr['status']=intval(I('status'));
    	$article=new ArticleModel();
    	$res=$article->status($arr);
    	exit(json_encode($res));
    }
    
    /**
     * 文章标签列表
     */
    public function keywordlists(){
    	$pageIndex=isset($_REQUEST['p'])?intval($_REQUEST['p']):0;
    	$title=isset($_REQUEST['t'])?I('t'):'';
    	if(!empty($title))$arr['name']=array('like','%'.$title.'%');
    	$num1=isset($_REQUEST['num1'])?intval($_REQUEST['num1']):0;
    	if($num1>0)$arr['num']=array('egt',$num1);
    	$num2=isset($_REQUEST['num2'])?intval($_REQUEST['num2']):0;
    	if($num2>0)$arr['num']=array('elt',$num2);
    	$data=CommModel::keyWordList($arr,$pageIndex);
    	$this->assign('lists',$data['list']);
    	$this->assign('page',$data['page']);
    	$this->assign('t',$title);
    	$this->assign('num1',$num1);
    	$this->assign('num2',$num2);
    	$this->display();
    }
    
    /**
     * 删除文章标签
     */
    public function deleteKeyWord(){
    	$id=intval(I('id'));
    	$res=CommModel::deleteKeyWord($id);
    	exit(json_encode($res));
    }
    
    /**
     * 添加文章标签
     */
    public function doKeyWord(){
    	$arr['name']=isset($_REQUEST['name'])?I('name'):'';
    	$arr['num']=isset($_REQUEST['num'])?intval($_REQUEST['num']):1;
    	$arr['order']=isset($_REQUEST['order'])?intval($_REQUEST['order']):1;
    	$id=isset($_REQUEST['keyid'])?intval($_REQUEST['keyid']):0;
    	if($id>0){
    		$arr['id']=$id;
    	}
    	$res=CommModel::addKeyWord($arr);
    	exit(json_encode($res));
    }
    
    /**
     * 批量删除文章标签
     */
    public function deleteLotSizeKeyWord(){
    	$num1=isset($_REQUEST['num1'])?intval($_REQUEST['num1']):0;
    	$num2=isset($_REQUEST['num2'])?intval($_REQUEST['num2']):0;
    	$res=CommModel::deleteLotSizeKeyWord($num1,$num2);
    	exit(json_encode($res));
    }
    
    
    /**
     * 清除缓存
     */
    public function clearCache(){
    	if(isset($_REQUEST['clear'])){
    		$default=isset($_REQUEST['default'])?intval($_REQUEST['default']):0;
    		$redis=isset($_REQUEST['redis'])?intval($_REQUEST['redis']):0;
    		$comm=new CommModel();
    		$comm->clearCache($default, $redis); 
    		$this->success('操作完成','',5);
    		exit;
    	}
    	$this->display();
    }
    /**
     * 同步数据
     */
    public function synchroData(){
    	if(isset($_REQUEST['synchro'])){
    		$redis=isset($_REQUEST['redis'])?intval($_REQUEST['redis']):0;
    		$comm=new CommModel();
    		$comm->syschroData($redis);
    		$this->success('操作完成','',5);
    		exit;
    	}
    	$this->display();
    }
    
    /**
     * 分类管理
     */
    public function typemanager(){
    	$type=new TypeModel();
    	$onetypes=$type->types($arr,0);
    	$twotypes=$type->types($onetypes);
    	$this->assign('onetypes',$onetypes);
    	$this->assign('twotypes',$twotypes);
    	$this->display();
    }
    
    /**
     * 分类编辑
     */
    public function type(){
    	$id=isset($_REQUEST['id'])?intval($_REQUEST['id']):0;
    	$arr=array('id'=>0,'name'=>'','parent_id'=>'','order'=>'100');
    	$type=new TypeModel();
    	$tlist=$type->lists();
    	if($id>0){
    		$arr_type=$type->get($id);
    		if(!empty($arr_type))$arr=$arr_type;
    	}
    	$this->assign('t',$arr);
    	$this->assign('tlist',$tlist);
    	$this->display();
    }
    
    /**
     * 保存编辑的分类
     */
    public function savetype(){
    	$arr['name']=I('name');
    	$arr['parent_id']=I('parent_id');
    	$arr['order']=I('order');
    	$id=intval(I('id'));
    	if($id>0){
    		$arr['id']=$id;
    	}
    	$type=new TypeModel();
    	$res=$type->save($arr);
    	$return=($res->status)?'success':'error';
    	$this->$return($res->msg,'',5);
    }
    
    /**
     * 删除文章标签
     */
    public function deletetype(){
    	$id=intval(I('id'));
    	$type=new TypeModel();
    	$res=$type->delete($id);
    	exit(json_encode($res));
    }
    
    
    
}