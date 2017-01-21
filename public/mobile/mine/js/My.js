var tpl=0;
states=0;
accbagsnumber=0;
accbagpage=1;
storynumber=0;
storypage=1;
guanzhunumber=0;
guanzhupage=1;
ordernumber=0;
orderpage=1;
bag_length=0;
story_length=0;
shop_length=0;
order_length=0;

function myself(){
    $.ajax({
        url: head_get_url, //请求的url地址
        dataType: "json",
        type: "post", //请求方式

        success: function(res) {
            console.log(res);
           // $(".photo").css({"background-image":"url(res.data[0].head_url)"});
            $(".myname").html(res.data.nickname);
            $("#shipindai").html(res.data.store_num);
            $("#gushihe").html(res.data.story_num);
            $("#myshop").html(res.data.goods_num);
            $("#orderquery").html(res.data.order_num);
        }

    });

}

	function changestate() {
		$("#getAccBags").click(function(){
            $("td").css({"color":"black"});
		    $(this).css({"color":"#1E90FF"});
			$('.user').show();
			$('.mybag').hide();
			$('.focus').hide();
            $('.myorder').hide();
			upshop();
            states=0;
			
				
		 });
		 
		$("#getstory").click(function(){
            $("td").css({"color":"black"});
            $(this).css({"color":"#1E90FF"});
            $('.user').hide();
            $('.mybag').show();
            $('.focus').hide();
            $('.myorder').hide();
			upstory();
            states=1;
			
	
		});
		
		$("#getfocus").click(function(){
            $("td").css({"color":"black"});
            $(this).css({"color":"#1E90FF"});
            $('.user').hide();
            $('.mybag').hide();
            $('.focus').show();
            $('.myorder').hide();
			upguanzhu();
            states=2;
			
		  			
		
		});
        $("#getorder").click(function(){
            $("td").css({"color":"black"});
            $(this).css({"color":"#1E90FF"});
            $('.user').hide();
            $('.mybag').hide();
            $('.focus').hide();
            $('.myorder').show();
            uporder();
            states=3;




        });
}
	
	function upshop(){
                   $.ajax({
            url: AccBags_get_url, //请求的url地址
            dataType: "json", //返回格式为json
            data: {

                "page": accbagpage,
                "per_page": 5

            }, //参数值
            type: "post", //请求方式

            success: function(res) {
                console.log(res);
                bag_length=res.data.length;


                if(res.data.length) {
                    var $mybody=$('.user');
                    var $item;
                    for(var i = 0; i < res.data.length; i++) {
                        $item = $(getshopTpl());
                        $mybody.append($item);
                        $('.myimg').eq(accbagsnumber).attr('src', res.data[i].store_logourl);
                        $('.myname').eq(accbagsnumber).html(res.data[i].name);
                        $('.abshop').eq(accbagsnumber).attr("src",res.data[i].address);
                        $('.shopbg').eq(accbagsnumber).attr('src',res.data[i].goods_logourl);
                        $('.discribe').eq(accbagsnumber).html(res.data[i].description);
                        $('.shopnumber').eq(accbagsnumber).html(res.data[i].num_like);
                        accbagsnumber++;
                    }
                }
            }

        });
        accbagpage++;
		
}
	function upstory(){
        $.ajax({
            url: Story_get_url, //请求的url地址
            dataType: "json", //返回格式为json
            data: {

                "page": storypage,
                "per_page": 5

            }, //参数值
            type: "post", //请求方式
            success: function(res) {
                console.log(res);
                story_length=res.data.length;
                var $mybody=$('.mybag');
                var $item;

                if(res.data.length) {
                    for(var i = 0; i < res.data.length; i++) {
                        $item = $(getstoryTpl());
                        $mybody.append($item);
                        $('.userimg').eq(storynumber).attr('src', res.data[i].headimgurl);
                        $('.usermessage').eq(storynumber).html(res.data[i].nickname+"<div style='font-size: 30px'>"+res.data[i].date+"</div>");
                        $('.storytime').eq(storynumber).html(res.data[i].date);
                        $('.publish').eq(storynumber).html(res.data[i].content);
                        $('.number').eq(storynumber).html(res.data[i].num_like);
                        storynumber++;
                    }
                }
            }

        });
        storypage++;


     //加载更多饰品故事

    }

		
