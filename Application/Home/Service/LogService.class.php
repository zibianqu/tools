<?php 

/**
 * 日志文件操作服务类
 * @author Administrator
 *
 */
namespace Home\Service;
use Think\Model;
class LogService extends Model {
	private $path='';
	
	public function __construct(){
		self::setPath($this->path);
	}
	
	/**
	 * 设置path的路径
	 */
	public function setPath(&$path){
		if($path==''){
			if(!empty(C('DEFINE_LOG_PATH'))){
				$path=C('DEFINE_LOG_PATH');
				if(!is_dir($path)){//判断目录是否存在不存在则创建
					if(!FileUtilService::createDir($path))die('error：日志存放地址错误！');
				}
			}else{
				die('未配置日志存放地址！');
			}
		}
	}
	
	/**
	 * 写入系统日志文件
	 * @param unknown $info
	 * @return number
	 */
	static function writelog($info){
		self::setPath($path);
		$file=$path.date('Ymd').'.log';//系统文件路径
		if(!file_exists($file))FileUtilService::createFile($file);
		return file_put_contents($file, $info."\r\n",FILE_APPEND);
	}
	
	/**
	 * 写入特定日志文件
	 * @param unknown $path
	 * @param unknown $info
	 * @return number
	 */
	static function writelogbypath($path,$info){
		if(is_file($path)){
			return file_put_contents($path, $info."\r\n",FILE_APPEND);
		}else{
			FileUtilService::createFile($path);
			$this->writelogbypath($path, $info);
		}
	}
	
}
?>