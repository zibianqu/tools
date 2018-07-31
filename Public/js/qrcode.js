$(function(){
	$('.qrcode_type p span').each(function(index,obj){
		$(obj).click(function(){
			$(obj).addClass('now');
			$('.qrcode_type p span').each(function(index1,obj1){
				if(index1!=index){
					$(obj1).removeClass('now');
				}
			});
			$('.qrcode_left ul li').each(function(index2,obj2){
				if(index==index2){
					$(obj2).show();
				}else{
					$(obj2).hide();
				}
			});
		});
	})
	
	 $('#text_text').keyup(function(){ 
		 var _length = $(this).val().length;
		 $('#text_size').text(_length);
	});
	 $('#sms_text').keyup(function(){ 
		 var _length = $(this).val().length;
		 $('#sms_len').text(_length);
	});
})