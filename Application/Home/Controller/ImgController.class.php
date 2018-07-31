<?php
namespace Home\Controller;
use Think\Controller;
class ImgController extends Controller{
	function index(){
		$this->display();
	}
	
	function imgText(){
		$text = isset($_REQUEST['h_txt']) ? $_REQUEST['h_txt']:'';
		$fontSize = 20;
		$font = "Public/font/SIMSUN.TTC";	
		$txt_x = 2;
		//1图片外下方，2图片内下方，3图片外上方，4图片内上方
		$position = isset($_REQUEST['h_position']) ? $_REQUEST['h_position']:1;
		
		if(empty($text)){
			return "";
		}
		$path = "Public/images/file/".date("Ym")."/";
		if (!file_exists($path))
		{
			mkdir($path,'0777',true);
		}
		$fileName = $_FILES["Filedata"]["name"];
		$newFileName=str_replace(" ","",end(explode(".",microtime())));
		$newFile=$path.$newFileName.".".end(explode(".",$fileName));
		move_uploaded_file($_FILES['upload_file']['tmp_name'], $newFile);
		$img = $newFile;
		$im = imagecreatefromstring(file_get_contents($img));		
		$im_y = imagesy($im);
		$im_x = imagesx($im);	
		//文字自动换行
		for($i=1; $i < mb_strlen($text, 'utf8'); $i++) {
			$t = imagettfbbox($fontSize, 0, $font, mb_substr($text, 0, $i,'utf8'));
			if(($t[2] - $t[0]) > ($im_x-8)) {
				$r[] = mb_substr($text, 0, $i-1,'utf8');
				$text = mb_substr($text, $i-1, mb_strlen($text, 'utf8'),'utf8');
				$i = 1;
			}
		}		
		if(!empty($text)){
			$r[] = $text;
		}
		//计算文字的水平位置
		$arrText = imagettfbbox($fontSize, 0, $font, $r[0]);
		$textHeight = $arrText[1]-$arrText[5];
		$textHeight += 5;
		$lines = count($r);
		if($lines < 2){			
			$textWidth = $arrText[2]-$arrText[0];
			$txt_x = ceil ( ($im_x - $textWidth) / 2 );
		}else{
			$txt_x=2;
		}
		
		
		//文字位置
		switch ($position){
			case 1:
				$newimg = imagecreatetruecolor($im_x, $im_y+($lines*$textHeight));
				$bgcolor = imagecolorallocate($newimg, 0xff, 0xff, 0xff);
				imagefill($newimg, 0, 0, $bgcolor);
				imagecopy($newimg, $im, 0, 0, 0, 0, $im_x, $im_y);
				$txt_y = $im_y+$textHeight-5;
				$im = $newimg;
				break;
			case 2:
				$txt_y = $im_y-$lines*$textHeight;
				$black = imagecolorallocate($im, 0xff, 0xff, 0xff);
				break;
			case 3:
				$newimg = imagecreatetruecolor($im_x, $im_y+($lines*$textHeight));
				$bgcolor = imagecolorallocate($newimg, 0xff, 0xff, 0xff);
				imagefill($newimg, 0, 0, $bgcolor);
				imagecopy($newimg, $im, 0, $lines*$textHeight, 0, 0, $im_x, $im_y);
				$txt_y = $textHeight;
				$im = $newimg;
				break;
			case 4:
				$txt_y = $textHeight;
				$black = imagecolorallocate($im, 0xff, 0xff, 0xff);
				break;
			default:
				break;
		}
		
		$black = imagecolorallocate($im, 0x00, 0x00, 0x00);
		foreach($r as $i=>$v) {
			imagefttext($im,$fontSize, 0, $txt_x, $txt_y+$i*$textHeight, $black, $font, $v);
		}
		header("Content-type: text/html; charset=utf-8");
		imagepng($im,$newFile.'png');
		$newFile=__ROOT__.'/'.$newFile;
		echo "<img src=\"{$newFile}png\" />";
		
	}
	
	function test(){
		// Set the content-type
		header('Content-Type: image/png');
		
		// Create the image
		$im = imagecreatetruecolor(400, 30);
		
		// Create some colors
		$white = imagecolorallocate($im, 255, 255, 255);
		$grey = imagecolorallocate($im, 128, 128, 128);
		$black = imagecolorallocate($im, 0, 0, 0);
		imagefilledrectangle($im, 0, 0, 399, 29, $white);
		
		// The text to draw
		$text = 'Testing...';
		// Replace path by your own font path
		$font = 'arial.ttf';
		
		// Add some shadow to the text
		imagettftext($im, 20, 0, 11, 21, $grey, $font, $text);
		
		// Add the text
		imagettftext($im, 20, 0, 10, 20, $black, $font, $text);
		
		// Using imagepng() results in clearer text compared with imagejpeg()
		imagepng($im);
		imagedestroy($im);
	}
	

	
	function getpic(){		
		$file = $_REQUEST['img'];		
		header('Content-type: image/png');
		$file=ltrim($file,'/');
		header("Content-Disposition: attachment; filename='$file'");
		readfile($file);
	}
}