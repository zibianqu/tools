<?php
/**
 * 操作
 * @author Administrator
 *
 */
namespace Home\Controller;
use Think\Controller;
class DoController extends Controller {
    public function index(){
       // $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
       //$this->display();
       exit;
    }
    
    /**
     * 保存二维码操作
     */
    public function savepng(){
    	$data=I('data');
    	$format=I('format');
    	$filename=I('filename');
    	header('Content-type: image/png');
     	header("Content-Disposition: attachment; filename='$filename'");
    	echo base64_decode($data);
    }
    
    /**
     * 下载文件
     */
    public function download(){
    	$filename=I('fn');
    	$type=I('t');
    	$url= './Public';
    	$path='';
    	if($type=='img'){//下载图片
    		$path="files/images/";
    	}
    	$url.='/'.$path.$filename;
    	header('Content-type: image/png');
     	header("Content-Disposition: attachment; filename='$filename'");
     	readfile($url);
    }
    
}