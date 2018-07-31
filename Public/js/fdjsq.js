$(function(){
	$('#apjs').click(function(){
		$(this).addClass('d_now');
		$('#zejs').removeClass('d_now');
		$('#apin').show();
		$('#zein').hide();
	});
	$('#zejs').click(function(){
		$(this).addClass('d_now');
		$('#apjs').removeClass('d_now');
		$('#apin').hide();
		$('#zein').show();
	});
	$('#reset').click(function(){
		$(".fdjsq_left input[type='text']").val('');

	})

	$('#js').click(function(){
		var price=$('#price').val();
		var size=$('#size').val();
		var cs=$('#cs').val();
		cs=(10-cs)/10;
		var money=$('#money').val();
		money=money*10000;
		var year=$('#year').val();
		var lilv=$('#lilv').val();
		lilv=lilv/(12*100);
		var hkway= $('input[name="hkway"]:checked ').val();
		var price=$('#price').val();
		
		var apjs=$('#apjs');
		var zejs=$('#zejs');
		
		var fkze_=$('#fkze');
		var dkze_=$('#dkze');
		var hkze_=$('#hkze');
		var zflx_=$('#zflx');
		var sqfk_=$('#sqfk');
		var dkys_=$('#dkys');
		var yjhk_=$('#yjhk');
		var yjhk1_=$('#yjhk1');
		var fkze=0,dzze=0,hkze=0,zflx=0,sqfk=0,dkys=0,yjhk=0,yjhk1='';
		if(hkway==1){
			$('#yjhkin').show();
			$('#yjhkin1').hide();
			if(apjs.hasClass('d_now')){
				fkze=price*size;
				sqfk=fkze*cs;
				dkze=fkze-sqfk;
				dkys=year*12;
				//月还款额=本金*月利率*[(1+月利率)^n/[(1+月利率)^n-1]
				//总利息=月还款额*贷款月数-本金
				yjhk=dkze*lilv*(Math.pow((1+lilv),dkys)/(Math.pow((1+lilv),dkys)-1));
				zflx=yjhk*dkys-dkze;
				hkze=yjhk*dkys;
				zflx=zflx.toFixed(2)
				yjhk=yjhk.toFixed(2);
				hkze=hkze.toFixed(2);
				yjhk1='';
				
				
			}else{
				fkze='-';
				sqfk='-';
				dkze=money;
				dkys=year*12;
				yjhk=dkze*lilv*(Math.pow((1+lilv),dkys)/(Math.pow((1+lilv),dkys)-1));
				zflx=yjhk*dkys-dkze;
				hkze=yjhk*dkys;
				zflx=zflx.toFixed(2)
				yjhk=yjhk.toFixed(2);
				hkze=hkze.toFixed(2);
				yjhk1='';
			}
		
			
		}else{
			$('#yjhkin1').show();
			$('#yjhkin').hide();
			if(apjs.hasClass('d_now')){
				fkze=price*size;
				sqfk=fkze*cs;
				dkze=fkze-sqfk;
				dkys=year*12;
				//月还款额=本金/n+剩余本金*月利率
				//总利息=本金*月利率*（贷款月数/2+0.5）
				var syze=dkze;
				var yjhkj=0;
				for(var i=1;i<=dkys;i++){
					syze=(dkze - (dkze / dkys) * (i-1))
					yjhkj=dkze/dkys+syze*lilv;
					yjhk1+=i+"月,"+yjhkj.toFixed(2)+'(元)\r\n';
					hkze=(hkze+yjhkj);
				}
				zflx=dkze*lilv*(dkys/2+0.5)
				zflx=zflx.toFixed(2);
				hkze=hkze.toFixed(2);
				yjhk='';
				
			}else{
				fkze='-';
				sqfk='-';
				dkze=money;
				dkys=year*12;
				//月还款额=本金/n+剩余本金*月利率
				//总利息=本金*月利率*（贷款月数/2+0.5）
				var syze=dkze;
				var yjhkj=0;
				for(var i=1;i<=dkys;i++){
					syze=(dkze - (dkze / dkys) * (i-1))
					yjhkj=dkze/dkys+syze*lilv;
					yjhk1+=i+"月,"+yjhkj.toFixed(2)+'(元)\r\n';
					hkze=(hkze+yjhkj);
				}
				zflx=dkze*lilv*(dkys/2+0.5)
				zflx=zflx.toFixed(2);
				hkze=hkze.toFixed(2);
				yjhk='';
			}
		}
		
		fkze_.val(fkze);
		dkze_.val(dkze);
		hkze_.val(hkze);
		zflx_.val(zflx);
		sqfk_.val(sqfk);
		dkys_.val(dkys);
		yjhk_.val(yjhk);
		yjhk1_.val(yjhk1);
		
	})
	
})

function getRound(a){
	Math.round(a * 100) / 100;
}