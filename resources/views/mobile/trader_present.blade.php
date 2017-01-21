<script>
    window.token_url = '{{url('qiniu/token')}}';
    window.x_csrf_token = '{{csrf_token()}}';
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>发布礼物</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <script src="{{asset('js')}}/jquery-3.1.0.min.js"></script>
    <script src="{{asset('mobile/trader')}}/plupload.full.min.js"></script>
    <script src="{{asset('mobile/trader')}}/qiniu.js"></script>
    <script src="{{asset('mobile/trader')}}/plupload.min.js"></script>
    <script src="{{asset('mobile/trader')}}/plupload.dev.js"></script>
    <script src="{{asset('mobile/trader')}}/moxie.min.js"></script>
    <style>
        /*@font-face {font-family: 'iconfont';*/
            /*src: url('iconfont/iconfont.eot'); !* IE9*!*/
            /*src: url('iconfont/iconfont.eot?#iefix') format('embedded-opentype'), !* IE6-IE8 *!*/
            /*url('iconfont/iconfont.woff') format('woff'), !* chrome、firefox *!*/
            /*url('iconfont/iconfont.ttf') format('truetype'), !* chrome、firefox、opera、Safari, Android, iOS 4.2+*!*/
            /*url('iconfont/iconfont.svg#iconfont') format('svg'); !* iOS 4.1- *!*/
        /*}*/
        html, body, header, content, footer, div, label,
        input, h1, h2, select, option, p, textarea, button, img {
            margin: 0;
            padding: 0;
        }
        body {
            font-size: .16rem;
        }
        h1, h2 {
            font-weight: normal;
        }
        content {
            display: block;
        }
        label {
            font-size: .35rem;
        }
        button {
            border: .01rem solid #888;
            background: #fff;
            outline: 0;
        }
        header h1 {
            height: 1rem;
            line-height: 1rem;
            font-size: .5rem;
            text-align: center;
        }
        .msg {
            margin-top: .1rem;
            margin-bottom: .1rem;
            margin-left: .7rem;
        }
        .msg input {
            height: .4rem;
            border: .01rem solid #ccc;
            outline: 0;
            text-indent: .2rem;
            border-radius: .3rem;
        }
        #price {
            width: 2rem;
        }
        .msg h2 {
            display: inline-block;
            height: 1.5rem;
            padding-top: .1rem;
            font-size: .35rem;
        }
        .check{
            width: 6.5rem;
        }
        .check:after {
            content: '.';
            display: block;
            height: 0;
            clear: both;
            visibility: hidden;
        }
        .check label, .check h2 {
            float: left;
        }
        /*input[type="checkbox"] + label:before {*/
            /*content: '\a0';*/
            /*display: inline-block;*/
            /*height: .4rem;*/
            /*line-height: .4rem;*/
            /*width: .4rem;*/
            /*margin-top: .1rem;*/
            /*margin-right: .1rem;*/
            /*margin-left: .1rem;*/
            /*text-indent: 0;*/
            /*border: .01rem solid #aaa;*/
            /*text-align: center;*/
            /*font-size: .4rem;*/
            /*font-family: iconfont;*/
            /*color: #4b9ceb;*/
            /*background: hsla(0, 0%, 100%, .8);*/
        /*}*/
        /*input[type="checkbox"]:checked + label:before {*/
            /*content: '\e601';*/
        /*}*/
        /*input[type="checkbox"] {*/
            /*position: absolute;*/
            /*clip: rect(0,0,0,0);*/
        /*}*/
        .msg textarea {
            margin-top: .25rem;
            padding: .1rem .3rem;
            width: 5.4rem;
            height: 1rem;
            border: .01rem solid #ccc;
            border-radius: .2rem;
            font-size: .2rem;
            outline: 0;
            resize: none;
        }
        content .add {
            margin-left: .7rem;
            width: 2.3rem;
            height: .65rem;
            line-height: .65rem;
            border-radius: .1rem;
            font-size: .3rem;
            text-align: center;
        }
        footer button {
            margin-top: 1rem;
            margin-left: 2.3rem;
            width: 3.2rem;
            height: .8rem;
            line-height: .8rem;
            border-radius: .3rem;
            text-align: center;
            color: #fff;
            background: #3399cc;
        }
        .pic {
            position: relative;
            border: .05rem solid red;
        }
        .delete{
            position: absolute;
            top:0;
            right: 0;
        }
        .msg img {
            width: 2.45rem;
        }
        .msg .intro_label {
            display: block;
        }
        .upload img {
            /*width: 1rem;*/
            /*height: 1rem;*/
        }
        .upload label {
            display: block;
        }
        .uploadPic {
            width:2.45rem;
            height:2.45rem;
        }
        .msg {
            margin-top: .1rem;
            margin-bottom: .1rem;
            margin-left: .7rem;
        }
        #container {
            position: relative;
            width: 4rem;
        }
        .uploadbtn{
            width: 2.5rem;
            height: 2.5rem;
            border: .05rem solid #ccc;
            font-size: 2rem;
            background: white;
        }

    </style>
    <!--<script type="text/javascript">-->
    <!--var submiturl = "{php echo $this->createMobileUrl('Submit',array('openid'=>$openid))}";-->

    <!--</script>-->
    <!-- <script type="text/javascript">
    $(function(){
            var submiturl =" {php echo $this->createMobileUrl('Submit',array('openid'=>$openid))}";
        console.log(submiturl);
    })
    </script> -->

  
