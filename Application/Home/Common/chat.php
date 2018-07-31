<?php



/**
 *	添加的时候
 *
 *	回调函数请勿直接使用
 **/
function add_socket_call( $accept, $index, $class ) {

	// 自动关闭 90 秒没有动作的
	$class->time[$index] = time();
	$class->bind[$index]['ip'] = $class->ip( $accept );

	// 关闭过久没响应的
	if ( rand( 0,1000 ) ) {
		return false;
	}
	foreach ( $class->accept as $k => $v ) {
		if ( $class->type[$k] !=  WEBSOCKET_TYPE_API ) {
			if ( empty( $class->time[$k] ) || ( time() - $class->time[$k] ) > 100 ) {
				$class->close( $v );
			}
		}
	}
}

/**
 *	读取数据的时候
 *
 *	回调函数请勿直接使用
 **/
function get_socket_call( $data, $accept, $index, $class ) {
	// 超过 1024 字节就结束
	if ( strlen( $data ) > 1024 ) {
		return false;
	}
	$data = string_turn_array( $data );
	// time 包
	if ( !empty( $data['time'] ) ) {
		$time = time();
		$class->time[$index] = $time;
		return $class->send( array( 'time' => $time ), $accept );
	}

	if ( !empty( $data['room'] ) ) {
		$room = htmlspecialchars( (string) $data['room'], ENT_QUOTES );
		$class->bind[$index]['room'] = $room;
	}
	// 添加名称
	if ( !empty( $data['name'] ) ) {
		$room  = empty( $class->bind[$index]['room'] ) ? '' : $class->bind[$index]['room'];
		$name = htmlspecialchars( (string) $data['name'], ENT_QUOTES );
		$admin = explode( ',', $name , 2 );

		// 管理员的
		if ( !empty( $admin[1] ) && $admin[1] === (string) ADMIN_PASS ) {
			$name = '<strong class="admin_name">管理员:'. $admin[0] . '</strong>';
			$class->bind[$index]['admin'] = true;
		}

		// 你已经有名称了
		if ( !empty( $class->bind[$index]['name'] ) ) {
			return  $class->send( array( 'msg' => '<div class="msg error">你已经有名称了</div>' ), $accept );
		}

		// 名称以存在
		foreach ( $class->bind as $k => $v ) {
			if ( !empty( $v['name'] ) && $v['name'] == $name ) {

				//添加部分
				$class->bind[$index]['name'] = $name;
				$list = array();
				foreach( $class->bind as $v ) {
					if ( !empty( $v['name'] ) && $v['room']==$room) {
						if($name==$v['name']){
							$list[] = array( $v['name'], true,'yes' );//yes表示当前用户
						}else{
							$list[] = array( $v['name'], true,'no' );//no表示不是当前用户
						}
					}
				}
				return $class->send( array( 'list' => two_array_unique($list, 0) ), $accept );
				//原来的，现在被注释
				//return  $class->send( array( 'msg' => '<div class="msg error">名称已存在</div>' ), $accept );
			}
		}

		ws_send_all( array( 'list' => array( array( $name, true,'no' ) ) ), $class ,$room);//no表示不是当前用户
		ws_send_all( array( 'msg' => '<div class="msg login"><strong class="name">'. $name .'</strong>登录聊天室</div>' ), $class ,$room);

		$class->bind[$index]['name'] = $name;

		$list = array();
		foreach( $class->bind as $v ) {
			if ( !empty( $v['name'] ) && $v['room']==$room) {
				if($name==$v['name']){
					$list[] = array( $v['name'], true,'yes' );//yes表示当前用户
				}else{
					$list[] = array( $v['name'], true,'no' );//no表示不是当前用户
				}
			}
		}
		$class->send( array( 'list' => two_array_unique($list, 0) ), $accept );
		return $class->send( array( 'name' => true, 'msg' => '<div class="msg yes">你已经成功登录上聊天室</div>' ), $accept );
	}


	// 聊天
	if ( !empty( $data['chat'] ) ) {
		$name  = empty( $class->bind[$index]['name'] ) ? '' : $class->bind[$index]['name'];
		$room  = empty( $class->bind[$index]['room'] ) ? '' : $class->bind[$index]['room'];
		$admin  = !empty( $class->bind[$index]['admin'] );
		$chat = $admin ? (string) $data['chat'] : nl2br( htmlspecialchars( (string) $data['chat'], ENT_QUOTES ) );
		if ( $admin && $chat == 'die' ) {
			die;
		}

		if ( !$name ) {
			return $class->send( array( 'msg' => '<div class="msg error">你还没有输入你的名称</div>' ), $accept ,$room);
		}

		return ws_send_all_msg(array('name'=>$name,'admin'=>$admin,'chat'=>$chat) , $class ,$room);
	}
}

