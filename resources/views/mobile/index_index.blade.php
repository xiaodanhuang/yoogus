<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>饰品</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <!--<script src="js/jquery-3.1.0.min.js"></script>-->
    <!--<link rel="stylesheet" href="mobile\index/iconfont.css">-->
    <link rel="stylesheet" href="iconfont.css">
    <script src="{{asset('js')}}/jquery-3.1.0.min.js"></script>
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

            var page=0;    //页数
            var choose = 1;     //下边选项
            var html='';

            //获取数据
            function data(){
                $.ajax({
                    url:"{{url('goods/index')}}",   //接口地址
                    type:"POST",
                    data:{
                        category:$("#all_choose").val(),
                        purpose:$("#use_choose").val(),
                        style:$("#style_choose").val(),
                        price:$("#price_choose").val(),
                        timeorhot:choose,
                        begin:page,
                        many:5
                    },
                    dataType:"json",

                    success:function(data){
                        //console.log(data.data[2].store_id);
                        if(data.error==0){
                            $.each(data.data,function (index,value) {
                                    //html+='<div class="store" data-Id="'+value.store_id+'"> <div class="favor" data-goodId="'+value.id+'" data-fav="'+value.iflike+'"> <p class="like"><span class="aixin1 heart"></span></p> </div> <div class="intro"> <img src="'+value.img.url+'" alt="icon" class="icon"> <p>'+value.store_name+'<span>'+value.salltype+'</span></p> <button class="about">关于店家</button> </div> <div class="preview" data-stock="仅剩'+value.count+'件"> <img src="bg.png" alt="bg" class="bg"> </div> <div class="content"> <p class="title">'+value.name+'</p> <div class="detail"> <p class="price"><span>&yen;</span>'+value.price+'</p> <span class="num">'+value.num_like+'人收藏</span> </div> </div> </div>'
                                    html+='<div class="store" data-Id="'+value.store_id+'"> <div class="favor" data-goodId="'+value.id+'" data-fav="'+value.iflike+'"> <p class="like"><span class="heart" data-iflike="'+value.iflike+'"></span></p> </div> <div class="intro"> <img src="'+value.logo_url+'" alt="icon" class="icon"> <p>'+value.store_name+'<span>'+value.salltype+'</span></p> <button class="about">关于店家</button> </div> <div class="preview" data-stock="仅剩'+value.count+'件"> <img src="'+value.img+'" alt="bg" class="bg"> </div> <div class="content"> <p class="title">'+value.name+'</p> <div class="detail"> <p class="price"><span>&yen;</span>'+value.price+'</p> <span class="num">'+value.num_like+'人收藏</span> </div> </div> </div>'
                            });
                            if(page==0){
                                $("#content").html(html);
                            }else{
                                $("#content").append(html);
                            }
                            $(".heart").each(function(index,element){
                                  if($(element).attr("data-iflike")==2){
                                        $(element).addClass("aixin1")
                                  }else{
                                        $(element).addClass("aixin");
                                  }
                            })
                            page=data.begin;   // 后台传回下个页数
                            html='';
                        }else{
                            alert(data.msg);
                        }
                        console.log(data.error);
                    },
                    error:function () {
                        //错误提示
                    }
                });
            }

            console.log($("#all_choose").val());
            console.log($("#use_choose").val());
            console.log($("#style_choose").val());
            console.log($("#price_choose").val());

            //初始化加载
            data();


            //改变fav(收藏)状态
            window.fav_num=0;
            function fav() {
                $(document).on('click','.favor',function(){
                    var $this=this;
//                    var fav=$(this).attr("data-fav");
                    $.ajax({
                        url:"{{url('like/goods')}}",  //fav(收藏)后台地址
                        type:"POST",
                        data:{
                            goods_id:$(this).attr("data-goodId")
                        },
                        dataType:"json",
                        success:function (data) {
//                            $($this).attr("data-fav",data);   //data为后台传回来的fav(收藏)状态码
//                            var new_fav=$($this).attr("data-fav");

                            //切换收藏icon图标
                            if(data.error==0){

                                if(data.data.status==2){
                                    $($this).find(".heart").removeClass("aixin").addClass("aixin1");
                                }else{
                                    $($this).find(".heart").removeClass("aixin1").addClass("aixin");
                                }

                                fav_num=data.num_like;

                                $($this).parent().find(".num").text(fav_num+"人收藏");   //data为后台传回来的收藏人数

                            }

                        },
                        error:function () {
                            //错误提示
                        }
                    })
                });
            }

            //初始化fav(收藏)功能
            fav();

            //返回图标显示
            $(window).scroll(function () {
                if($(window).scrollTop() > 100){
                    $(".top").fadeIn(1500);
                }else{
                    $(".top").fadeOut(1500);
                }
            });

            //返回顶部
            $(".top").click(function () {
                $("body,html").animate({
                    scrollTop:0
                },1000);
                return false;
            });

            //下部分choose切换
            $("#new,#great").click(function(){

                choose=$(this).attr("data-choose");
                page=0;

                //传输后台，加载数据
                data();

                //添加收藏功能
                fav();

            });

            //上部分select切换
            $("#all_choose,#use_choose,#style_choose,#price_choose").change(function () {

                page=0;

                //传输后台，加载数据
                data();

                //添加收藏功能
                fav();

            });

            //加载更多
            var totalHeight=0;
            var range=50;
            $(window).scroll(function () {

                var scrollPos = $(window).scrollTop();    //滚动条距顶部距离(页面超出窗口的高度)
                totalHeight = parseFloat($(window).height()) + parseFloat(scrollPos);
                var PosY=$(document).height()-range;
                if(PosY <= totalHeight){

                    //传输后台，加载数据
                    data();

                    //添加收藏功能
                    fav();

                }
            });


        })
    </script>

    <style>
        html, body, header, div, nav, label, select, option, hr, p {
            margin: 0;
            padding: 0;
        }
        body {
            font-size: .16rem;
            font-family: "Microsoft YaHei UI";
            -webkit-font-smoothing: antialiased;
        }
        nav div {
            display: inline-block;
            height: .85rem;
        }
        button {
            border: 0;
            outline: 0;
            background: #fff;
        }
        nav select {
            height: .5rem;
            margin-top:.15rem;
            width: 1.75rem;
            background: #efefef;
            font-size: .4rem;
            text-indent: .08rem;
            appearance:none;
            -moz-appearance:none; /* Firefox */
            -webkit-appearance:none; /* Safari 和 Chrome */
            border: 0;
            border-right: .05rem solid #aaa;
        }
        #all_choose {
            width: 1.8rem;
        }
        #price_choose {
            border-right: 0;
        }
        select option {
            display: inline-block;
            text-indent: 0;
            font-size: .3rem;
        }
        nav {
            width: 100%;
            background: #efefef;
        }
        .choose {
            display: inline-block;
            margin-top: .1rem;
            padding-left: 1.7rem;
        }
        .choose button {
            height: .7rem;
            padding: 0 .4rem;
            line-height: .7rem;
            border: .05rem solid #ccc;
            border-radius: .15rem;
        }
        hr {
            border: 0;
            outline: 0;
            height: .04rem;
            background: #aaa;
        }
        .store {
            position: relative;
            margin-top: .15rem;
            padding-bottom: .15rem;
            border-bottom: .08rem solid #ddd;
        }
        .icon {
            margin-left: .2rem;
            height: 1rem;
            width: 1rem;
            border-radius: .5rem;
        }
        .intro {
            margin-top: .3rem;
            margin-bottom: .1rem;
        }
        .intro p {
            display: inline-block;
            margin: 0;
            margin-left: .2rem;
            vertical-align: .3rem;
            font-size: .5rem;
            position: relative;
        }
        .intro p span {
            position: absolute;
            padding: .1rem .2rem;
            border-radius: .1rem;
            right: -1.2rem;
            top: -.3rem;
            font-size: .2rem;
            background: #1e90ff;
            color: #fff;
        }
        .intro .about {
            margin-left: 1.4rem;
            vertical-align: .4rem;
            padding: .1rem .15rem;
            border-radius: .25rem;
            font-size: .3rem;
            color: #1e90ff;
            border: .05rem solid #1e90ff;
        }
        .store .preview {
            position: relative;
            margin-right: .1rem;
            display: inline-block;
            width: 30%;
            vertical-align: top;
        }
        .store .preview:before {
            content: attr(data-stock);
            position: absolute;
            left: 0;
            bottom: .06rem;
            width: 100%;
            height: .45rem;
            line-height: .45rem;
            text-align: center;
            color: #fff;
            background: hsla(0,100%,0%,.5);
        }
        .store .bg {
            width: 100%;
            height: 2.2rem;
            border: .01rem solid #fff;
        }
        .content {
            display: inline-block;
            height: 2.2rem;
            width: 60%;
        }
        .content p {
            font-size: .35rem;
        }
        .content .title {
            margin-bottom: .2rem;
            width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            font-size: .35rem;
        }
        .content .detail {
            margin-top: .3rem;
        }
        .detail .price {
            color: #ff0000;
            font-size: .5rem;
        }
        .price span {
            font-size: .35rem;
        }
        .detail > span {
            font-size: .3rem;
            color: #ccc;
        }
        .store .favor {
            position: absolute;
            top: -.3rem;
            right: .05rem;
            display: inline-block;
            z-index:999;
        }
        .store .like {
            display: inline-block;
            width: .5rem;
            padding-left: .1rem;
            font-size: .4rem;
        }
        .like .aixin,.like .aixin1 {
            font-family: iconfont;
            color: pink;
        }
        .like .aixin {
            font-size: .45rem;
        }
        .heart {
            margin-right: .1rem;
        }
        footer .top {
            display: none;
            height: 1rem;
            width: 1rem;
            position: fixed;
            bottom: .6rem;
            right:.6rem;
            color: #fff;
            background: hsla(140,100%,40%,.3);
            border-radius: .5rem;
            z-index: 999;
        }
        .top .arrawup {
            font-family: iconfont;
            font-size: .5rem;
        }
    </style>
