

var Unicode={
		_init:function(){
			
		},
		//ASCII 转换 Unicode
		AsciiToUnicode:function(content){
			result = '';  
		    for (var i=0; i<content.length; i++)  
		    result+='&#' + content.charCodeAt(i) + ';';  
		    return result;
		},
		//Unicode 转换 ASCII  
		UnicodeToAscii:function(content){
			 var code = content.match(/&#(\d+);/g); 
			 	if(code==null || code =='undefined'){
			 		return '不合法';
			 	}
			    result= '';  
			    for (var i=0; i<code.length; i++)  
			    result += String.fromCharCode(code[i].replace(/[&#;]/g, ''));  
			    return result; 
		},
		//中文转unicode
		ChineseToUnicode:function(content){
			   var result =''; 
			   for(var i=0;i<content.length;i++)
			   {
				   result+="\\u"+parseInt(content[i].charCodeAt(0),10).toString(16);
			   }
			   return result;
		},
		//Unicode转中文
		UnicodeToChinese:function(content){
			content = content.replace(/\\/g, "%");  
		    return unescape(content);
		}
}


$(function(){
	$('#but1').click(function(){
		var start=$('#start').val();
		if(start=='')return;
		var result=Unicode.AsciiToUnicode(start);
		$('#end').val(result);
	});
	$('#but2').click(function(){
		var start=$('#start').val();
		if(start=='')return;
		var result=Unicode.UnicodeToAscii(start);
		$('#end').val(result);
	});
	$('#but3').click(function(){
		var start=$('#start').val();
		if(start=='')return;
		var result=Unicode.UnicodeToChinese(start);
		$('#end').val(result);
	});
	$('#but4').click(function(){
		var start=$('#start').val();
		if(start=='')return;
		var result=Unicode.ChineseToUnicode(start);
		$('#end').val(result);
	});
	$('#but5').click(function(){
		$('#start').val('');
		$('#end').val('');
	});
})
