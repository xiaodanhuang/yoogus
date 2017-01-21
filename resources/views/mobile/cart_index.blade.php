<script>
    var x_csrf_token = '{{csrf_token()}}';
    var Cart_get_url = '{{url('cart/getcart')}}';
   var Cart_delete_url = '{{url('cart/deletecart')}}';
    var Cart_de_url = '{{url('cart/deccountcart')}}';
     var Cart_add_url = '{{url('cart/addcountcart')}}';
      var Order_get_url='{{url('orders/show')}}';
      var Order_in_url='{{url('cart/settle')}}';
      var back_url='{{url('mine/index')}}';

</script>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">

		<script src="{{asset('/mobile/moments')}}/js/jquery-3.1.0.js"></script>
		<link rel="stylesheet" href="{{asset('/mobile/cart')}}/css/cart.css" />
		<script type="text/javascript" src="{{asset('/mobile/cart')}}/js/cart.js" ></script>
		<script id="cartItemTpl" type="text/template">
        		<div class="mycar">
                    <div class="shopmessage">
                    <div class="myshop"></div>
                    <div class="shopname">优咕官方店</div>
                    <div class="delete">删除</div>
                     </div>
                     <div class="shopcontent">
                     <div class="mycheck" ></div>
                     <img src="" class="mygoods"  />
                     <div class="goodsdiscribe">Simon Dominic同款T-shirt，全国包邮，支持专柜验货，假一赔十</div>
                     <div class="price">￥999</div>
                     <div class="disnum"></div>

                      <div class="num">
                      <table border="1">
                      <tr>
                      <td class="sumde">-</td>
                      <td class="sumnum">6</td>
                      <td class="sumadd">+</td>
                      </tr>
                      </table>
                      </div>
                 </div>
        		</script>
				<title>购物车</title>
	</head>
    <body>
    <div class="header"><div class="fanhui"></div>
    购物车
    <div class="bianji">编辑</div>
    <div class="wancheng">完成 </div>
    </div>
    <div class="allcart">

 </div>
 </div>

    <div class="all_in">
     <div class="allcheck" state="0" ></div>
     <div class="selectall" >全选</div>
      <div class="sum">
      <span>合计：</span>
      <span class="money"><span>
      </div>
      <div class="order" >结算</div>
    </div>
     </div>
      </body>

</html>
