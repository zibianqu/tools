<?php 
/**
 * 
 * @author Administrator
 *	curl服务类
 */
namespace Home\Service;
use Think\Model;
class CurlService extends Model{
	public function __construct(){}
	
	/**
	 +----------------------------------------------------------
	 | 访问认证中心，确认用户的合法身份
	 +----------------------------------------------------------
	 */
	public function getinfo($url,$par='',$method='get')
	{
	
		

		if($method=='get')
		{
			$par && $url.="?".$par;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt( $ch, CURLOPT_REFERER, "http://www.baidu.com" );
			curl_setopt($ch, CURLOPT_FAILONERROR, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 20);
		}
		elseif($method=='post')
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_REFERER, "http://www.baidu.com" );
			curl_setopt($ch, CURLOPT_FAILONERROR, true);
		    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		    curl_setopt($ch, CURLOPT_POSTFIELDS, $par);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
		}
		$output = curl_exec($ch);
// 		curl_error($ch);
		curl_close($ch);
		return $output;
	}
	
	public function send($url,$par,$domain="192.168.1.224")
	{
		$header = "POST $url HTTP/1.0\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($par) . "\r\n\r\n";
		$fp = @fsockopen ($domain, 80, $errno, $errstr, 30);
		fputs ($fp, $header . $par);
		fclose($fp);
	}
}
?>