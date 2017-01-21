<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>发布礼物</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <script src="{{asset('js/jquery-3.1.0.min.js')}}"></script>
    <style>
        @font-face {font-family: 'iconfont';
            src: url('iconfont/iconfont.eot'); /* IE9*/
            src: url('iconfont/iconfont.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
            url('iconfont/iconfont.woff') format('woff'), /* chrome、firefox */
            url('iconfont/iconfont.ttf') format('truetype'), /* chrome、firefox、opera、Safari, Android, iOS 4.2+*/
            url('iconfont/iconfont.svg#iconfont') format('svg'); /* iOS 4.1- */
        }
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
            height: 2.6rem;
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
        input[type="checkbox"] + label:before {
            content: '\a0';
            display: inline-block;
            height: .4rem;
            line-height: .4rem;
            width: .4rem;
            margin-top: .1rem;
            margin-right: .1rem;
            margin-left: .1rem;
            text-indent: 0;
            border: .01rem solid #aaa;
            text-align: center;
            font-size: .4rem;
            font-family: iconfont;
            color: #4b9ceb;
            background: hsla(0, 0%, 100%, .8);
        }
        input[type="checkbox"]:checked + label:before {
            content: '\e601';
        }
        input[type="checkbox"] {
            position: absolute;
            clip: rect(0,0,0,0);
        }
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
        content button {
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
    </style>
    <script>

        /*rem 自适应*/
        (function (doc, win) {
            var docEl = doc.documentElement,
                    resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
                    recalc = function () {
                        var clientWidth = docEl.clientWidth;
                        if (!clientWidth) return;
                        docEl.style.fontSize = 100 * (clientWidth / 750) + 'px';
                    };

            if (!doc.addEventListener) return;
            win.addEventListener(resizeEvt, recalc, false);
            doc.addEventListener('DOMContentLoaded', recalc, false);
        })(document, window);

        $(function () {
            $(".submit").click(function () {
                $.ajax({
                    url:submiturl,
                    type:"post",
                    data:{
                        openId:$("#openid").val(),
                        key:$("#key").val(),
                        title:$("#title").val(),
                        intro:$("#intro").val(),
                        price:$("#price").val(),
                        position:$("#position option:selected").val(),
                        use:$("#use option:selected").val(),
                        style:$("#style option:selected").val(),
                        kind:$("#kind option:selected").val(),
                        guarantee:$("#guarantee option:selected").val(),
                        hidden:"yoogu",
                    },
                    dataType:"json",
                    success:function (data) {
                        if(data.errcode==200){
                            alert("success");
                            window.history.back();
                        }else if(data.errcode==400){
                            alert("联系管理员")
                        }
                    },
                    error:function () {
                        alert("error");
                    }

                })
            })
        })
    </script>
    <!-- <script type="text/javascript">
    $(function(){
            var submiturl =" {php echo $this->createMobileUrl('Submit',array('openid'=>$openid))}";
        console.log(submiturl);
    })
    </script> -->
</head>
<body>
    <header>
        <h1>修改礼物</h1>
    </header>
    <content>
        <div class="msg">
            <label for="key">礼物关键字：</label>
            <input type="text" id="key" value="{{$data->name}}" placeholder="关键字">
        </div>
        <div class="msg">
            <label for="title">礼物标题：</label>
            <input type="text" id="title" value="{{$data->description}}" placeholder="礼物标题">
        </div>
        @foreach($data->img as $v)
        <div class="msg">
            <p>图片</p>
            <img src="{{$v->url}}" alt="##3">
            <label for="intro">礼物介绍：</label>
            <textarea name="intro" id="intro" cols="30" rows="10">{{$v->infor}}</textarea>
        </div>
        @endforeach
        <div class="msg">
            <label for="price">价格：</label>
            <input type="number" id="price" value="{{$data->price}}" placeholder="价格">
        </div>
        <div class="msg check">
            <label for="position">类别：</label>
            <select name="kind" id="position">
                <option value="家饰小件">家饰小件</option>
                <option value="头饰">头饰</option>
                <option value="胸饰">胸饰</option>
                <option value="手饰">手饰</option>
                <option value="脚饰">脚饰</option>
                <option value="玩偶">玩偶</option>
                <option value="包类">包类</option>
                <option value="用具类">用具类</option>
                <option value="鞋饰">鞋饰</option>
                <option value="{{$data->category}}" selected="selected">(原){{$data->category}}</option>
            </select>
        </div>
        <div class="msg check">
            <label for="use">用途：</label>
            <select name="kind" id="use">
                <option value="佩戴">佩戴</option>
                <option value="收藏">收藏</option>
                <option value="摆件">摆件</option>
                <option value="配件">配件</option>
                <option value="家居饰品">家居饰品</option>
                <option value="{{$data->purpose}}" selected="selected">(原){{$data->purpose}}</option>
            </select>
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
                <option value="{{$data->style}}" selected="selected">(原){{$data->style}}</option>
            </select>
        </div>
        <div class="msg">
            <label for="price">库存：</label>
            <input type="number" id="count" value="{{$data->count}}" placeholder="价格">
        </div>
<!--         <div class="msg check">
            <label for="kind">礼物类型：</label>
            <select name="kind" id="kind">
                <option value="鞋子">鞋子</option>
                <option value="手套">手套</option>
                <option value="手套" selected="selected" >之前是手套</option>

            </select>
        </div> -->
<!--         <div class="msg">
            <label for="guarantee">质保：</label>
            <select name="style" id="guarantee">
                <option value="半年以下">半年以下</option>
                <option value="old">半年到一年</option>
                <option value="{$arr['warranty']}" selected="selected">(原){$arr['warranty']}</option>
            </select>
        </div> -->

        <button>添加更多图文</button>
    </content>
    <footer>
        <button class="submit">修改上架</button>
    </footer>
</body>
</html>