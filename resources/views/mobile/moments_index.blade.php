<script>
    var x_csrf_token = '{{csrf_token()}}';
	var share_url = '{{url('moments/share')}}';
	var comment_url = '{{url('moments/submit?$(this).attr("myid")')}}';
	var story_get_url = '{{url('moments/story/')}}';
	var assist_get_url =  '{{url('moments/assist/')}}';
	var assist_comment_get_url =  '{{url('comment/assist')}}';
	var assist_comment_add_url =  '{{url('comment/assist/add')}}';
	var story_comment_get_url = '{{url('comment/story')}}';
	var story_comment_add_url = '{{url('comment/story/add')}}';
	var story_like_url = '{{url('like/story')}}';
	var redzan= '{{asset('mobile/moments/img/lovebigr.png')}}';
	var grayzan= '{{asset('moblie/moments/img/loveb.png')}}';
</script>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="{{asset('/mobile/moments')}}/css/shipinquan_index.css" />

		
			<script src="{{asset('/mobile/moments')}}/js/jquery-3.1.0.js"></script>
		<script type="text/javascript" src="{{asset('/mobile/moments')}}/js/ShiPinQuan_index.js" ></script>
				<title>饰品圈</title>
	</head>
	<script id="listItemTpl" type="text/template">
		<div class="myconment">
			<sapn  class="name" style="color:#0000FF;font-size:30px;"></sapn>
			<span class="dis" ></span>
		</div>
	</script>
	
	
	
	<script id="userItemTpl" type="text/template">
				<div class="user">
					<div class="usercontent">
						<img src="{{asset('/mobile/moments')}}/img/userimg.png" class="userimg"></img>
						<div class="usermessage" ></div>
						<div class="number"></div>
						<div  class="zan"></div>
					</div>
					<div class="userpublish"></div>
					<div class="picture"></div>
					<div class="userpinglun">
                        <div class="useradd">评论</div>
                        <div class="usershare">分享</div>
                        <div class="userreadmore">查看评论</div>
                     </div>

					</div>



	</script>
	
	<script id="storyItemTpl" type="text/template">

				<div class="story">
					<div class="storycontent">
						<img src="{{asset('/mobile/moments')}}/img/userimg.png" class="storyimg"></img>
						<div class="storymessage"><br></div>
						<div class="storynumber"></div>
						<div  class="storyzan"></div>
					</div>
					<div class="storypublish"></div>
					<div class="storypinglun">
						<div class="storyadd">评论</div>
                        <div class="storyshare">分享</div>
                        <div class="storyreadmore">查看评论</div>
                    </div>

				</div>

	</script>
	
	<body>
	
		<div class="nav">
			<table>	
				<tr>
					<td id="looking">寻饰启示</td>
					<td id="story">饰品故事</td>
				</tr>
			</table>
		</div>
		<table class="order">	
				<tr>
					<td class="zuixin">最新
					</td>
					<td class="zuiji">最急
					</td>
					<td class="zuizan" style="display:none">最赞
				</tr>
			</table>
		
		<div class="findthing"></div>
		<div class="rollback"onclick="javascript:scroll(0,0)"></div>
			<div class="content1"></div>
			<div class="content2"></div>	

</body>

</html>
