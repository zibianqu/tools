<?php
/**
 * 文章模型
 * @author Administrator
 *
 */

namespace Home\Model;
use Think\Model;
class RedisModel extends Model {
	
	private $r;
	private $host='127.0.0.1';
	private $port='6379';
	private $hash_name='hash_name'; //保存hash表的name名称的hash表名称
	public function __construct($host='',$port=''){
		if(!empty($host)){
			$this->host=$host;
		}
		if(!empty($port)){
			$this->port=$port;
		}
		$this->connect();
	}
	
	/**
	 * 连接redis
	 */
	public function connect(){
		if(!isset($this->r)){
			$this->r=new \Redis();
			$this->r->connect($this->host,$this->port);
		}
		return $this->r;
	}
	
	/**
	 * hash表 名称为$name的hash中是否存在键名字为$key的域
	 * @param unknown $name
	 * @param unknown $key
	 */
	public function hash_hExists($name,$key){
		return $this->r->hExists($name, $key);
	}
	
	/**
	 * hash表 向名称为$name的hash中添加元素$key—>$value
	 * @param unknown $name
	 * @param unknown $key
	 * @param unknown $value
	 */
	public function hash_hSet($name,$key,$value){
		return $this->r->hSet($name, $key, json_encode($value,true));//这里的$val可能是数组，所以转成json格式 且整个项目的redis hash表的value都以json格式存储
	}
	
	
	/**
	 * hash表 返回名称为$name的hash中$key对应的$key（$value）
	 * @param unknown $name
	 * @param unknown $key
	 * @return mixed|string
	 */
	public function hash_hGet($name, $key){
		if($this->hash_hExists($name, $key)){
			return json_decode($this->r->hGet($name, $key),true);//这里的$val是json格式，整个项目的redis hash表存储的value都是以json格式存储，所以取出来的时候需要decode下
		}
		return '';
	}
	
	/**
	 * hash表 返回名称为$name的hash中元素个数
	 * @param unknown $name
	 */
	public function hash_hLen($name){
		return $this->r->hLen($name);
	}
	
	/**
	 * 删除名称为$name的hash中键为$key的域
	 * @param unknown $name
	 * @param unknown $key
	 */
	public function hash_hDel($name, $key){
		return $this->r->hDel($name, $key);
	}
	
	/**
	 * hash表 返回名称为$name的hash中所有键
	 * @param unknown $name
	 */
	public function hash_hKeys($name){
		return $this->r->hKeys($name);
	}
	

	/**
	 * hash表 返回名称为$name的hash中所有键对应的value
	 * @param unknown $name
	 * @return unknown|multitype:mixed
	 */
	public function hash_hVal($name){
		$hash_res=$this->r->hVals($name);
		if(empty($hash_res))return $hash_res;
		$res=array();
		foreach ($hash_res as $key=>$val){
			$res[$key]=json_decode($val,true);//这里的$val是json格式，整个项目的redis hash表存储的value都是以json格式存储，所以取出来的时候需要decode下
		}
		return $res;
	}
	

	/**
	 * hash表 返回名称为$name的hash中所有的键（field）及其对应的value
	 * @param unknown $name
	 * @return unknown|multitype:mixed
	 */
	public function hash_hGetAll($name){
		$hash_res=$this->r->hGetAll($name);
		if(empty($hash_res))return $hash_res;
		$res=array();
		foreach ($hash_res as $key=>$val){
			$res[$key]=json_decode($val,true);//这里的$val是json格式，整个项目的redis hash表存储的value都是以json格式存储，所以取出来的时候需要decode下
		}
		return $res;
	}
	
	/**
	 * hash表 将名称为$name的hash中$key的value增加$num
	 * @param unknown $name
	 * @param unknown $key
	 * @param number $num
	 */
	public function hash_hIncrBy($name,$key,$num=1){
		return $this->r->hIncrBy($name, $key, $num);
	}
	
	/**
	 * hash表 向名称为$name的hash中批量添加元素
	 * 示例 $this->r->hMset('user:1', array('name' => 'Joe', 'salary' => 2000));
	 * @param unknown $name
	 * @param unknown $arr
	 */
	public function hash_hMset($name,$arr){
		if(empty($arr))return ;
		$res=array();
		foreach ($arr as $key=>$val){
			$res[$key]=json_encode($val,true);//这里的$val可能是数组，所以转成json格式 且整个项目的redis hash表的value都以json格式存储
		}
		return $this->r->hMset($name, $res);
	}
	
	/**
	 * hash表 返回名称为$name的hash中field1,field2对应的value
	 * 示例 $this->r->hmGet('h', array('field1', 'field2'));
	 * @param unknown $name
	 * @param unknown $arr
	 */
	public function hash_hmGet($name,$arr){
		$hash_res=$this->r->hmGet($name, $arr);
		$res=array();
		foreach ($hash_res as $key=>$val){
			$res[$key]=json_decode($val,true);//这里的$val是json格式，整个项目的redis hash表存储的value都是以json格式存储，所以取出来的时候需要decode下
		}
		return $res;
	}
	
	/**
	 * list表 添加一个值为$value的元素,如果$value已经存在，则不添加 当且仅当key存在并且是一个列表。
	 *	和RPUSH命令相反，当key不存在时，RPUSHX命令什么也不做。
	 *  同lPushx
	 * @param unknown $value  需要保存的$value元素
	 */
	public function list_rPushx($key,$value){
		$this->r->rPushx($key,$value);
	}
	
	/**
	 * list表 添加一个值为$value的元素,将一个或多个值value插入到列表key的表尾。
	 * @param unknown $key 如果key不存在，一个空列表会被创建并执行RPUSH操作。
	 * @param unknown $value
	 */
	public function list_rPush($key,$value){
		$this->r->rPush($key,$value);
	}
	
	/**
	 * 获取list列表健名为$key的区间$x~$y的值，当$x=0，$y=-1时可获取健名为$key的所有值
	 * @param unknown $key 列表键名
	 * @param unknown $x 获取期间起始位
	 * @param unknown $y 获取期间结束位 可为-1
	 */
	public function list_lRange($key,$x,$y){
		return $this->r->lRange($key,$x,$y);
	}
	/**
	 * 删除count个名称为key的list中值为value的元素
	 * @param unknown $key 列表健名
	 * @param unknown $count count为0，删除所有值为value的元素，count>0从头至尾删除count个值为value的元素，count<0从尾到头删除|count|个值为value的元素
	 * @param unknown $value 
	 */
	public function list_lRem($key,$count,$value){
		return $this->r->lrem($key,$count,$value);
	}
	
	/**
	 * 删除redis的key的值
	 * @param unknown $obj 可以是数组，字符串
	 */
	public function del($obj){
		return $this->r->delete($obj);
	}
}