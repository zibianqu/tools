$(function(){
	var nowtime;
	$('#unix1').val(getTime());
	$('#unix2').val(getTime());
	nowtime=start();
	$('#stop').click(function(){
		stop(nowtime);
	});
	$('#start').click(function(){
		nowtime=start();
	});
	$('#refresh').click(function(){
		//nowtime=start();
		var time=$('#unix1').val();
		if(time=='')return;
		$('#unix2').val(time);
		$('#time1').val(unixchange(time));
		$('#time2').val(unixchange(time));
		$('#unix3').val(time);
		$('#unix4').val(time);
		setymdhms(time);
	});
	$('#clear').click(function(){
		$("input").each(function(){
			$(this).val('');
		});
	});
	$('#change1').click(function(){
		var timestamp = $('#unix2').val();
		if(timestamp==''  || isNaN(timestamp)){
			return ;
		}
		$('#time1').val(unixchange(timestamp));
	})
	$('#unix2').keyup(function(){
		var timestamp = $('#unix2').val();
		if(timestamp=='' ||  isNaN(timestamp)){
			return ;
		}
		$('#time1').val(unixchange(timestamp));
	})
	$('#change2').click(function(){
		var time=$('#time2').val();
		if(time==''){
			return ;
		}
		$('#unix3').val(timechange(time));
	})
	$('#time2').keyup(function(){
		var time=$('#time2').val();
		if(time==''){
			return ;
		}
		$('#unix3').val(timechange(time));
	})
	$('#change3').click(function(){
		change3();
	})
	$('#year').keyup(function(){
		change3();
	})
	$('#month').keyup(function(){
		change3();
	})
	$('#day').keyup(function(){
		change3();
	})
	$('#hour').keyup(function(){
		change3();
	})
	$('#minute').keyup(function(){
		change3();
	})
	$('#second').keyup(function(){
		change3();
	})
})
function setymdhms(time){
	var tt=unixchange(time);
	var arr=tt.match(/[0-9]+/g);
	$('#year').val(arr[0]);
	$('#month').val(arr[1]);
	$('#day').val(arr[2]);
	$('#hour').val(arr[3]);
	$('#minute').val(arr[4]);
	$('#second').val(arr[5]);
	
}
function change3(){
	var year=$('#year').val();
	var month=$('#month').val();
	var day=$('#day').val();
	var hour=$('#hour').val();
	var minute=$('#minute').val();
	var second=$('#second').val();
	if(year=='' || isNaN(year)){
		return ;
	}
	if(month==''|| isNaN(year) )month='00';
	if(day=='' || isNaN(day))day='00';
	if(hour=='' || isNaN(hour))hour='00';
	if(minute=='' || isNaN(minute))minute='00';
	if(second=='' || isNaN(second))second='00';
	var time=year+"/"+month+"/"+day+" "+hour+":"+minute+":"+second;
	$('#unix4').val(timechange(time));
}

//时间转换为时间
function timechange(time){
	// 获取某个时间格式的时间戳
	//var stringTime = "2014/07/10 10:21:12";
	var arr=time.match(/[0-9]+/g);
	if(arr==null || arr.length>6)return ;
	time=fillstr(arr[0],4);
	time+='/'+fillstr(arr[1],2);
	time+='/'+fillstr(arr[2],2);
	time+=' '+fillstr(arr[3],2);
	time+=':'+fillstr(arr[4],2);
	time+=':'+fillstr(arr[5],2);
	//console.log(time);
//	var stringTime=time;
//	var timestamp2 = Date.parse(new Date(stringTime));
//	timestamp2 = timestamp2 / 1000;
//	console.log(stringTime + "的时间戳为：" + timestamp2);
//	return timestamp2;
	var date=new Date();
	date.setFullYear(time.substring(0,4));
	date.setMonth(time.substring(5,7)-1);
	date.setDate(time.substring(8,10));
	date.setHours(time.substring(11,13));
	date.setMinutes(time.substring(14,16));
	date.setSeconds(time.substring(17,19));
	return Date.parse(date)/1000;
}
//填充
function fillstr(str,num){
	if(str=='' || str==null || str=='undefined')return '00';
	var len= str.length;
	var i=1;
	while(i<=num-len){
		str='0'+str;
		i++;
	}
	return str;
}
//将时间戳转换成为时间格式
function unixchange(timestamp){
	var newDate = new Date();
	newDate.setTime(timestamp * 1000);
	return newDate.format('yyyy/MM/dd hh:mm:ss');
}
function start(){
	return setInterval(function(){
			var timestamp = Date.parse(new Date());
			timestamp = getTime();
			$('#unix1').val(timestamp);
		},1000);
}

function stop(time){
		clearInterval(time);
}

//获取时间戳
function getTime(){
	var timestamp = Date.parse(new Date());
	timestamp = timestamp / 1000;
	return timestamp;
}

//格式化时间
Date.prototype.format = function(format) {
       var date = {
              "M+": this.getMonth() + 1,
              "d+": this.getDate(),
              "h+": this.getHours(),
              "m+": this.getMinutes(),
              "s+": this.getSeconds(),
              "q+": Math.floor((this.getMonth() + 3) / 3),
              "S+": this.getMilliseconds()
       };
       if (/(y+)/i.test(format)) {
              format = format.replace(RegExp.$1, (this.getFullYear() + '').substr(4 - RegExp.$1.length));
       }
       for (var k in date) {
              if (new RegExp("(" + k + ")").test(format)) {
                     format = format.replace(RegExp.$1, RegExp.$1.length == 1
                            ? date[k] : ("00" + date[k]).substr(("" + date[k]).length));
              }
       }
       return format;
}



