<?php 

/**
 * 截取字符串
 * @param unknown $str
 * @param number $start
 * @param unknown $length
 * @param string $charset
 * @param string $suffix
 * @return string|unknown
 */
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=false){
	if(function_exists("mb_substr")){
		if($suffix)
			return mb_substr($str, $start, $length, $charset)."...";
		else
			return mb_substr($str, $start, $length, $charset);
	}elseif(function_exists('iconv_substr')) {
		if($suffix)
			return iconv_substr($str,$start,$length,$charset)."...";
		else
			return iconv_substr($str,$start,$length,$charset);
	}
	$re['utf-8'] = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef][x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
	$re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
	$re['gbk'] = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
	$re['big5'] = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";
	preg_match_all($re[$charset], $str, $match);
	$slice = join("",array_slice($match[0], $start, $length));
	if($suffix) return $slice."…";
	return $slice;
}


/**
 * 获取客户端ip
 */
function getIP(){
	global $ip;
	if (getenv("HTTP_CLIENT_IP"))
		$ip = getenv("HTTP_CLIENT_IP");
	else if(getenv("HTTP_X_FORWARDED_FOR"))
		$ip = getenv("HTTP_X_FORWARDED_FOR");
	else if(getenv("REMOTE_ADDR"))
		$ip = getenv("REMOTE_ADDR");
	else $ip = "Unknow";
	return $ip;
}

//ip统计
function statisticsip(){
	$arr['ip']=getIP();
	$arr['date']=date('Ymd');
	$res=M('statisticsip')->where($arr)->find();
	if(!empty($res)){
		return ;
	}
	$arr['recordtime']=time();
	if(M('statisticsip')->add($arr)){
		setcookie('stt',1,(strtotime(date('Y-m-d',strtotime('+1 day'))-time())));
		$_COOKIE['stt']=1;
	}
}


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



/**
 *	解析 header
 *
 *	1 参数 header
 *	2 参数 key是否转换成小写
 *
 *	返回值 数组
 **/
function parse_header( $html = '', $strtolower = false ) {
	if ( !$html ) {
		return array();
	}
	$html = str_replace( "\r\n", "\n", $html );
	$html = explode( "\n\n", $html, 2 );
	$header = explode( "\n", $html[0] );
	$r = array();
	foreach ( $header as $k => $v ) {
		if ( $v ) {
			$v = explode( ':', $v, 2 );
			if( isset( $v[1] ) ) {
				if ( $strtolower ) {
					$v[0] = strtolower( $v[0] );
				}

				if ( substr( $v[1],0 , 1 ) == ' ' ) {
					$v[1] = substr( $v[1], 1 );
				}
				$r[trim($v[0])] = $v[1];
			} elseif ( empty( $r['status'] ) && preg_match( '/^(HTTP|GET|POST)/', $v[0] ) ) {
				$r['status'] = $v[0];
			} else {
				$r[] = $v[0];
			}
		}
	}
	if ( !empty( $html[1] ) ) {
		$r['html'] = $html[1] ;
	}
	return $r;
}



/**
 *	字符串转换成数组
 *
 *	1 参数 输入GET类型字符串
 *
 *	返回值 GET数组
 **/
function string_turn_array( $s ) {
	if( is_array( $s ) ) {
		return $s;
	}
	parse_str( $s, $r );
	if( get_magic_quotes_gpc() ) {
		$r = stripslashes_array( $r );
	}
	return $r;
}


/**
 *	stripslashes 取消转义 数组
 *
 *	1 参数 输入数组
 *
 *	返回值 处理后的数组
 **/
function stripslashes_array( $value ) {
	if ( is_array( $value ) ) {
		$value = array_map( __FUNCTION__, $value );
	} elseif ( is_object( $value ) ) {
		$vars = get_object_vars( $value );
		foreach ( $vars as $key => $data ) {
			$value->{$key} = stripslashes_array( $data );
		}
	} else {
		$value = stripslashes( $value );
	}
	return $value;
}


/**
 *	数组转换成字符串
 *
 *	1 参数 数组
 *
 *	返回值 GET字符串
 **/
function array_turn_string( $array = '' ) {
	if( !is_array( $array ) ) {
		return $array;
	}
	return http_build_query( $array );
}

/**
 * 	二维数组去重
 *
 * 	arr参数	数组
 *
 * 	name参数	二维数组中的键名
 *
 * 	返回数组
 */
function two_array_unique($arr,$name=0){

	if(!is_array($arr) || count($arr)<1)return $arr;
	$arr_new=$arr;
	foreach ($arr as $key=>$val){
		$re=0;
		foreach ($arr_new as $k=>$v){
			if($val[$name]==$v[$name]){
				$re++;
			}
			if($re>1){
				unset($arr_new[$k]);
				$re=1;
			}
		}
	}

	return $arr_new;
}

/**
 *	添加 锁定
 *
 *	1 参数 锁定 keys
 **/