</head>
<body>
<header>
    <nav>
        <div id="all">
            <select name="all" id="all_choose">
                <option value="%">全部</option>
                <option value="家饰小件">家饰小件</option>
                <option value="头饰">头饰</option>
                <option value="胸饰">胸饰</option>
                <option value="手饰">手饰</option>
                <option value="脚饰">脚饰</option>
                <option value="挂饰">挂饰</option>
                <option value="玩偶">玩偶</option>
                <option value="包类">包类</option>
                <option value="用具类">用具类</option>
                <option value="鞋饰">鞋饰</option>
            </select>
        </div>
        <div id="use">
            <select name="use" id="use_choose">
                <option value="%">用途</option>
                <option value="佩戴">佩戴</option>
                <option value="收藏">收藏</option>
                <option value="摆件">摆件</option>
                <option value="配件">配件</option>
                <option value="家居饰品">家居饰品</option>
            </select>
        </div>
        <div id="style">
            <select name="style" id="style_choose">
                <option value="%">风格</option>
                <option value="简约">简约</option>
                <option value="清新">清新</option>
                <option value="萌翻">萌翻</option>
                <option value="使用">使用</option>
                <option value="女生">女生</option>
                <option value="男生">男生</option>
            </select>
        </div>
        <div id="price">
            <select name="price" id="price_choose">
                <option value="0-99999">价格</option>
                <option value="0-19">20以下</option>
                <option value="20-49">20~50</option>
                <option value="50-99">50~100</option>
                <option value="100-199">100~200</option>
                <option value="200-499">200~500</option>
                <option value="500-99999">500以上</option>
            </select>
        </div>
    </nav>
    <div class="choose">
        <button id="new" data-choose="1">最新上架</button>
        <button id="great" data-choose="2">好评秀秀</button>
    </div>
