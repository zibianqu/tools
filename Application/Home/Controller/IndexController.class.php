<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\ArticleModel;
use Home\Service\WxTokenService;
use Home\Service\WeiXinService;
class IndexController extends Controller {
	function _initialize(){
		$this->assign('nav',1);
	}
    public function index(){
       $kaifa=toolsMenu(1);
       $this->assign('kaifa',$kaifa);
       $zz=toolsMenu(2);
       $this->assign('zz',$zz);
       $bm=toolsMenu(3);
       $this->assign('bm',$bm);
       $art=new ArticleModel();
       $arr['status']=1;
       $newart=$art->lists($arr);
       $hotart=$art->lists($arr,'readnum desc,id desc');
       $this->assign('newart',$newart);
       $this->assign('hotart',$hotart);
       
       //推荐工具菜单
       $recomtool=toolsRecom();
       $this->assign('recomtool',$recomtool);
       $this->display();
    }
    
    public function tq(){
    	$this->display();
    }
    
    public function return_curl(){
    	echo  $_SERVER["REMOTE_ADDR"];
    	exit('欢迎访问！') ;
    }
    
    /**
     * 联系我
     */
    public function contact(){
    	$this->display();
    }
    
    
    /**
     * 微信token验证
     */
    public function wxtoken(){
    	$ws=new WeiXinService();
    	$ws->sendTemplateId('ozEamv2YinHLw0ZT7RFPFqYgRrqg');
    	exit;
    	$wxtk=new WxTokenService();
    	$wxtk->valid();
    }
    
    /**
     * 微信测试
     */
    public function wxtest(){
    	$APPID=C('appID');
    	$APPSECRET=C('appsecret');
    	$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$APPID}&secret={$APPSECRET}";
    	$res=file_get_contents($url);
    	var_export($res);
    }
}