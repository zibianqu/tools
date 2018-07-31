<?php
/**
 * 登录控制器
 * @author Administrator
 *
 */

namespace Admin\Controller;
use Think\Controller;
use Admin\Model\AdminModel;
class LoginController extends Controller {
	
	/**
	 * 初始化
	 */
	function __construct(){
		parent::__construct();
		if(__FUNCTION__==='index' && AdminModel::isLogin()){
			$this->redirect('/admin/index');
		}
		
	}
	
	/**
	 * 进入登录页面
	 */
    public function index(){
    	
        $this->display('login');
    }
    
    /**
     * 做登录操作
     */
    public function dologin(){
    	$re=AdminModel::adminLogin();
    	exit(json_encode($re));
    }
    
    public function loginOut(){
    	AdminModel::loginOut();
    	$this->redirect('/admin/login');
    }
}