/**
 *	读取数据的时候
 *
 *	刷新界面或者关闭界面时调用该方法
 *
 *	回调函数请勿直接使用
 **/
function close_socket_call( $bind, $class ) {
	if ( empty( $bind['name'] ) ) {
		return false;
	}
	$room=$bind['room'];
	if(ws_send_all_close( array( 'list' => array( array( $bind['name'], false ) ) ), $class ,$room)){
		ws_send_all( array(  'msg' => '<div class="msg logout"><strong class="name">'. $bind['name'] .'</strong>离开聊天室</div>' ), $class ,$room);
	}
}





function ws_send_all( $data, $class ,$room) {
	if(empty($room))return false;//房间不能为空
	foreach ( $class->bind as $k => $v ) {
		if($room!=$v['room']){//相同房间才能才能通信
			continue;
		}
		if ( empty( $v['name'] ) || $class->type[$k] == WEBSOCKET_TYPE_API ) {
			continue;
		}
		$class->send( $data, $class->accept[$k] );
	}
}
/**
 *	发送信息，有识别用户的分发给所有用户
 *
 * 	给发送用户名称做好标记
 *
 */
function ws_send_all_msg( $arr, $class ,$room) {
	if(empty($room))return false;//房间不能为空
	foreach ( $class->bind as $k => $v ) {
		if($room!=$v['room']){//相同房间才能才能通信
			continue;
		}
		if ( empty( $v['name'] ) || $class->type[$k] == WEBSOCKET_TYPE_API ) {
			continue;
		}
		$data=array( 'chat' => '<div class="chat ' . ( $arr['admin'] ? 'admin_chat' : '' ) .'"><div class="name '.  (($v['name']==$arr['name'])?'own':'')   .'">'. $arr['name'] .'</div><p>'. $arr['chat'] .'</p></div>' );
		$class->send( $data, $class->accept[$k] );
	}
}

/**
 *	刷新或关闭界面，发送用户名称，有识别用户的分发给所有用户
 *
 *
 */
function ws_send_all_close( $data, $class ,$room) {
	if(empty($room))return false;//房间不能为空
	foreach ( $class->bind as $k => $v ) {
		if($room!=$v['room']){//相同房间才能才能通信
			continue;
		}
		if ( empty( $v['name'] ) || $class->type[$k] == WEBSOCKET_TYPE_API ) {
			continue;
		}
		if($data['list'][0][0]==$v['name']){//防止用户界面是重复界面关闭或刷新时删除其他用户界面的在线人员列表
			return false;
		}
	}
	foreach ( $class->bind as $k => $v ) {
		if($room!=$v['room']){//相同房间才能才能通信
			continue;
		}
		if ( empty( $v['name'] ) || $class->type[$k] == WEBSOCKET_TYPE_API ) {
			continue;
		}
		$class->send( $data, $class->accept[$k] );
	}
	return true;
}


function chattest(){
	$arr=func_get_args();
	echo $arr[0].'    '.$arr[1];
}