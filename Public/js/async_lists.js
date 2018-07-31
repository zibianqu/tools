$(function(){
	var scroll_flag=true;
	 $(window).scroll(function() {
		    if ($(document).scrollTop()<=0){//到达顶部
		    	
		    }
		    //$(document).scrollTop()	获取垂直滚动的距离  即当前滚动的地方的窗口顶端到整个页面顶端的距离；
		    //$(document).height()	是获取整个页面的高度
		    //$(window).height()	是获取当前也就是浏览器所能看到的页面的那部分的高度。这个大小在你缩放浏览器窗口大小时会改变，与document是不一样的
     	    //if ($(document).scrollTop() >= $(document).height() - $(window).height()) {//到达底部
		    //console.log($(document).scrollTop());
		    if($(document).scrollTop() >= ($(document).height() - $(window).height()-100)){
		    	//$(document).scrollTop($(document).height() - $(window).height()-105);
		    	//console.log($(document).scrollTop()+"    "+($(document).height() - $(window).height())+"     "+$(document).height() +"    "+ $(window).height());
		    	//console.log("滚动条已经到达底部为" + $(document).scrollTop());
		    	var p=Number($('#p').val())+1;
		    	var t=$('#t').val();
		    	var loadurl=$('#loadurl').val();
		    	if(loadurl=='' || loadurl==null)return;
		    	if(scroll_flag){//这里是用来限制滚动条滚动到一定位置请求一次,在滚动只能等到上一次请求完成才能在次请求
		    		scroll_flag=false;
		    	}else{
		    		return ;
		    	}
//		    	$.post(loadurl,{p:p,t:t},function(data){
//		    		if(data!=''){
//		    			$('.list_art ul').append(data);
//		    			//console.log($(document).scrollTop()+"   --  "+($(document).height() - $(window).height()));
//		    			$('#p').val(p);
//		    			scroll_flag=true;
//		    			return ;
//		    		}else{
//		    			$('#loadurl').val('');
//		    		}
//		    	},'json');
		    	$.ajax({
		    		url:loadurl,
		    		dataType:'json',
		    		type:'post',
		    		data:{p:p,t:t},
		    		timeout:500000,
	    		    beforeSend:function(XMLHttpRequest){ 
	    			   $('.loading').removeClass('hide');
	    		    },
		    		success:function(data){
		    			if(data!=''){
			    			$('.list_art ul').append(data);
			    			//console.log($(document).scrollTop()+"   --  "+($(document).height() - $(window).height()));
			    			$('#p').val(p);
			    			scroll_flag=true;
			    			return ;
			    		}else{
			    			$('#loadurl').val('');
			    		}
		    			 $('.loading').addClass('hide');
		    		},
		    		error:function(xhr,textStatus){
	    		        console.log('错误')
	    		        console.log(xhr)
	    		        console.log(textStatus)
	    		    }
		    	})
		    }
		});
})

