<?php 
namespace Tool;
class QrcodeTool{
	function __construct(){
		include_once 'phpqrcode/phpqrcode.php';
	}
	function png($text, $outfile = false, $level = QR_ECLEVEL_L, $size = 3, $margin = 4, $saveandprint=false){
		return \QRcode::png($text, $outfile = false, $level = QR_ECLEVEL_L, $size = 3, $margin = 4, $saveandprint=false);
	}
}

?>