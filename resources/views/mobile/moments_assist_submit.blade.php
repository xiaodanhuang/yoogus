<script>
    var x_csrf_token = '{{csrf_token()}}';
</script>

<!DOCTYPE html>
<html>
<head>
    <title>我要找饰品</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/moments')}}/css/assist_submit_style.css" />
    <script type="text/javascript" src="{{asset('qiniuUploadImgDemo')}}/js/jquery.js"></script>
    <script type="text/javascript">window.token_url = "{{url('qiniu/token')}}"</script>
    <!-- 引入Plupload和qiniu.js -->
    <script type="text/javascript" src="{{asset('qiniuUploadImgDemo')}}/js/plupload.full.min.js"></script>
    <script type="text/javascript" src="{{asset('qiniuUploadImgDemo')}}/js/qiniu.js"></script>
    <script type="text/javascript" src="{{asset('mobile/moments')}}/js/assist_submit_action.js"></script>
    
</head>
<body>
<div id="top">
        <img src="{{asset('mobile/moments')}}/img/back.png" id="back" />
        <p>我要找饰品</p>
</div>
    
        <div class="jianjie">
            <label for="introduce"><span>饰品描述：</span></label><br />
            <div class="high">
                <img src="{{asset('mobile/moments')}}/img/pena.png" class="inpic" /><span class="in">不超过200个字</span>
            </div>
            <textarea placeholder="不超过200个字" class="intro" maxlength='400' id="introduce"></textarea>
        </div>
        <div class="jinji">
            <label for="early"><span class="zhishu">紧急指数：</span></label>
            <select class="early" id="hurry">
                <option>A</option>
                <option>B</option>
                <option>C</option>
                <option selected="selected">D</option>
            </select>
        <span class="tip">A最紧急，其余程度依次下降</span>
        </div>

        
    <div id="photo">
        <p>上传图片(最多4张，可不添加)</p>
        <div id="container" class="photoarea">
            <div id="pickfiles" class="uploadbtn"><img src="{{asset('mobile/moments')}}/img/add.png"></div>
        </div>

        <div id="container1" class="photoarea">
            
        </div>

        <div id="container2" class="photoarea">
            
        </div>

        <div id="container3" class="photoarea">
        </div>

        <div id="imgList">
            
        </div>
        
    </div>

    <div id="sub_div">
        <button id="sub" />寻 找</button>
    </div>

        

</body>
</html>