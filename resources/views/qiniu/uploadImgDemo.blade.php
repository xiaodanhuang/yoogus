<script>
	window.token_url = '{{url('qiniu/token')}}';
	window.token ="{{$token}}";
</script>
<!DOCTYPE html>
<html>
<head>
	<title>图片上传</title>
	<meta charset="utf-8" />
	<script type="text/javascript" src="{{asset('qiniuUploadImgDemo')}}/js/jquery.js"></script>
	<!-- 引入Plupload和qiniu.js -->
	<script type="text/javascript" src="{{asset('qiniuUploadImgDemo')}}/js/plupload.full.min.js"></script>
	<script type="text/javascript" src="{{asset('qiniuUploadImgDemo')}}/js/qiniu.js"></script>
	<script type="text/javascript" src="{{asset('qiniuUploadImgDemo')}}/js/upload.js"></script>
	<link rel="stylesheet" href="{{asset('qiniuUploadImgDemo')}}/css/upload.css">
</head>
<body>
<div id="container">
	<a class="btn btn-default btn-lg " id="pickfiles" style="width:160px" href="#" >
		<i class="glyphicon glyphicon-plus"></i>
		<span>选择文件</span>
	</a>
	{{--<a class="btn btn-default btn-lg " id="up_load" style="width:160px" href="#" >--}}
		{{--<span>确认上传</span>--}}
	{{--</a>--}}
</div>
</body>
</html>