//后台传过来的url地址

console.log(submit_url);

/*rem 自适应*/
(function (doc, win) {
    var docEl = doc.documentElement,
        resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
        recalc = function () {
            var clientWidth = docEl.clientWidth;
            if (!clientWidth) return;
            docEl.style.fontSize = 100 * (clientWidth / 750) + 'px';
        };

    if (!doc.addEventListener) return;
    win.addEventListener(resizeEvt, recalc, false);
    doc.addEventListener('DOMContentLoaded', recalc, false);
})(document, window);

$(function () {

    //处理传给后台的content
           var intro=[];
           var pic=[];
			var purposes=[];
			var index=0;
			var html='';

			$(".add").click(function(){
				var contents=$("#intro").val();
                var pics=$(".uploadPic").attr('src');
				html+='<div class="msg pic"><button class="delete">x</button><p>图片</p><img src="" alt="pic"><label for="intro" class="intro_label">礼物介绍：</label><p>'+contents+'</p></div>'
				$(".module").append(html);
				intro.push(contents);
                pic.push(pics);
				html='';
				$("#intro").val('');
                $("#pickfiles").empty().text('+');
			});
           $(document).on('click','.msg',function () {
               index=$(this).index();
           });
			$(document).on('click','.delete',function(){
                console.log(pic);
               $(this).parent().trigger('click');
               intro.splice(index,1);
                pic.splice(index,1);
               $(this).parent().remove();
			});

    //将信息提交给后台
           $(".submit").click(function () {
				$("input:checkbox[name='use']:checked").each(function(){
					purposes.push($(this).val());
               });
               $.ajax({
                   url:submit_url,
                   type:"post",
                   data:{
                       storeid:$("#openid").val(),
                       title:$("#title").val(),
                       description:$("#description").val(),
                       price:$("#price").val(),
                       count:$("#count").val(),
                       category:$("#category option:selected").val(),
                       purpose:purposes,
                       infor:intro,
                       pic:pic,
                       style:$("#style option:selected").val()
                   },
                   dataType:"json",
                   success:function (data) {
                       if(data.error==0){
                           alert("success");
                           window.history.back();
                       }else {
                           alert("联系管理员")
                       }
                   },
                   error:function () {
                       alert("error");
                   }
               })
           })
});