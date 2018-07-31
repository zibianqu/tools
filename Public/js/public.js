
var _hmt = _hmt || [];


//返回顶部
function myEvent(obj,ev,fn){
	if(obj.attachEvent){
		obj.attachEvent('on'+ev,fn);
	}else{
		obj.addEventListener(ev,fn,false);
	}
}
myEvent(window,'load',function(){
	var oRTT=document.getElementById('rtt');
	var pH=document.documentElement.clientHeight;
	var timer=null;
	var scrollTop;
	window.onscroll=function(){
		scrollTop=document.documentElement.scrollTop||document.body.scrollTop;
//		if(scrollTop>=pH){
		if(scrollTop>=10){
			oRTT.style.display='block';
		}else{
			oRTT.style.display='none';
		}
		return scrollTop;
	};
	oRTT.onclick=function(){
		clearInterval(timer);
		timer=setInterval(function(){
			var now=scrollTop;
			var speed=(0-now)/10;
			speed=speed>0?Math.ceil(speed):Math.floor(speed);
			if(scrollTop==0){
				clearInterval(timer);
			}
			document.documentElement.scrollTop=scrollTop+speed;
			document.body.scrollTop=scrollTop+speed;
		}, 30);
	}
});

function longPress(){ 
    timeOutEvent = 0; 
//   alert("长按事件触发发"); 
     _hmt.push(['_trackEvent', 'weixin', 'click', 'test baidu genzhong']);	
} 


$(function(){  
    $('#t').bind('keypress',function(event){  
        if(event.keyCode == "13")     
        {  
        	var t=$('#t').val();
        	var url=$('#t').attr('url')+"?t="+t+"&c=1";
        	$.post(url,{'c':1},function(data){
        		if(data>0){
        			location.href=url;
        		}else{
        			alert('你操作太频繁！！！');
        		}
        	},'text');
        }  
    });
    
    $("#kfzgj").on({
		touchstart: function(e){
			timeOutEvent = setTimeout("longPress()",500);
		 	//e.preventDefault();
		},
		touchmove: function(){
            		clearTimeout(timeOutEvent); 
		    	timeOutEvent = 0; 
		},
		touchend: function(){
	   		clearTimeout(timeOutEvent);
			if(timeOutEvent!=0){ 
			    //alert("你这是点击，不是长按"); 
			} 
			return false; 
		}
	})

  $('.menu').find('li').each(function(i,obj){
    	$(obj).mouseover(function(){
    		$(obj).find('.menu-article-type').show();
    	})
    	$(obj).mouseout(function(){
    		$(obj).find('.menu-article-type').hide();
    	})
    })

	
});  