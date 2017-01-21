<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>饰品</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <script src="js/jquery-3.1.0.min.js"></script>
    <link rel="stylesheet" href="mobile\index/iconfont.css">
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
    </script>
    <style>

        html, body, header, div, nav, label, select, option, hr {
            margin: 0;
            padding: 0;
        }
        body {
            font-size: .16rem;
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
            border-right: .01rem solid #aaa;
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
            border: .01rem solid #ccc;
            border-radius: .15rem;
        }
        hr {
            border: 0;
            outline: 0;
            height: .04rem;
            background: #aaa;
        }
        .store {
            margin-top: .15rem;
            border-bottom: .08rem solid #ddd;
        }
        .icon {
            margin-left: .2rem;
            height: 1rem;
            width: 1rem;
            border-radius: .5rem;
        }
        .intro p {
            display: inline-block;
            margin: 0;
            margin-left: .2rem;
            vertical-align: .3rem;
            font-size: .4rem;
            position: relative;
        }
        .intro p span {
            position: absolute;
            padding: .1rem .2rem;
            border-radius: .1rem;
            right: -1.2rem;
            top: -.15rem;
            font-size: .2rem;
            background: #1e90ff;
            color: #fff;
        }
        .intro .about {
            margin-left: 1.9rem;
            vertical-align: .35rem;
            padding: .1rem .15rem;
            border-radius: .25rem;
            font-size: .3rem;
            color: #1e90ff;
            border: .01rem solid #1e90ff;
        }
        .store .bg {
            width: 6.6rem;
            height: 3rem;
            margin-left: .5rem;
            border: .01rem solid #aaa;
            border-radius: .2rem;
            box-shadow: .1rem .15rem .1rem #aaa;
        }
        .content p {
            display: inline-block;
            margin-left: .6rem;
            width: 5rem;
            font-size: .35rem;
        }
        .content .like {
            display: inline-block;
            margin: 0;
            margin-left: .2rem;
            width: .5rem;
            padding-left: .2rem;
            vertical-align: .45rem;
            font-size: .4rem;
            border-left: .01rem solid #ccc;
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
    <script>
        $(function () {
            $(".content").click(function () {
                $(this).find(".heart").toggleClass("aixin").toggleClass("aixin1");
                var flag=0;
                if($(this).find(".heart").hasClass("aixin")){
                    flag=1;
                    var plus=parseInt($(this).find(".num").text())+1;
                    $(this).find(".num").text(plus);
                }else{
                    flag=0;
                    var minus=parseInt($(this).find(".num").text())-1;
                    $(this).find(".num").text(minus);
                }

//                $.ajax({
//                    url:"",
//                    type:"POST",
//                    data:{
//                        "like":flag,
//                        "id":
//                    }
//                })
            });
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
//            $("#all_choose,#style_choose,#use_choose,#price_choose").change(function () {
//                $.ajax({
//                    url:"",
//                    type:"GET",
//                    data:{
//                        "all":$("#all_choose").val(),
//                        "style":$("#style_choose").val(),
//                        "use":$("#use_choose").val(),
//                        "price":$("#price_choose").val()
//                    },
//                    success:function (msg) {
//                        var html='';
//                        $.each(msg,function (index,value) {
//                            html+='<div class="store"> <div class="intro"> <img src="test.png" alt="icon" class="icon"> <p>优咕官方店<span>估粉</span></p> <button class="about">关于店家</button> </div> <img src="bg.png" alt="bg" class="bg"> <div class="content"> <p>冰凉的夏日哈哈哈哈哈哈哈哈哈呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵</p> <p class="like"><span class="aixin1 heart"></span><span class="num">12</span></p> </div> </div>';
//                        });
//                        $("#content").html(html);
//                    }
//                })
//            })
        });
    </script>
</head>
<body>
    <header>
        <nav>
            <div id="all">
                <select name="all" id="all_choose">
                    <option>全部</option>
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
                    <option>用途</option>
                    <option value="佩戴">佩戴</option>
                    <option value="收藏">收藏</option>
                    <option value="摆件">摆件</option>
                    <option value="配件">配件</option>
                    <option value="家居饰品">家居饰品</option>
                </select>
            </div>
            <div id="style">
                <select name="style" id="style_choose">
                    <option>风格</option>
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
                    <option>价格</option>
                    <option value="">20以下</option>
                    <option value="">20~50</option>
                    <option value="">50~100</option>
                    <option value="">100~200</option>
                    <option value="">200~500</option>
                    <option value="">500以上</option>
                </select>
            </div>
        </nav>
        <div class="choose">
            <button>最新上架</button>
            <button>好评秀秀</button>
        </div>
    </header>
    <hr>
    <div id="content">
        <div class="store">
            <div class="intro">
                <img src="mobile/index/test.png" alt="icon" class="icon">
                <p>优咕官方店<span>估粉</span></p>
                <button class="about">关于店家</button>
            </div>
            <img src="mobile/index/bg.png" alt="bg" class="bg">
            <div class="content">
                <p>冰凉的夏日哈哈哈哈哈哈哈哈哈呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵</p>
                <p class="like"><span class="aixin1 heart"></span><span class="num">12</span></p>
            </div>
        </div>
        <div class="store">
            <div class="intro">
                <img src=""mobile/index/test.png" alt="icon" class="icon">
                <p>优咕官方店<span>估粉</span></p>
                <button class="about">关于店家</button>
            </div>
            <img src="bg.png" alt="bg" class="bg">
            <div class="content">
                <p>冰凉的夏日哈哈哈哈哈哈哈哈哈呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵</p>
                <p class="like"><span class="aixin1 heart"></span><span class="num">12</span></p>
            </div>
        </div>
        <div class="store">
            <div class="intro">
                <img src="mobile/index/test.png" alt="icon" class="icon">
                <p>优咕官方店<span>估粉</span></p>
                <button class="about">关于店家</button>
            </div>
            <img src="bg.png" alt="bg" class="bg">
            <div class="content">
                <p>冰凉的夏日哈哈哈哈哈哈哈哈哈呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵</p>
                <p class="like"><span class="aixin1 heart"></span><span class="num">12</span></p>
            </div>
        </div>
        <div class="store">
            <div class="intro">
                <img src="mobile/index/test.png" alt="icon" class="icon">
                <p>优咕官方店<span>估粉</span></p>
                <button class="about">关于店家</button>
            </div>
            <img src="bg.png" alt="bg" class="bg">
            <div class="content">
                <p>冰凉的夏日哈哈哈哈哈哈哈哈哈呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵</p>
                <p class="like"><span class="aixin1 heart"></span><span class="num">12</span></p>
            </div>
        </div>
        <div class="store">
            <div class="intro">
                <img src="mobile/index/test.png" alt="icon" class="icon">
                <p>优咕官方店<span>估粉</span></p>
                <button class="about">关于店家</button>
            </div>
            <img src="bg.png" alt="bg" class="bg">
            <div class="content">
                <p>冰凉的夏日哈哈哈哈哈哈哈哈哈呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵</p>
                <p class="like"><span class="aixin1 heart"></span><span class="num">12</span></p>
            </div>
        </div>
        <div class="store">
            <div class="intro">
                <img src="mobile/index/test.png" alt="icon" class="icon">
                <p>优咕官方店<span>估粉</span></p>
                <button class="about">关于店家</button>
            </div>
            <img src="mobile/index/bg.png" alt="bg" class="bg">
            <div class="content">
                <p>冰凉的夏日哈哈哈哈哈哈哈哈哈呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵呵</p>
                <p class="like"><span class="aixin1 heart"></span><span class="num">12</span></p>
            </div>
        </div>
    </div>
    <footer>
        <button class="top"><span class="arrawup"></span></button>
    </footer>
</body>
</html>