<?php
/**
 * 通用逻辑层模型
 * @author Administrator
 *
 */

namespace Home\Logic;
use Think\Model;
use Home\Model\RedisModel;
use Home\Model\ArticleModel;
class CommLogic extends model {
	
	public function __construct(){}
	
	/**
	 * 搜索时间限制
	 * @return boolean
	 */
	public function searchTime(){
		$time=time();
		//echo ($time-$_COOKIE['st']);
		if(!isset($_COOKIE['st'])){
			setcookie('st',$time,$time+1000);
			$_COOKIE['st']=$time;
			return true;
		}else{
			if(($time-$_COOKIE['st'])<30){
				return false;
			}else{
				setcookie('st',$time,$time+1000);
				$_COOKIE['st']=$time;
				return true;
			}
		}
	}
	
	
	/**
	 * 修改文章阅读数
	 * @param unknown $id 文章id
	 */
	public function recordReakNum($id){
		$id=intval($id);
		switch (C('CACHE_TYPE')){//缓存方式,下面为修改方式
			case 'redis':
				$this->redis_recordReadNum($id);
				break;
			default:
				$this->_recordReadNum($id);
				break;
		}
	}
	
	/**
	 * 限制客户端无限制请求修改阅读数  redis开启的情况
	 * @param unknown $id 文章id
	 */
	private function redis_recordReadNum($id){
		$key=md5('rn'.getIP().'_'.$id);//每个客户端对应一个key
		$redis=new RedisModel();
		if($redis->hash_hExists('recordReadNum', $key) && $redis->hash_hGet('recordReadNum', $key)===date('Ymd')){
			//判$key是否存在且今天是否已经记录
			//echo $key.'    '.$redis->hash_hGet(__FUNCTION__, $key);
		}else{
			$art=new ArticleModel();
			$art->readnum($id);
			$redis->hash_hSet('recordReadNum', $key, date('Ymd'));
		}
	}
	
	/**
	 * 限制客户端无限制请求修改阅读数,用cookie记录
	 * @param unknown $id 文章id
	 */
	private function _recordReadNum($id){
		$key=md5('rn'.getIP().'_'.$id);//每个客户端对应一个key
		if(isset($_COOKIE[$key]) && $_COOKIE[$key]===date('Ymd')){
			//判$key是否存在且今天是否已经记录
		}else{
			$art=new ArticleModel();
			$art->readnum($id);
			setcookie($key,date('Ymd'));
			$_COOKIE[$key]=date('Ymd');
		}
	}
	
	/**
	 * 保存redis的名称 ，方便清楚缓存清楚时用
	 * @param unknown $name
	 */
	public function save_cacheName($name){
		$redis=new RedisModel();
		$redis->list_rPushx('cache_name', $name);
	}
	
	private function save_hashName(){
		$arr=array('article','recordReadNum');
				
	}

	/**
	 * 保存文章阅读数
	 */
	public function save_readNum(){
		$redis=new RedisModel();
		$arr=$redis->list_lRange('readNum', 0, -1);
		$article=new ArticleModel();
		foreach ($arr as $val){
			$article->saveData($article->get($val));
		}
	}
	
	/**
	 * 删除redis
	 */
	public function drop_redisCache(){
		$arr=array('article','recordReadNum');
		$redis=new RedisModel();
		$redis->del($arr);
	}
	
	/**
	 * 解析html数据
	 * $arr=array('html'=>$art_html,'fields'=>array('title'=>'','date'=>'','content'=>'','url'=>''),'data'=>$data);
	 * explain $art_html：需要替换html代码、fields：键，规定需要替换的字段、值，替换正则、replace：1 根据数组字段来判断替换，2根据数据库字段判断替换
	 * @param unknown $arr 数组
	 * @return string 返回字符串
	 */
	public function parse_html($arr){
		$html='';
		if(empty($arr['data']))return $html;//判断数据是否为空
		foreach ($arr['data'] as $key=>$val){
			$art_html=$arr['html'];
			foreach ($arr['fields'] as $k=>$v){
				$art_html= preg_replace($v, $val[$k], $art_html);//将数据嵌套html上
			}
			$html.=$art_html;
		}
		return $html;
	}
	
}