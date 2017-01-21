<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商家后台</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <script src="{{asset('js/jquery-3.1.0.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/Store_Index.css')}}">
    <style>
        button {
            cursor: pointer;
        }
    </style>
    <script>
        $(function () {
            //测试数据
//            var $goods = {$data};
//            var html = '';
//            $.each($goods,function (index,value) {
//                html+='<div class="goods"> <figure> <img src='+$data->logo_url+' alt="goods"> <button class="delete">&#xe600;</button> <figcaption>'+$data->name+'</figcaption> </figure> <button data-id="'+$data->id+'" class="revise">修改</button> <button class="detail">详情</button> </div>'
//            });
//            $("#content").append(html);

            //引入数据
            var html='';
            $.ajax({
                url:"{{url('goods/tradergoods')}}",
                type:"POST",
                data:{},
                dataType:"json",
                success:function (data) {
                    if(data.error!=0){
                        alert("error");
                    }else{
                        $.each(data.data,function (index,value) {
//                            console.log(value);
                            html+='<div class="goods"> <figure> <img src='+value.img+' alt="goods"> <button class="delete">&#xe600;</button> <figcaption>'+value.store_name+'</figcaption> </figure> <button data-id="'+value.id+'" class="revise">修改</button> <button class="detail">详情</button> </div>'
                        })
                    }
                },
                error:function () {
                    console.log("error");
                }
            });

            $("#create").click(function () {
                //用户跳转到发布页面
                {{--window.location.href="{{url('trader/create')}}";--}}
                window.location.href="{{url('trader/create')}}";

            });

            $(document).on('click','.revise',function () {
                //用户跳转到修改页面
//                window.location.href="{php echo $this->createMobileUrl('Changegoods',array('openid'=>$openid));}"+"&goods_id="+$(this).attr("data-id");
                // alert($(this).attr("data-id"));
            });
            $(document).on('click','.delete',function () {
                $.ajax({
                    url:"{php echo $this->createMobileUrl('Deletegoods',array('openid'=>$openid));}",
                    type:"POST",
                    data:{
                        "id":$(this).parent().next().attr("data-id"),
                        "delete":1
                    },
                    success:function (msg) {
                        alert(msg);
                    },
                    error:function () {
                        alert("error");
                    }
                });
                $(this).parent().parent().remove();
            });
        })
    </script>
</head>
<body>
<header>
    <button id="create">发布商品</button>
</header>
<div id="content"></div>
<script src="{{asset('js/Store_Index.js')}}"></script>
</body>
</html>