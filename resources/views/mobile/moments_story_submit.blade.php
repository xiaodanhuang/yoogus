<script>
	var x_csrf_token = '{{csrf_token()}}';
</script>

<!DOCTYPE html>
<html>
<head>
	<title>我的饰品故事</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="{{asset('mobile/moments')}}/css/story_submit_style.css" />
	<script type="text/javascript" src="{{asset('qiniuUploadImgDemo')}}/js/jquery.js"></script>
	<script type="text/javascript" src="{{asset('mobile/moments')}}/js/story_submit_action.js"></script>
</head>
<body>
<div id="top">
		<img src="{{asset('mobile/moments')}}/img/back.png" id="back" />
		<p>我的饰品故事</p>
</div>
	
		<div class="jianjie">
			<label for="introduce"><span>故事描述：</span></label><br />
			<div class="high">
				<img src="{{asset('mobile/moments')}}/img/pena.png" class="inpic" /><span class="in">不超过200个字</span>
			</div>
			<textarea placeholder="不超过200个字" class="intro" maxlength='400' id="introduce"></textarea>
		</div>

		<div class="find">
			<button id="thingSub" class="sub" />发 布</button>
		</div>


</body>
</html>