//加载故事盒
	function upguanzhu(){
        $.ajax({
            url: Store_get_url, //请求的url地址
            dataType: "json", //返回格式为json
            data: {

                "page":guanzhupage,
                "per_page": 5

            }, //参数值
            type: "post", //请求方式

            success: function(res) {
                console.log(res);
                shop_length=res.data.length;

                if(res.data.length) {
            var mybody=$('.focus');
            var $item;
            for(var i = 0; i < res.data.length; i++) {
                $item = $(getguanzhuTpl());
                mybody.append($item);
                $('.shoucangimg').eq(guanzhunumber).attr('src', res.data[i].logo_url);
                $('.shoucangname').eq(guanzhunumber).html(res.data[i].name);
                $('.shoucangshop').eq(guanzhunumber).html(res.data[i].address);
                guanzhunumber++;
            }
        }
    }

        });
        guanzhupage++;
		
}//加载关注掌柜
    function uporder(){
    $.ajax({
        url: Order_get_url, //请求的url地址
        dataType: "json", //返回格式为json
        data: {

            "page": orderpage,
            "per_page": 5

        }, //参数值
        type: "post", //请求方式

        success: function(res) {

            console.log(res);
            order_length=res.data.length;
            if(res.data.length) {
                var $mybody=$('.myorder');
                var $item;
                for(var i = 0; i < res.data.length; i++) {
                    $item = $(getOrderTpl());
                    $mybody.append($item);
                    $('.bxiang').eq(ordernumber).attr('src', res.data[i].url);
                    $('.dianming').eq(ordernumber).html( res.data[i].store_name );
                    $('.bs_text').eq(ordernumber).html( res.data[i].description );
                    $('.price_ing').eq(ordernumber).html( res.data[i].price );
                    $('.number').eq(ordernumber).html("x"+res.data[i].count );
                    $('.bs_img').eq(ordernumber).attr('src', res.data[i].logo_url);
                    $('.zongshu').eq(ordernumber).html(res.data[i].count );
                    $('.cost').eq(ordernumber).html( res.data[i].price);
                    $('.shouhuo').eq(ordernumber).attr("myid",res.data[i].id);
                    $('.yanchang').eq(ordernumber).attr("myid",res.data[i].id);
                    ordernumber++;
                }
            }


        }

    });

    orderpage++;

}//加载订单
	
	function getshopTpl(tpl){
		if(!tpl){
			tpl=$('#shipindaiItemTpl').html();
		}
		return tpl;
	}
	function getstoryTpl(tpl){
		if(!tpl){
			tpl=$('#StoryItemTpl').html();
		}
		return tpl;
	}

	function getguanzhuTpl(tpl){
		if(!tpl){
			tpl=$('#guanzhuItemTpl').html();
		}
		return tpl;
	}

function getOrderTpl(tpl){
    if(!tpl){
        tpl=$('#OrderItemTpl').html();
    }
    return tpl;
}
 $(document).ready(function(){
     myself();
     upshop();
	 changestate();//改变点击状态
     $(".mycar").click(function(){
         location.href="../cart/index";
     });
     $(window).scroll(function() {
         totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());
         if($(document).height() <= totalheight) {
             switch(states)
             {
                 case 0:if(bag_length>4){upshop();};
                 

                     break;
                 case 1:if(story_length>4){upstory();};

                     break;
                 case 2:if(shop_length>4){upguanzhu();};


                     break;
                 case 3:if(order_length>4){uporder();};

                     break;


             }

         }
     });



    });
$(document).on('click', '.shouhuo', function(ev) {
    ev.preventDefault();        //防止冒泡
    var myid=$(this).attr("myid");

    $.ajax({
        url:Order_check_url, //请求的url地址
        dataType: "json",
        data: {

           "id":myid,

        }, //参数值
        type: "post", //请求方式

        success: function(res) {
            console.log(res);

        }


    });

});
$(document).on('click', '.yanchang', function(ev) {
    ev.preventDefault();      //防止冒泡
    var myid=$(this).attr("myid");

    $.ajax({
        url:Order_de_url, //请求的url地址
        dataType: "json",
        data: {

            "id":myid,


        }, //参数值
        type: "post", //请求方式

        success: function(res) {
            console.log(res);

        }


    });






});
