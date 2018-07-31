<?php 
/**
 * 工具类
 * @author Administrator
 *
 */
namespace Home\Controller;
use Think\Controller;
use Tool\QrcodeTool;
use Home\Model\IpLocationModel;
use Home\Model\ImgModel;
class ToolsController extends Controller{
	
	function _initialize(){
		$type_key=returnMenu(ACTION_NAME, 1);
		$menu_name=returnMenu(ACTION_NAME, 3);
		$menu_html=toolsMenu($type_key);
		$this->assign('menu_html',$menu_html);
		$this->assign('menu_name',$menu_name);
		$this->assign('nav',1);
	}
	
	/**
	 *	时间戳转换
	 */
	public function unixtime(){
		
		$this->display();
	}
	
	/**
	 * unicode编码转换
	 */
	public function unicode(){

		$this->display();
	}
	
	/**
	 * json格式化校验
	 */
	public function json(){
	
		$this->display();
	}
	
	/**
	 * js/html格式化
	 */
	public function jshtml(){
	
		$this->display();
	}
	
	/**
	 * 二维码生成
	 */
	public function qrcode(){
		$qr=new QrcodeTool();
		//$img=$qr->png('http://www.cnblogs.com/txw1958/p/phpqrcode.html',false);
// 		$this->assign('img',$img);
		$this->display();
	}
	
	/**
	 * 在线正则
	 */
	public function regex(){
		$this->display();
	}
	
	/**
	 * 获取ip或域名的归属地
	 */
	public function iplocation(){
		$ip=isset($_REQUEST['ip'])?$_REQUEST['ip']:getIP();
		if(preg_match('/^((https|http|ftp|rtsp|mms)?:\/\/)[^\s]+/i',$ip)){
			$Url=$ip;
			$tempu=parse_url($Url);
			$ip=$tempu['host'];
		}
		
		$ipl=new IpLocationModel();
		$res=$ipl->getlocation($ip);//域名或者ip
		if (!empty($_REQUEST['ip'])) {
			//exit(json_encode($res));
		}
		$this->assign('ip',$ip);
		$this->assign('res',$res);
		$this->display();
	}
	
	/**
	 * 房贷计算工具
	 */
	public function fdjsq(){
		$this->display();
	}
	
	/**
	 * 截图
	 */
	public function imgcrop(){
		$img=new ImgModel();
		$type=0;
		$upload=I("upload");
		if(!empty($upload)){
			$type=1;
		}
		$ut=I("upload_thumbnail");
		if(!empty($ut)){
			$type=2;
		}
		$arr[] = I('x1');
		$arr[] = I("y1");
		$arr[] = I("x2");
		$arr[] = I("y2");
		$arr[] = I("w");
		$arr[] = I("h");
		$filename=I("filename");
		$res=$img->upload($type,$filename,$arr);
		if(!empty($res['filename'])){
			$this->assign('filename',$res['filename']);
		}
		if(!empty($res['cropname'])){
			$this->assign('cropname',$res['cropname']);
		}
		$this->display();
	}
	
	/**
	 * 聊天室
	 */
	public function chat(){
		$this->display();
	}
	/**
	 * banner制作
	 */
	public function admaker(){
		$this->display();
	}
	
}
?>