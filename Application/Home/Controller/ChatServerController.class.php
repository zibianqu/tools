<?php 
/**
 * 聊天服务
 * @author Administrator
 *
 */
namespace Home\Controller;
use Think\Controller;
use Tool\ClassWebsocketTool;
class ChatServerController extends Controller{
	function _initialize(){
		if ( !add_lock( 'lock' ) ) {
			die('Running');
		}
	}
	
	function index(){
		$class_websocket = new ClassWebsocketTool( WEBSOCKET_HOST, WEBSOCKET_PORT );
		
		$class_websocket->key = WEBSOCKET_KEY;
		$class_websocket->domain = WEBSOCKET_DOMAIN;
		
		$class_websocket->function['add'] = 'add_socket_call';
		$class_websocket->function['get'] = 'get_socket_call';
		$class_websocket->function['close'] = 'close_socket_call';
// 		$class_websocket->function['add'] = self::add_socket_call($accept, $index, $class);
// 		$class_websocket->function['get'] = self::get_socket_call($data, $accept, $index, $class);
// 		$class_websocket->function['close']=self::close_socket_call($bind, $class);
		$class_websocket->run();
		echo socket_strerror( $class_websocket->error() );
		
		
	}
	
	
	
	
}
?>