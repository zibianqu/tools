<?php
/**
 * 管理员模型
 * @author Administrator
 *
 */

namespace Admin\Model;
use Think\Model;
class AdminModel extends Model {
   
	/**
	 * 登陆
	 * @return stdClass
	 */
	public function adminLogin(){
		$map['user']=trim(I('user'));
		$pass=md5(md5(trim(I('pass'))));
		$user=M('admin')->where($map)->find();
		if(!empty($user)){
			if($user['pass']==$pass){
				unset($user['pass']);
				$_SESSION['admin_']=$user;
				return Re(true,'登陆成功');
			}else{
				return Re(false,'密码错误！');
			}
		}else{
			return Re(false,'不存在改用户！');
		}	
	}
	
	/**
	 * 验证是否登录
	 * @return boolean
	 */
	public static function isLogin(){
		if(!empty($_SESSION['admin_'])){
			return true;
		}else{
			return false;
		}
	}
	
	/**
	 * 登出
	 */
	public function loginOut(){
		$_SESSION['admin_']=null;
	}
}