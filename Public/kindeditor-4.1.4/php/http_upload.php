<?php 

$srcs=isset($_REQUEST['srcs'])?$_REQUEST['srcs']:'';
$res=array('status'=>0,'data'=>array());//初始化返回数组
$return_srcs=array();
if(empty($srcs)){
	exit(json_encode($res));
}
// $http_path = 'http://'.$_SERVER['HTTP_HOST'].'/Public/files/images/'; 
$time=time();
$timepath=date('Y',$time).'/'.date('m',$time).'/'.date('d',$time).'/';
$http_path = '/Public/files/images/'.$timepath;				
$upload_path=$_SERVER['DOCUMENT_ROOT'].'/Public/files/images/'.$timepath; 	// 存放上传图片的目录
foreach($srcs as $key=>$val) {
	$filename=getRandChar(15);
	$filename=GrabImage($val['k'],$upload_path,$filename);
	$return_srcs[$key]['value'] =$http_path.$filename;//图片保存的路径目录
}

$res['status']=1;
$res['data']=$return_srcs;

//生成随机字符串
function getRandChar($length){
	$str = null;
	$strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz".time();
	$max = strlen($strPol)-1;
	for($i=0;$i<$length;$i++){
		$str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
	}
	return $str;
}

/*
 *@$url string 远程图片地址
 *@$dir string 目录，可选 ，默认当前目录（相对路径）
 *@$filename string 新文件名，可选
*/
function GrabImage($url, $dir='', $filename=''){
	
	if(empty($url)){
		return false;
	}
	$ext = strrchr($url, '.');
// 	if($ext != '.gif' && $ext != ".jpg" && $ext != ".bmp"){
// 		echo "格式不支持！";
// 		return false;
// 	}
	//为空就当前目录
	if(empty($dir))$dir = './';
	//
// 	$dir = realpath($dir);
	if (!file_exists($dir)){ 
		mkdir ($dir,0777,true); 
	} 
		
	
	//目录+文件
	$filepath = $dir . (empty($filename) ? time().$ext :$filename.$ext);
	//开始捕捉
	ob_start();
	readfile($url);
	$img = ob_get_contents();
	ob_end_clean();
	$size = strlen($img);
	$fp2 = fopen($filepath , "a");
	fwrite($fp2, $img);
	fclose($fp2);
	return (empty($filename) ? time().$ext : $filename.$ext);
}

/*
 *功能：php完美实现下载远程图片保存到本地
*参数：文件url,保存文件目录,保存文件名称，使用的下载方式
*当保存文件名称为空时则使用远程文件原来的名称
*/
function getImage($url,$save_dir='',$filename='',$type=0){
	if(trim($url)==''){
		return array('file_name'=>'','save_path'=>'','error'=>1);
	}
	if(trim($save_dir)==''){
		$save_dir='./';
	}
	if(trim($filename)==''){//保存文件名
		$ext=strrchr($url,'.');
		if($ext!='.gif'&&$ext!='.jpg'){
			return array('file_name'=>'','save_path'=>'','error'=>3);
		}
		$filename=time().$ext;
	}
	if(0!==strrpos($save_dir,'/')){
		$save_dir.='/';
	}
	//创建保存目录
	if(!file_exists($save_dir)&&!mkdir($save_dir,0777,true)){
		return array('file_name'=>'','save_path'=>'','error'=>5);
	}
	//获取远程文件所采用的方法
	if($type){
		$ch=curl_init();
		$timeout=5;
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
		$img=curl_exec($ch);
		curl_close($ch);
	}else{
		ob_start();
		readfile($url);
		$img=ob_get_contents();
		ob_end_clean();
	}
	//$size=strlen($img);
	//文件大小
	$fp2=@fopen($save_dir.$filename,'a');
	fwrite($fp2,$img);
	fclose($fp2);
	unset($img,$url);
	return array('file_name'=>$filename,'save_path'=>$save_dir.$filename,'error'=>0);
}
exit(json_encode($res));
?>