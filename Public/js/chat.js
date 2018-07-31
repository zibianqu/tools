//WS_STATIC_URL = 'http://115.28.20.111/Public/js/chat';
//WS_HOST = '115.28.20.111';
//WS_PORT = 33333;
WS_STATIC_URL = 'http://127.0.0.1/websocket/static';
WS_HOST = '127.0.0.1';
WS_PORT = 844;

$(function(){
	var t = $('.message');
	$.wsmessage( 'msg', function( data ){
		console.log("wsmessage-msg:  "+data);
		t.append( data );
		$('.message').animate( { scrollTop: $('.message')[0].scrollHeight } ,0 );
	});
	
	$.wsmessage( 'chat', function( data ){
		t.append( data );
		$('.message').animate( { scrollTop: $('.message')[0].scrollHeight } ,0 );
	});
	
	$.wsmessage( 'name', function( data ) {
		if ( data ) {
			$('.msg.info.name').remove();
		}
		
	});
	
	$.wsmessage( 'list', function( data ) {console.log("wsmessage-list:  "+data);
		if ( !data ) {
			return false;
		}
		$.each( data, function( k, v ){
			if ( v[1] ) {
				var w = $( '<li>' + v[0] + '</li>' ).click(function(){
					$('.send .chat').val( '@' + v[0] + ' ' );
				});
				$('.list ul').append( w );
			} else {
				$(".list ul li").each(function(){
					if ( $(this).html() == v[0] ) {
						$(this).remove();
						return false;
					}
				});
			}
		});
		$('.online').html( $('.list ul li').size() );
	});
	$.wsclose(function( data ){
		$(".list ul li").html('');
		$('.online').html( 0 );
		t.append( '<div class="msg info">连接已断开, 6秒后自动重试</div>' );
	});
	
	
	$.wsopen( function( data ) {
		$.wssend('room=1' );
		t.append( '<div class="msg info">连接服务器成功</div>' );
		var w = t.append( '<div class="msg info name">请输入你的名称:<input type="text" class="input1" id="name" name="name"  /><input type="submit" class="button1" name="submit" value="确认" /></div>' );
		w.find('.button1').click(function(){
			$.wssend('name=' + w.find('#name').val() );
			return false;
		});
	});
	
	
	
	
	$('.send .button1').click(function(){
		if ( $('.send .chat').val() ) {
			
			$.wssend($.param( { chat : $('.send .chat').val() } ) );
			$('.send .chat').val('');
		}
		return false;
	});
	$('.send  .chat').keydown(function (e) {
		if ( ( e.ctrlKey && e.keyCode == 13 ) || ( e.altKey && e.keyCode == 83 ) ) {
			$('.send .button1').click();
			return false;
		}
	})
	
	$('.tool .empty').click(function(){
		t.html('');
	})
});