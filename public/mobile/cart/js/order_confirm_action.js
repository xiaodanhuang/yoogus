// 左上角返回上一页
$('#back').click(function (){
	history.back();
});


// 底部悬浮
window.onscroll=window.onresize=function (){
	var scrollTop=document.documentElement.scrollTop||document.body.scrollTop;
	var bottom=document.getElementById('bottom');
	// if(window.navigator.userAgent>'IE6'){
		bottom.style.top=document.documentElement.clientHeight-bottom.offsetHeight+scrollTop+'px';
	// }
};

// 点击修改或添加收货地址
$('#motify').click(function (){
	// console.log(window.location.href);
	window.location.href='http://localhost/yoogus/resources/views/mobile/receiver_addr.blade.php';
});
$('#first').click(function (){
	window.location.href='http://localhost/yoogus/resources/views/mobile/receiver_addr.blade.php';
	// console.log(window.location.href);
});

// 显示哪个收货地址的请求
$.ajax({
	url:'',
	type:'get',
	success:function (data){
		if(data.data==null){
			$('#first').style.display='block';
			$('#more').style.display='none';
		}else{
			$('#first').style.display='none';
			$('#more').style.display='block';
			$('#name').html(data.name);
			$('#phone').html(data.phone);
			$('#addr').html(data.addr);
		}
	},
	error:function (a,b,c){
		console.log(a+b+c);
	}
});



// 商品详情展示的请求
$.ajax({
	url:'',
	type:'post',
	success:function (data){
		// 第一块单独
			$('#shop_logo').src=data[0].logo_url;
			$('#shopname').html(data[0].store_name);
			$('#goods').html(data[0].img);
			$('#goods_title').html(data[0].description);
			$('#zhanshi_jiage').html(data[0].price);
			$('#show_count').html(data[0].count);
			$('#total_count').html(data[0].count);
			var xiaoji=data[i].count*data[0].price;
			$('#xiaoji').html(xiaoji);
		// for(var i=0;i<data.data.length;i++){
		// 	var heji=xiaoji;
		// 	heji+=xiaoji;
		// 	$('#heji').html(heji);
		// }


		
	}
});

