<script>
  var x_csrf_token = '{{csrf_token()}}';
  	var assist_comment_add_url =  '{{url('comment/assist/add')}}';
  	var story_comment_add_url = '{{url('comment/story/add')}}';
</script>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="{{asset('/mobile/moments')}}/css/Submit_Conment.css" />
		<script src="{{asset('/mobile/moments')}}/js/jquery-3.1.0.js"></script>
		<script src="{{asset('/mobile/moments')}}/js/Submit_Conment.js"></script>
		<title>提交评论</title>
	</head>
	<body>
		<div class="pullconment">
			<img src="{{asset('/mobile/moments')}}/img/woyao.png" />
			
			<div class="content">
				<img src="{{asset('/mobile/moments')}}/img/piglun.gif" left:"100px">
				<textarea class="submit"></textarea>
				
			</div>
		
		<button>提交</button>
		</div>	
		
		
	</body>
</html>
