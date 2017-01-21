<!DOCTYPE html>
<html>
<head>
	<title>确认订单</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="{{asset('mobile/cart')}}/css/order_confirm_style.css">
	<script type="text/javascript" src="{{asset('qiniuUploadImgDemo')}}/js/jquery.js"></script>
</head>
<body>
	<div id="top">
		<img src="{{asset('mobile/moments')}}/img/back.png" id="back" />
		<p>确认订单</p>
	</div>	

	<div id="shouhuo_info">
		<div class="tip1" id="first">
			<button id="add">+</button>
			<span>添加收货地址</span>			
		</div>

		<div class="tip2" id="more">
			<div id="person">
				<span id="name">收货人：高艳霞</span>
				<span id="phone">15958061111</span>
			</div>	
			<div id="address">
				<img src="{{asset('mobile/cart')}}/img/location.png">
				<p id="addr">收货地址：浙江省杭州市江干区下沙街道杭州电子科技大学下沙街道杭州电子科技大学</p>
				<img src="{{asset('mobile/cart')}}/img/motify.png" id="motify">
			</div>		
		</div>
	</div>

	<!-- 每件商品订单的展示 -->
<ul>
	<li class="showbook">
		<!-- 店铺名称展示 -->
		<div id="store" class="shop">
			<img class="logo" id="shop_logo" src="{{asset('mobile/cart')}}/img/store.png">
			<p id="shopname">优咕官方店</p>
		</div>

		<!-- 商品订单详情展示 -->
		<div class="back">
			<div id="goods_pic">
			<!-- 商品图片 -->
				<img src="#" id="goods">
			<!-- 文字部分 -->
				<div id="goods_word">
					<p id="goods_title">aiuufhauhfajfgayuf挨个发芽发发发股份发研发无用功</p>
					<div class="number">
						<p class="price" id="zhanshi_jiage"><strong>￥19.90</strong></p>
						<p class="count" id="show_count">✖1</p>
					</div>
				</div>
			</div>
		</div>

		<div id="message">
			<span>买家留言：</span>
			<input type="text" id="liuyan" name="message" placeholder="对本次礼物购买的备注留言写在这里哟" />
		</div>

		<div id="lastLine">
			<p id="Bnumber">共<span class="count" id="total_count">1</span>件商品</p>
			<p id="sadd">小计：<strong class="price" id="xiaoji">￥19.90</strong></p>
		</div>
		
	</li>
</ul>

	<div id="bottom" style="position:absolute;bottom:0px;left:0px;">
		<p class="all_price">合计：<strong id="heji">￥19.90</strong></p>
		<button class="sub">提交订单</button>
	</div>

	<script type="text/javascript" src="{{asset('mobile/cart')}}/js/order_confirm_action.js"></script>

</body>
</html>