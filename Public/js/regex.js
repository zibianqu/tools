$(function(){
	$('.regex_common a').each(function(i,obj){
		$(this).click(function(){
			var comm=$(this).attr('t');
			var regex=regex_comon[comm];
			regex=regex+'';
			regex=regex.replace(/^\//g,'');
			regex=regex.replace(/\/$/g,'');
			$('#regex').val(regex);
			var obj=$('#input_text').val();
			if(obj!=''){
				var result=obj.match(getReg(regex_comon[comm]));
				if(result==null || result==undefined || result==''){
					$('#match_text').val('');
					return ;
				}
				var match='';
				for(var i=0;i<result.length;i++){
					match+=result[i]+'\r\n';
				}
				$('#match_text').val(match);
			}
		})
	})
	$('#match').click(function(){
		var patter=$('#regex').val();
		if(patter == '')return ;
		var obj=$('#input_text').val();
		if(obj=='')return ;
		var result=obj.match(getReg(patter));
		
		if(result==null || result==undefined || result==''){
			$('#match_text').val('');
			return ;
		}
		var match='';
		for(var i=0;i<result.length;i++){
			match+=result[i]+'\r\n';
		}
		$('#match_text').val(match);
		return ;
	})
	$('#replace').click(function(){
		var text=$('#replace_text').val();
		if(text=='')return;
		var patter=$('#regex').val();
		if(patter == '')return ;
		var obj=$('#input_text').val();
		if(obj=='')return ;
		result=obj.replace(getReg(patter),text);
		$('#replace_result').val(result);
	})
})

function getReg(patter){
	var patt1=new RegExp(patter,"g");
	return patt1;
}


	
var regex_comon={
	zh:/[\u4e00-\u9fa5]/,
	szj:/[^\x00-\xff]/,
	kbh:/\s/,
	email:/\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}/,
	url:/^((https|http|ftp|rtsp|mms)?:\/\/)[^\s]+/,
	mobile:/0?(13|14|15|18)[0-9]{9}/,
	tel:/[0-9-()（）]{7,18}/,
	qq:/[1-9]([0-9]{5,11})/,
	zip:/\d{6}/,
	ip:/(25[0-5]|2[0-4]\d|[0-1]\d{2}|[1-9]?\d)\.(25[0-5]|2[0-4]\d|[0-1]\d{2}|[1-9]?\d)\.(25[0-5]|2[0-4]\d|[0-1]\d{2}|[1-9]?\d)\.(25[0-5]|2[0-4]\d|[0-1]\d{2}|[1-9]?\d)/,
	card:/\d{17}[\d|x]|\d{15}/,
	date:/\d{4}(\-|\/|.)\d{1,2}\1\d{1,2}/,
	zs:/-?[1-9]\d*/,
	zzs:/[1-9]\d*/,
	fzs:/-[1-9]\d*/,
	zfds:/[1-9]\d*.\d*|0.\d*[1-9]\d*/,
	ffds:/-([1-9]\d*.\d*|0.\d*[1-9]\d*)/,
	user:/[A-Za-z0-9_\-\u4e00-\u9fa5]+/,
}
