var my_id = getParam('myid');
var a= getParam('a');
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': x_csrf_token,
    }
});


function getParam(paramName) {
    paramValue = "";
    isFound = false;
    if (this.location.search.indexOf("?") == 0 && this.location.search.indexOf("=") > 1) {
        arrSource = unescape(this.location.search).substring(1, this.location.search.length).split("&");
        i = 0;
        while (i < arrSource.length && !isFound) {
            if (arrSource[i].indexOf("=") > 0) {
                if (arrSource[i].split("=")[0].toLowerCase() == paramName.toLowerCase()) {
                    paramValue = arrSource[i].split("=")[1];
                    isFound = true;
                }
            }
            i++;
        }
    }
    return paramValue;
}//获取参数
$(document).ready(function() {
    if(a<2){
        $("button").click(function() {

            var content = $(".submit").val();


            $.ajax({
                url: assist_comment_add_url, //请求的url地址
                dataType: "json", //返回格式为json
                data: {
                    "assist_id": my_id,

                    "content": content

                }, //参数值
                type: "post", //请求方式
                success: function (res) {
                    alert(res.msg);
                    location.href = '/moments';


                }

            });
            });
    }

   else
        {
            $("button").click(function() {
                var content = $(".submit").val();
            $.ajax({
                url:story_comment_add_url, //请求的url地址
                dataType: "json", //返回格式为json
                data: {
                    "story_id": my_id,

                    "content": content

                }, //参数值
                type: "post", //请求方式
                success: function (res) {
                    alert(res.msg);
                    location.href = '/moments';


                }
            });

            });
        }



});
