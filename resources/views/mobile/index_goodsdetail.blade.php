<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>礼物详情</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <script src="{{asset('js')}}/jquery-3.1.0.min.js"></script>
    <script src="{{asset('mobile/index/swiper-3.4.0.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('mobile/index/swiper-3.4.0.min.css')}}">
    <!--<link rel="stylesheet" href="CSS/Goods_Details.css">-->
    <!--<link rel="stylesheet" href="iconfont.css">-->
    <!--<script src="JS/Goods_Details.js"></script>-->
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
            //切换页面
            window.len = 0;
            window.offLeft = parseFloat($(".move").css("left"));
            window.length = parseFloat($("nav").css("width")) * 0.19;
            window.navIndex=0;
            window.max=0;
            window.min=0;

            var mySwiper = new Swiper ('.swiper-container', {
                direction: 'horizontal',
                loop: false,
                onSlideChangeEnd: function(swiper){
                    len=mySwiper.activeIndex;
                    $(".move").animate({left:offLeft+length*len+'px'},200);
                    $("body,html").animate({
                        scrollTop:0
                    },300);
                }
            });
            $(".switch li").click(function () {
                navIndex=$(this).index();
                mySwiper.slideTo(navIndex, 300, false);
                $(".move").animate({left:offLeft+length*navIndex+'px'});
            });

            //全局变量
