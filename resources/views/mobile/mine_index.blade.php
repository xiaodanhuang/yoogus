<script>
var x_csrf_token = '{{csrf_token()}}';
var head_get_url = '{{url('mine/head')}}';
  var AccBags_get_url = '{{url('mine/getAccBags')}}';
  var Story_get_url = '{{url('mine/getStory')}}';
  var Store_get_url = '{{url('mine/getStore')}}';
  var Order_get_url='{{url('orders/show')}}';
   var Order_check_url='{{url('orders/check')}}';
  var Order_de_url='{{url('orders/delay')}}';
</script>

<!DOCTYPE html>
<html>
	<head>

	        <script src="{{asset('/mobile/moments')}}/js/jquery-3.1.0.js"></script>
	         <script src="{{asset('/mobile/mine')}}/js/My.js"></script>
    		<link rel="stylesheet" href="{{asset('/mobile/mine')}}/css/My.css" />
    		<link rel="stylesheet" type="text/css" href="{{asset('/mobile/mine')}}/css/style.css">
		<meta charset="UTF-8">
		<script id="shipindaiItemTpl" type="text/template">
			<div class="Myshop">
			<div class="storemessage">
					<img src="{{asset('/mobile/moments')}}/img/userimg.png" class="Myimg" ></img>
					<div class="Myname">优咕官方店</div>
					<div class="fan">咕粉</div>
					<div class="abshop">关于店家</div>
			</div>
			<img src="{{asset('/mobile/moments')}}/img/userimg.png" class="shopbg"></img>
			<div class="discribe">冰凉的的夏日，凉凉哒冰淇淋，啦啦啦啦</div>
			<div class="shopzan"></div>
			<div class="shopnumber">12</div>
		</div>

		</script>
		<script id="StoryItemTpl" type="text/template">
			<div class="Story">
					<div class="content">
					<img src="{{asset('/mobile/moments')}}/img/userimg.png" class="userimg"></img>
						<div class="usermessage">
						</div>

						<div class="number"></div>
						<div  class="zan"></div>
					</div>
					<div class="publish"></div>

					<hr />

				</div>
			</div>
        </script>
		<script id="guanzhuItemTpl" type="text/template">
			<div class="guanzhu">
					<img src="{{asset('/mobile/moments')}}/img/userimg.png" class="shoucangimg"></img>
					<div class="shoucangname"></div>
					<div class="fan">咕粉</div>
					<div class="shoucangabshop">关于店家</div>
		</div>
		</script>
		<script id="OrderItemTpl" type="text/template">
		<div class="orderthing">
        			<li class="zong">
                                		<div class="mokuai">
                                			<img src="{{asset('/mobile/moments')}}/img/userimg.png" class="bxiang" />
                                			<a href="" class="dianming">啦啦啦啦</a>
                                			<strong class="Tstatus">已付款</strong>
                                		</div>
                                		<div class="bs_intro">
                                			<div class="bs_up">
                                				<img srcsrc="{{asset('/mobile/moments')}}/img/userimg.png"  class="bs_img" />
                                				<p class="bs_text">
                                				</p>
                                				<div class="price">
                                					<span class="price_ing">￥23</span>
                                					<span class="number">x1</span>
                                				</div>
                                			</div>
                                			<div class="bs_down">
                                				<p class="">
                                					共<strong class="zongshu">1</strong>件商品 合计：<span class="cost">23.00</span>
                                				</p>
                                			</div>
                                		</div>
                                		<ul class="btn_ul">


                       <li class="shouhuo"><a href="">确认收货</a></li>
                       <li class="yanchang"><a href="">延长收货</a></li>
                                		</ul>
                                	</li>
                                	</div>
                </script>
		<title>个人中心</title>
	</head>
	<body>
		<div class="My">
		<div class="mycar"></div>
        <div class="photo"><img /></div>
		<p id="myname">昵称</p>

		</div>
		<table>
				<tr>
					<td id="shipindai">6</td>
					<td id="gushihe">15</td>
					<td id="myshop">824</td>
					<td id="orderquery">11</td>
				</tr>
				<tr>
					<td id="getAccBags">饰品袋</td>
					<td id="getstory">故事盒</td>
					<td id="getfocus">关注掌柜</td>
					<td id="getorder">订单查询</td>
				</tr>

			</table>
			<div class="user"></div>
			<div class="mybag"></div>
			<div class="focus"></div>
			<div class="myorder"></div>

	</body>
</html>