</header>
<hr>
<div id="content">

    <!--模块store-->
    <!--<div class="store">-->
        <!--<div class="favor" data-goodId="12344" data-fav="0">-->
            <!--<p class="like"><span class="aixin1 heart"></span></p>-->
        <!--</div>-->
        <!--<div class="intro">-->
            <!--<img src="test.jpg" alt="icon" class="icon">-->
            <!--<p>优咕官方店<span>估粉</span></p>-->
            <!--<button class="about">关于店家</button>-->
        <!--</div>-->
        <!--<div class="preview" data-stock="仅剩12件">-->
            <!--<img src="bg.png" alt="bg" class="bg">-->
        <!--</div>-->
        <!--<div class="content">-->
            <!--<p class="title">先马三大hi都西阿萨德hi哦啊多杀搜大红王阿是的撒啊都是哦哈迪斯</p>-->
            <!--<div class="detail">-->
                <!--<p class="price"><span>&yen;</span>12</p>-->
                <!--<span class="num">12人收藏</span>-->
            <!--</div>-->
        <!--</div>-->
    <!--</div>-->

    <!--华丽的分割线-->


    <!--<div class="store">-->
        <!--<div class="intro">-->
            <!--&lt;!&ndash;<img src="mobile\index/test.png" alt="icon" class="icon">&ndash;&gt;-->
            <!--<p>优咕官方店<span>估粉</span></p>-->
            <!--<button class="about">关于店家</button>-->
        <!--</div>-->
        <!--&lt;!&ndash;<img src="mobile\index/bg.png" alt="bg" class="bg">&ndash;&gt;-->
        <!--<div class="content">-->
            <!--<p>冰凉的夏日哈哈哈哈哈哈哈哈哈呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵</p>-->
            <!--<div class="favor"><p class="like"><span class="aixin1 heart"></span><span class="num">12</span></p></div>-->
        <!--</div>-->
    <!--</div>-->
    <!--<div class="store">-->
        <!--<div class="intro">-->
            <!--&lt;!&ndash;<img src="mobile\index/test.png" alt="icon" class="icon">&ndash;&gt;-->
            <!--<p>优咕官方店<span>估粉</span></p>-->
            <!--<button class="about">关于店家</button>-->
        <!--</div>-->
        <!--&lt;!&ndash;<img src="mobile\index/bg.png" alt="bg" class="bg">&ndash;&gt;-->
        <!--<div class="content">-->
            <!--<p>冰凉的夏日哈哈哈哈哈哈哈哈哈呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵</p>-->
            <!--<div class="favor"><p class="like"><span class="aixin1 heart"></span><span class="num">12</span></p></div>-->
        <!--</div>-->
    <!--</div>-->
</div>
<footer>
    <button class="top"><span class="arrawup"></span></button>
</footer>
</body>
</html>