//            window.goodsId={{$goods_id}};    //后台渲染
            window.goodsId={{$goods_id}};
            window.href={{url('goods/detail')}};
            var getData="";
            var getImg="";

            $.ajax({
                url:"",
                type:"POST",
                data:{
                    goodsid:goodsId
                },
                dataType:"json",
                success:function (data) {
                    if(data.error==0){
                        getData='<span class="style">'+data.data.style+'</span> <span class="category">'+data.data.category+'</span> <span class="purpose">'+data.data.purpose+'</span>'+data.data.name+'';
                        $(".name").html(getData);
                        $(".intro").text(data.data.description);
                        $("#price").text(data.data.price);
                        $("#count").text(data.data.count);
                        $("#concern").text(data.data.num_like);
                        $(".store_icon").attr("src",data.data.logo_url);
                        $("#name").text(data.data.store_name);
                        $("#salltype").text(data.data.salltype);
                        $("#goods_num").text(data.data.goodsnum);
                        $("#attend_num").text(data.data.attennum);
                        $("#title_h1").text(data.data.name);
                        $.each(data.data.img,function (index,value) {
                            getImg+='<figure><img src="'+value.url+'" alt="intro"> <figcaption>'+value.infor+'</figcaption> </figure>';
                        });
                        $(".discuss").append(getImg);
                    }
                }
            });

            //跳转页面
            $(".about").click(function () {
                window.location.href="";
            });
            //返回顶部
            $(window).scroll(function () {
                if($(window).scrollTop() > 100){
                    $(".top").fadeIn(1500);
                }else{
                    $(".top").fadeOut(1500);
                }
            });
            $(".top").click(function () {
                $("body,html").animate({
                    scrollTop:0
                },1000);
                return false;
            });

            //加载更多
            var totalHeight=0;
            var range=50;
            var page=1;
            $(window).scroll(function () {
                var scrollPos = $(window).scrollTop();    //滚动条距顶部距离(页面超出窗口的高度)
                totalHeight = parseFloat($(window).height()) + parseFloat(scrollPos);
                var PosY=$(document).height()-range;
                if(PosY <= totalHeight){
                    var html='';
                    $.ajax({
                        url:"",
                        type:"POST",
                        data:{
                            page:page,
                            per_page:10,
                            goods_id:goodsId
                        },
                        dataType:"json",
                        success:function (data) {
                            if(data.error==0){
                                $.each(data.data,function (index,value) {
                                    html+='<div class="comment"> <img src="'+value.headimgurl+'" alt="user_icon"> <div class="content"> <p class="user_name">'+value.nickname+'</p> <p class="time">'+value.date+'</p> <p class="msg">'+value.content+'</p> </div> </div>';
                                });
                                $("#content,#content_slide").append(html);
                            }
                            page++;
                        },
                        error:function () {
                            //错误
                        }
                    });
                }
            });
        })
    </script>
    <style>

        * {
            margin: 0;
            padding: 0;
        }
        a {
            text-decoration: none;
        }
        /*页面切换*/
        .swiper-container {
            width: 100%;
            min-height: 100%;
        }
        .swiper-slide {
            width: 100%;
        }
        html,body{
            height: 100%;
            width: 100%;
        }
        body {
            font-size: .16rem;
            font-family: "Microsoft YaHei UI";
            background: #eee;
            -webkit-font-smoothing: antialiased;
        }
        #goods_bg {
            position: relative;
            width: 100%;
            height: 3rem;
        }
        #goods_bg img {
            width: 100%;
            height: 3rem;
        }

        #goods_content {
            margin-top: .1rem;
            padding-bottom: .25rem;
            border-bottom: .05rem solid #ddd;
            background: #fff;
        }
        #goods_content .title {
            margin-top: .2rem;
            margin-bottom: .1rem;
            margin-left: .3rem;
        }
        .style, .category, .purpose {
            display: inline-block;
            padding: .05rem .1rem;
            font-size: .2rem;
            color: #fff;
            line-height: .35rem;
            border-radius: .05rem;
            background: #ff0000;
        }
        .name {
            margin-top: .1rem;
            margin-left: .3rem;
            margin-right: .3rem;
            display: inline-block;
            line-height: .48rem;
            font-size: .3rem;
        }
        #goods_content .intro {
            margin-top: .1rem;
            margin-left: .3rem;
            color: #ff0000;
        }
        #goods_content .count, #goods_content .concern {
            display: inline-block;
            padding-right: 2rem;
            margin-top: .05rem;
            margin-left: .3rem;
            font-size: .2rem;
            color: #999;
        }
        #goods_content .concern {
            padding-right: 0;
            margin-left: 1.9rem;
        }
        #store_details {
            margin-top: .1rem;
            margin-bottom: .1rem;
            padding-bottom: .7rem;
            border-bottom: .05rem solid #ddd;
            background: #fff;
        }
        #store_details .store_msg:after {
            content: '.';
            display: block;
            clear: both;
            visibility: hidden;
            height: 0;
        }
        .store_msg img {
            float: left;
            margin-top: .4rem;
            margin-left: .4rem;
            margin-right: .4rem;
            width: 1.3rem;
            height: 1.3rem;
            border-radius: .65rem;
        }
        .store_msg .store_name {
            float: left;
            position: relative;
            margin-top: .65rem;
            font-size: .5rem;
            font-weight: normal;
            color: #000;
        }
        .store_name #salltype {
            position: absolute;
            top: -.4rem;
            right: -.9rem;
            display: inline-block;
            padding: 0 .1rem;
            height: .4rem;
            line-height: .4rem;
            font-size: .16rem;
            text-align: center;
            color: #fff;
            border-radius: .05rem;
            background: #3399ff;
        }
        .effect {
            margin-top: .2rem;
            margin-right: .3rem;
            font-size: .4rem;
            font-weight: normal;
            color: #000;
        }
        .effect > span {
            float: left;
            position: relative;
            top: .07rem;
            display: inline-block;
            font-size: .75rem;
        }
        .effect:after{
            content: '.';
            display: block;
            clear: both;
            visibility: hidden;
            height: 0;
        }
        .effect .present {
            float: left;
            margin-left: .6rem;
            padding-right: .3rem;
        }
        .present span {
            display: block;
            text-align: center;
        }
        .effect .fans {
            float: left;
            padding: 0 .4rem 0 .3rem;
        }
        .fans span {
            display: block;
            text-align: center;
        }
        .effect a {
            float: right;
            margin-top: .12rem;
            margin-right: .12rem;
            padding: .25rem .1rem;
            border: .01rem solid #3399ff;
            border-radius: .13rem;
            font-size: .3rem;
            color: #3398ca;
        }
        #comment, #comment_slide {
            background: #fff;
        }
        #comment .title, #comment_slide .title {
            padding-bottom:.2rem;
            padding-left: .4rem;
            font-size: .5rem;
            font-weight: normal;
            border-bottom: .05rem solid #ddd;
            color: #000;
        }
        .title img {
            position: relative;
            top: .16rem;
            margin-right: .12rem;
            width: .6rem;
        }
        #comment #content, #comment_slide #content_slide {
            margin-bottom: 1.79rem;
        }

        .more {
            position: fixed;
            bottom: .95rem;
            width: 100%;
            height: 1rem;
            border-bottom: .02rem solid #666;
            background: rgba(255, 255, 255, 0.9);
            z-index: 999;
        }
        .more img {
            margin-top: .1rem;
            margin-left: 3.35rem;
            width: .8rem;
        }
        #user_choice {
            position: fixed;
            bottom: 0;
            padding-top: .2rem;
            padding-bottom: .2rem;
            width: 100%;
            height: .55rem;
            font-size: .4rem;
            background: rgba(246, 38, 65, .9);
            z-index: 999;
        }
        #user_choice:after {
            content: '.';
            display: block;
            clear: both;
            visibility: hidden;
            height: 0;
        }
        #user_choice img {
            display: block;
            float: left;
            margin-left: .2rem;
            margin-right: .2rem;
            width: .55rem;
        }
        #user_choice .like,
        #user_choice .buy,
        #user_choice .join {
            position: relative;
            top: -.2rem;
            float: left;
            height: .95rem;
        }
        .like div,
        .buy div,
        .join div {
            margin-top: .2rem;
            padding-right: .2rem;
            height: .55rem;
            color: #fff;
            border-left: .01rem solid #fff;
        }
        .join div {
            width: 2.4rem;
            text-align: center;
            font-size: .4rem;
        }
        .like div {
            border: 0;
            margin-left: .2rem;
        }
        button {
            border: 0;
            outline: 0;
            cursor: pointer;
        }
        footer .top {
            display: none;
            height: 1rem;
            width: 1rem;
            position: fixed;
            bottom: .9rem;
            right:.6rem;
            color: #fff;
            background: hsla(140,100%,40%,.3);
            border-radius: .5rem;
            z-index: 99999;
        }
        .top .arrawup {
            font-family: iconfont;
            font-size: .5rem;
        }
        /*add*/
        #comment, #comment_slide {
            margin-bottom: 2rem;
        }
        .comment {
            padding-left: .2rem;
            padding-top: .2rem;
            padding-bottom: .2rem;
            border-bottom: .01rem solid #ccc;
        }
        .comment:after {
            content: '.';
            display: block;
            clear: both;
            visibility: hidden;
            height: 0;
        }
        .comment img{
            float: left;
            margin-left: .1rem;
            margin-right: .25rem;
            border-radius: .45rem;
            width: .9rem;
            height: .9rem;
        }
        .comment .content {
            float: left;
        }
        .content .user_name {
            font-size: .35rem;
            font-weight: normal;
            color: #333;
        }
        .content .time {
            margin-top: .12rem;
            margin-bottom: .2rem;
            font-size: .16rem;
            font-weight: normal;
            color:#999;
        }
        .content .msg {
            font-size: .16rem;
            font-weight: normal;
            color: #000;
        }

        nav {
            position: relative;
            height: 1rem;
            border-bottom: .05rem solid #ddd;
            background: #fff;
        }
        ul,li {
            list-style: none;
        }
        .switch {
            display: inline-block;
            width: 60%;
            height: 1rem;
        }
        .switch li{
            display: inline-block;
            width: 30%;
            height: 1rem;
            line-height: 1rem;
            text-align: center;
        }
        nav .back {
            display: inline-block;
            width: 20%;
            height: 1rem;
            margin-right: 5%;
            background: #fff;
        }
        nav hr {
            position: absolute;
            left: 26%;
            width: 18%;
            height: .02rem;
            background: #000;
        }
        h1 {
            margin-bottom: .05rem;
            font-weight: normal;
            width: 100%;
            height: 1rem;
            text-align: center;
            line-height: 1rem;
            background: #fff;
            border-bottom: .05rem solid #eee;
        }
        .discuss figure {
            margin-top:.2rem;
            padding-top: .2rem;
            padding-bottom: .2rem;
            background: #fff;
        }
        .discuss img {
            display: inline-block;
            margin-left: .2rem;
            margin-right: .3rem;
            width: 20%;
        }
        .discuss figcaption {
            display: inline-block;
            width: 70%;
            vertical-align: top;
            font-size: .3rem;
        }
        .price {
            margin-left: .3rem;
            color: #ff0000;
            font-size: .4rem;
        }
        .price #price {
            font-size: .55rem;
        }

    </style>
