buythings = new Array();
cartnumber=0;
page=1;
number=0;
state=0;//0表示未选，2表示已选
mymoney=0;
res_length=0;
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': x_csrf_token,
    }
});
function cartTpl(tpl){
    if(!tpl){
        tpl=$('#cartItemTpl').html();
    }
    return tpl;
}
function upcart(){
    $.ajax({
        url:  Cart_get_url, //请求的url地址
        dataType: "json", //返回格式为json
        data: {

            "page": page,
            "per_page": 5,


        }, //参数值
        type: "post", //请求方式

        success: function(res) {
            console.log(res);
            res_length= res.data.length;
            if(res.data.length) {
                console.log(res);
                var $content = $('.allcart');
                var $item;
                for (var i = 0; i < res.data.length; i++) {

                    if (res.data[i]) {
                        var $item = $(cartTpl());
                        $content.append($item);
                        $('.mycar').eq(number).attr("id", "mycar" + number);
                        $('.delete').eq(number).attr("myid", "mycar" + number);
                        $('.delete').eq(number).attr("goodsid", res.data[i].goods_id);
                        $('.mycheck').eq(number).attr("price", res.data[i].price);
                        $('.mycheck').eq(number).attr("goodsid", res.data[i].goods_id);
                        $('.mycheck').eq(number).attr("state", state);
                        $('.mycheck').eq(number).attr("num", number);
                        $('.mycheck').eq(number).attr("mynum", res.data[i].count);
                        $('.price').eq(number).html("￥"+res.data[i].price);
                        $('.goodsdiscribe').eq(number).html(res.data[i].description);
                        $('.disnum').eq(number).html("×"+res.data[i].count);
                        $('.disnum').eq(number).attr("id","dis"+number);
                        $('.sumnum').eq(number).html(res.data[i].count);
                        $('.sumnum').eq(number).attr("myid", res.data[i].count);
                        $('.sumnum').eq(number).attr("id", number);
                        $('.sumde').eq(number).attr("myid", number);
                        $('.sumde').eq(number).attr("count", res.data[i].goods_id);
                        $('.sumadd').eq(number).attr("myid", number);
                        $('.sumadd').eq(number).attr("count", res.data[i].goods_id);
                        $('.mygoods').eq(number).attr("src", res.data[i].goodsimg);

                        number++;

                    }
                   // page++;
                }
            }


        }

    });



}
$(document).ready(function(){
    upcart();
    $(window).scroll(function() {
        totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());
        if($(document).height() <= totalheight) {
              if(res_length>4) {
                  upcart();
              }


        }
    });
    $(".bianji").click(function() {
        $(".wancheng").show();
        $(".bianji").hide();
      $(".num").show();
      $(".disnum").hide();
        $(".mycheck").css({"background-image": "url(../mobile/cart/img/white.png)"});
        $(".allcheck").css({"background-image": "url(../mobile/cart/img/white.png)"})
        $(".sllcheck").attr("state",0);
        $(".mycheck").attr("state",0);
        $(".delete").show();



    });
    $(".wancheng").click(function() {
        $(".wancheng").hide();
        $(".bianji").show();
        $(".num").hide();
        $(".disnum").show();
        $(".delete").hide();


    });
    $(".fanhui").click(function() {
        window.location.href = back_url;
    });
    $(".order").click(function() {
        var as = $('.mycheck');
        for(var i=0,j=as.length;i<j;i++) {
        var states=$(".mycheck").eq(i).attr("state");
        var  goods=$(".mycheck").eq(i).attr("goodsid");
        if(states>1){
            buythings[i]=goods;
        }
        }
        console.log(buythings);
       $.ajax({
            url:  Order_in_url, //请求的url地址
            dataType: "json", //返回格式为json
            data: {

              "goods_id":buythings,


            }, //参数值
            type: "post", //请求方式

            success: function(res) {
                console.log(res);

            }

        });
    });
    $(".allcheck").click(function() {
        var allstate=$(this).attr("state");
        if(allstate<1) {
            mymoney=0;
            var as = $('.mycheck');
            for(var i=0,j=as.length;i<j;i++) {
                var price=$(".mycheck").eq(i).attr("price");
                $(".mycheck").eq(i).attr("state",2);
                var  num=$(".mycheck").eq(i).attr("mynum");
                mymoney= parseFloat(mymoney)+ parseFloat(price)*parseInt(num);
                mymoney=mymoney.toFixed(2);


            }
            $(".money").html("￥"+mymoney);


            $(this).css({"background-image": "url(../mobile/cart/img/xuanze.png)"});
            $(".mycheck").css({"background-image": "url(../mobile/cart/img/xuanze.png)"})
            $(this).attr("state",2);
        }
        else {
            var as = $('.mycheck');
            $(this).css({"background-image": "url(../mobile/cart/img/white.png)"});
            $(".mycheck").css({"background-image": "url(../mobile/cart/img/white.png)"});
            $(this).attr("state",0);
            for(var i=0,j=as.length;i<j;i++) {
                var price=$(".mycheck").eq(i).attr("price");
                $(".mycheck").eq(i).attr("state",0);
                mymoney=0;
                $(".money").html("￥"+mymoney);


            }
        }


    });
});
$(document).on('click', '.delete', function() {
   var cart=$(this).attr("myid");
   var goods_id=$(this).attr("goodsid");
    $("#" + cart + "").hide();
    $.ajax({
        url: Cart_delete_url, //请求的url地址
        dataType: "json", //返回格式为json
        data: {

           "goods_id":goods_id,


        }, //参数值
        type: "post", //请求方式

        success: function(res) {
            console.log(res);
        }

    });




});//删除购物车
$(document).on('click', '.sumadd', function() {
    mysum=$(this).attr("myid");//sumnumid
   goods=$(this).attr("count");//goodsid
  sum= $("#" + mysum + "").attr("myid");
 sum=parseInt(sum)+1;
 $("#" + mysum + "").attr("myid",sum);
 $("#" + mysum + "").html(sum);
 $("#" +"dis"+ mysum + "").html("×"+sum);
   $.ajax({
        url: Cart_add_url, //请求的url地址
        dataType: "json", //返回格式为json
        data: {

            "goods_id":goods,


        }, //参数值
        type: "post", //请求方式

        success: function(res) {
            console.log(res);
        }

    });


});//增加数量
$(document).on('click', '.sumde', function() {

    mysum=$(this).attr("myid");
    goods=$(this).attr("count");
    sum= $("#" + mysum + "").attr("myid");
    if (sum>0) {
        sum = parseInt(sum) - 1;
        $("#" + mysum + "").attr("myid", sum);
        $("#" + mysum + "").html(sum);
        $("#" +"dis"+ mysum + "").html("×"+sum);

    $.ajax({
        url: Cart_de_url, //请求的url地址
        dataType: "json", //返回格式为json
        data: {

            "goods_id":goods,


        }, //参数值
        type: "post", //请求方式

        success: function(res) {
            console.log(res);
        }

    });
    }



});//减少数量
$(document).on('click', '.mycheck', function() {
    var mystate=$(this).attr("state");
    var price=$(this).attr("price");
    var mynum=$(this).attr("num");
    var num=$("#" + mynum + "").attr("myid");
    if(mystate<1) {
        mymoney= parseFloat(mymoney)+ parseFloat(price)*parseInt(num);
        mymoney=mymoney.toFixed(2);
        $(this).css({"background-image": "url(../mobile/cart/img/xuanze.png)"});
        $(".money").html("￥"+mymoney);
        $(this).attr("state",2);

    }
    else {
        mymoney= parseFloat(mymoney)-parseFloat(price)*parseInt(num);
        mymoney=mymoney.toFixed(2);
        $(this).css({"background-image": "url(../mobile/cart/img/white.png)"});
        $(".money").html("￥"+mymoney);
        $(this).attr("state",0);

    }
});//选择商品计算价钱

