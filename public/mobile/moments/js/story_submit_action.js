$(document).ready(function (){

	$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': x_csrf_token,
    }
});

	$('#introduce').focus(function (){
	this.style.borderBottom="5px solid #328CCB";
	this.style.fontSize="2rem";
	this.style.textAlign="left";
	this.style.lineHeight="50px";
	this.style.paddingLeft="12px";
	$('.in,.inpic').show();
	$(this).attr('placeholder','');
	// $('.intro').css('height','300px');
});
$('#introduce').blur(function (){
	this.style.borderBottom="2px solid #999";
	this.style.fontSize="2.6rem";
	this.style.textAlign="center";
	this.style.lineHeight="350px";
	this.style.paddingLeft="12px";
	$('.in,.inpic').hide();
	$(this).attr('placeholder','不超过200个字');
});

$('#back').click(function (){
	history.back();
});


$('#thingSub').click(function (){
	
	$.ajax({
		url:'http://localhost/yoogus/public/moments/story/add',
		type:'post',
		dataType:'json',
		data:{
			'content':$('#introduce').val()
		},
		success:function (data){
			console.log('数据上传成功');
		},
		error:function (a,b,c){
			console.log(a+b+c);
		}
	});
});


});