</head>
<body>
<nav>
    <button class="back">返回</button>
    <ul class="switch">
        <li>商品</li>
        <li>详情</li>
        <li>评价</li>
    </ul>
    <hr class="move">
</nav>
<div class="swiper-container">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <div id="goods_bg">
                <img src="Goods_Details/test.png" alt="goods_name">
            </div>
            <div id="goods_content">
                <p class="name"></p>
                <p class="intro">谢梦榴莲侧 留住青春的记忆把喇叭啊巴拉巴拉</p>
                <p class="price">&yen;<span id="price">23</span></p>
                <p class="count">库存:<span id="count">12</span></p>
                <p class="concern">关注人数:<span id="concern">1212</span></p>
            </div>
            <div id="store_details">
                <div class="store_msg">
                    <a href="#"><img src="" alt="store_icon" class="store_icon"></a>
                    <p class="store_name"><span id="name">优估广泛店</span><span id="salltype">估粉</span></p>
                </div>
                <div class="effect">
                    <p class="present"><span id="goods_num">12</span>发布礼物</p><span>|</span>
                    <p class="fans"><span id="attend_num">30</span>关注人数</p><span>|</span>
                    <a href="javascript:;" class="about">关于店家</a>
                </div>
            </div>
            <div id="comment">
                <p class="title"><img src="Goods_Details/myComment.svg" alt="comment">评价 :</p>
                <div id="content">
                    <div class="comment">
                        <img src="" alt="user_icon">
                        <div class="content">
                            <p class="user_name">周杰伦</p>
                            <p class="time">2016-08-06 12: 11</p>
                            <p class="msg">好看!美丽</p>
                        </div>
                    </div>
                    <div class="comment">
                        <img src="" alt="user_icon">
                        <div class="content">
                            <p class="user_name">周杰伦</p>
                            <p class="time">2016-08-06 12: 11</p>
                            <p class="msg">好看!美丽</p>
                        </div>
                    </div>
                    <div class="comment">
                        <img src="" alt="user_icon">
                        <div class="content">
                            <p class="user_name">周杰伦</p>
                            <p class="time">2016-08-06 12: 11</p>
                            <p class="msg">好看!美丽</p>
                        </div>
                    </div>
                    <div class="comment">
                        <img src="" alt="user_icon">
                        <div class="content">
                            <p class="user_name">周杰伦</p>
                            <p class="time">2016-08-06 12: 11</p>
                            <p class="msg">好看!美丽</p>
                        </div>
                    </div>
                    <div class="comment">
                        <img src="" alt="user_icon">
                        <div class="content">
                            <p class="user_name">周杰伦</p>
                            <p class="time">2016-08-06 12: 11</p>
                            <p class="msg">好看!美丽</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-slide">
            <h1 id="title_h1">印花蛇草水白</h1>
            <div class="discuss">
                <figure>
                    <img src="test.jpg" alt="">
                    <figcaption>
                        hahhahahahaha
                    </figcaption>
                </figure>
                <figure>
                    <img src="test.jpg" alt="">
                    <figcaption>
                        hahhahahahaha
                    </figcaption>
                </figure>
                <figure>
                    <img src="test.jpg" alt="">
                    <figcaption>
                        hahhahahahaha
                    </figcaption>
                </figure>
                <figure>
                    <img src="test.jpg" alt="">
                    <figcaption>
                        hahhahahahaha
                    </figcaption>
                </figure>
            </div>
        </div>
        <div class="swiper-slide">
            <div id="comment_slide">
                <p class="title"><img src="Goods_Details/myComment.svg" alt="comment">评价 :</p>
                <div id="content_slide">
                    <div class="comment">
                        <img src="" alt="user_icon">
                        <div class="content">
                            <p class="user_name">周杰伦</p>
                            <p class="time">2016-08-06 12: 11</p>
                            <p class="msg">好看!美丽</p>
                        </div>
                    </div>
                    <div class="comment">
                        <img src="" alt="user_icon">
                        <div class="content">
                            <p class="user_name">周杰伦</p>
                            <p class="time">2016-08-06 12: 11</p>
                            <p class="msg">好看!美丽</p>
                        </div>
                    </div>
                    <div class="comment">
                        <img src="" alt="user_icon">
                        <div class="content">
                            <p class="user_name">周杰伦</p>
                            <p class="time">2016-08-06 12: 11</p>
                            <p class="msg">好看!美丽</p>
                        </div>
                    </div>
                    <div class="comment">
                        <img src="" alt="user_icon">
                        <div class="content">
                            <p class="user_name">周杰伦</p>
                            <p class="time">2016-08-06 12: 11</p>
                            <p class="msg">好看!美丽</p>
                        </div>
                    </div>
                    <div class="comment">
                        <img src="" alt="user_icon">
                        <div class="content">
                            <p class="user_name">周杰伦</p>
                            <p class="time">2016-08-06 12: 11</p>
                            <p class="msg">好看!美丽</p>
                        </div>
                    </div>
                </div>
                <img src="test.jpg" alt="" style="height: 100px;position: absolute;left: 100px;">
            </div>
        </div>
    </div>
</div>
<a class="more" href="javascript:;"><img src="Goods_Details/more.svg" alt="more"></a>
<div id="user_choice">
    <a class="like" href="javascript:;"><div><img src="Goods_Details/like.svg" alt="like">收藏</div></a>
    <a class="join" href="javascript:;"><div>加入购物车</div></a>
    <a class="buy" href="javascript:;"><div><img src="Goods_Details/buy.svg" alt="buy">买买买</div></a>
</div>
<footer>
    <button class="top"><span class="arrawup"></span></button>
</footer>
</body>
</html>