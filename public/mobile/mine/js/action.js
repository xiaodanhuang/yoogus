$.ajax({
	url:''+Math.random(),
	type:'post',
	success: function (data){
		$('.touxiang').attr('src','images/touxiang/'+data.lujing);
		$('.nichen').html(data.con);
		$('.Cshipin').html(data.Scount);
		$('.Cstory').html(data.Ycount);
		$('.Czhanggui').html(data.Zcount);
		$('.Cdingdan').html(data.Dcount);
	},
	// error:function (jqXHR,textStatus,errorThrown){
	// 	alert(XMLHttpRequest.status);
	// 	alert(XMLHttpRequest.readyState);
	// 	alert(textStatus);
	// }
});
$.ajax({
	url: ''+Math.random(),
	type:'post',
	success: function (data){
		$('.bxiang').attr('src','images/bs_xiang/'+data.xiang);
		$('.dianming').html(data.dianming);
		$('.Tstatus').html(data.Tstatus);
		$('.price_ing').html(data.price_ing);
		$('.price_ed').html(data.price_ed);
		$('.number').html(data.number);
		$('.zongshu').html(data.zongshu);
		$('.cost').html(data.cost);
		$('.yunfei').html(data.yunfei);
	}
});

$('#book')