</head>
<body>
    <input type="hidden" id="uptoken">
    <input type="hidden" value="{openid}" id="openid">
    <header>
        <h1>发布礼物</h1>
    </header>
    <content>
        <div class="msg">
            <label for="title">礼物标题：</label>
            <input type="text" id="title" placeholder="礼物标题">
        </div>
        <div class="msg">
            <label for="description">礼物描述：</label>
            <input type="text" id="description" placeholder="礼物描述">
        </div>
        <div class="msg">
            <label for="count">库存个数：</label>
            <input type="text" id="count" placeholder="库存个数">
        </div>
		<div class="module"></div>
        <div class="msg upload">
            <p>图片</p>
            <div id="container">
                <button id="pickfiles" class="uploadbtn">+</button>

            </div>
            <label for="intro">礼物介绍1：</label>
            <textarea name="intro" id="intro" cols="30" rows="10"></textarea>
        </div>
		<button class="add">添加更多图文</button>
        <div class="msg">
            <label for="price">价格：</label>
            <input type="number" id="price" placeholder="价格">
        </div>
        <div class="msg check">
            <label for="category">部位：</label>
            <select name="kind" id="category">
                <option value="家饰小件">家饰小件</option>
                <option value="头饰">头饰</option>
                <option value="胸饰">胸饰</option>
                <option value="手饰">手饰</option>
                <option value="脚饰">脚饰</option>
                <option value="玩偶">玩偶</option>
                <option value="包类">包类</option>
                <option value="用具类">用具类</option>
                <option value="鞋饰">鞋饰</option>
            </select>
        </div>
        <div class="msg check">
            <h2>用途：</h2>
            <div class="use">
                <div>
                    <input id="collect" type="checkbox" value="收藏" name="use">
                    <label for="collect">收藏</label>
                </div>
                <div>
                    <input id="baijian" type="checkbox" value="摆件" name="use">
                    <label for="baijian">摆件</label>
                </div>
                <div>
                    <input id="peijian" type="checkbox" value="配件" name="use">
                    <label for="peijian">配件</label>
                </div>
                <div>
                    <input id="jiaju" type="checkbox" value="家居饰品" name="use">
                    <label for="jiaju">家居饰品</label>
                </div>
                <div>
                    <input id="wear" type="checkbox" value="佩戴" name="use">
                    <label for="wear">佩戴</label>
                </div>
            </div>

            <!--<select name="kind" id="use">-->
                <!--<option value="佩戴">佩戴</option>-->
                <!--<option value="收藏">收藏</option>-->
                <!--<option value="摆件">摆件</option>-->
                <!--<option value="配件">配件</option>-->
                <!--<option value="家居饰品">家居饰品</option>-->
            <!--</select>-->
        </div>
        <div class="msg">
            <label for="style">风格：</label>
            <select name="style" id="style">
                <option value="简约">简约</option>
                <option value="清新">清新</option>
                <option value="萌翻">萌翻</option>
                <option value="使用">使用</option>
                <option value="女生">女生</option>
                <option value="男生">男生</option>
            </select>
        </div>
<!--         <div class="msg check">
            <label for="kind">礼物类型：</label>
            <select name="kind" id="kind">
                <option value="鞋子">鞋子</option>
                <option value="手套">手套</option>
            </select>
        </div> -->
 <!--        <div class="msg">
            <label for="guarantee">质保：</label>
            <select name="style" id="guarantee">
                <option value="半年以下">半年以下</option>
                <option value="old">半年到一年</option>
            </select>
        </div> -->
        
    </content>
    <div id="imgList"></div>
    <footer>
        <button class="submit">发布上架</button>
    </footer>
    <script>    window.token_url ="{{url('qiniu/token')}}";
                window.getname_url ="{{url('qiniu/getname')}}";
                window.submit_url = "{{url('goods/add')}}"
    </script>
    <script src="{{asset('mobile/trader')}}/main.js"></script>
    <script src="{{asset('mobile/trader')}}/login.js"></script>

</body>
</html>