function add_lock( $keys, $wait = false ) {
	global $_lock;

	// 如果 $_lock 没变量 就 创建
	if ( !isset( $_lock ) ) {
		$_lock = array();
	}

	// 如果有 keys 就返回false
	if ( isset( $_lock[$keys] ) ) {
		return false;
	}


	// 打开文件
	$_lock[$keys]['file'] = $_SERVER['DOCUMENT_ROOT'].'/Public/files/lock/'. md5( $keys ) . '.txt';
	$_lock[$keys]['data'] = fopen( $_lock[$keys]['file'], 'w+' );

	// 锁定文件
	if ( $wait ) {
		$is = flock( $_lock[$keys]['data'], LOCK_EX );
	} else {
		$is =true;// flock( $_lock[$keys]['data'], LOCK_EX|LOCK_NB );
	}

	if( !$is ) {
		fclose( $_lock[$keys]['data'] );
		unset( $_lock[$keys] );
		return false;
	}

	return true;
}


/**
 * 删除指定的标签和内容
 * @param array  $tags 需要删除的标签数组
 * @param string $str 数据源
 * @param boole  $content 是否删除标签内的内容 默认为false保留内容  true不保留内容
 * @return string
 */
function strip_html_tags($str,$tags=array(),$content=false){
	if(empty($tags)){
		$tags=array('a','abbr','acronym','address','applet','area','article','aside','audio','b','base','basefont','bdi','bdo','big','blockquote','body','br','button','canvas','caption','center','cite','code','col','colgroup','command','datalist','dd','del','details','dfn','dialog','dir','div','dl','dt','em','embed','fieldset','figcaption','figure','font','footer','form','frame','frameset','h1','h6','head','header','hr','html','i','iframe','img','input','ins','kbd','keygen','label','legend','li','link','main','map','mark','menu','menuitem','meta','meter','nav','noframes','noscript','object','ol','optgroup','option','output','p','param','pre','progress','q','rp','rt','ruby','s','samp','script','section','select','small','source','span','strike','strong','style','sub','summary','sup','table','tbody','td','textarea','tfoot','th','thead','time','title','tr','track','tt','u','ul','var','video','wbr');
	}
	if($content){
		$html=array();
		foreach ($tags as $tag) {
			$html[]='/(<'.$tag.'.*?>[\s|\S]*?<\/'.$tag.'>)/';
		}
		$data=preg_replace($html,'',$str);
	}else{
		$html=array();
		foreach ($tags as $tag) {
			$html[]="/(<(?:\/".$tag."|".$tag.")[^>]*>)/i";
		}
		
		$data=preg_replace("/(<(?:\/p|p)[^>]*>)/i", '', htmlspecialchars_decode($str));
	}
	return strip_tags($data);
}

/**
 * 截取字符串
 * @param unknown $string
 * @param unknown $sublen
 * @param number $start
 * @param string $code
 * @return string
 */
function cut_str($string, $sublen, $start = 0, $code = 'UTF-8')
{ 	$string= strip_tags($string);
if($code == 'UTF-8')
{
	$pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
	preg_match_all($pa, $string, $t_string);

	if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen));
	return join('', array_slice($t_string[0], $start, $sublen));
}
else
{
	$start = $start*2;
	$sublen = $sublen*2;
	$strlen = strlen($string);
	$tmpstr = '';

	for($i=0; $i< $strlen; $i++)
	{
	if($i>=$start && $i< ($start+$sublen))
	{
	if(ord(substr($string, $i, 1))>129)
		{
			$tmpstr.= substr($string, $i, 2);
		}
		else
			{
				$tmpstr.= substr($string, $i, 1);
		}
		}
		if(ord(substr($string, $i, 1))>129) $i++;
		}
		//if(strlen($tmpstr)< $strlen ) $tmpstr.= "...";
		return $tmpstr;
		}

		}

/**
 * 删除文件夹
 *
 * @param string $aimDir
 * @return boolean
 */
function unlinkDir($aimDir) {
	$aimDir = str_replace('', '/', $aimDir);
	$aimDir = substr($aimDir, -1) == '/' ? $aimDir : $aimDir . '/';
	if (!is_dir($aimDir)) {
		return false;
	}
	$dirHandle = opendir($aimDir);
	while (false !== ($file = readdir($dirHandle))) {
		if ($file == '.' || $file == '..') {
			continue;
		}
		if (!is_dir($aimDir . $file)) {
			unlinkFile($aimDir . $file);
		} else {
			unlinkDir($aimDir . $file);
		}
	}
	closedir($dirHandle);
	return rmdir($aimDir);
}

/**
 * 删除文件
 *
 * @param string $aimUrl
 * @return boolean
 */
function unlinkFile($aimUrl) {
	if (file_exists($aimUrl)) {
		unlink($aimUrl);
		return true;
	} else {
		return false;
	}
}


?>