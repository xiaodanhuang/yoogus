var tpl = 0;
number = 1;
storypage = 1;
storytype = 1;
findpage = 1;
findtype = 1;
findnumber=0;
storynumber=0;
find_length=0;
story_length=0;
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': x_csrf_token,
    }
});
function addlike(re) {
    story_id=re.attr("myid");
    $.ajax({
        url: story_like_url, //请求的url地址
        dataType: "json", //返回格式为json
        data: {
        	"story_id":story_id,


        }, //参数值
        type: "post", //请求方式
        success: function(res) {
            console.log(res)       ;



        }

    });

} //加载更多评论





function changestate() {
	$("#looking").click(function() {
        $("#story").css({"color":"white"});
        $(this).css({"color":"black"});
		$('.content2').hide();
		$('.content1').show();
		$('.zuizan').hide();
		$('.zuiji').show();

	});

	$("#story").click(function() {
        $("#looking").css({"color":"white"});
        $(this).css({"color":"black"});
		$('.content1').hide();
		$('.content2').show();
		$('.zuizan').show();
		$('.zuiji').hide();

	});

} //寻饰启示饰品故事页面互相跳转

function upfindlist(re) {
	my_id=re.attr("myid");
	$.ajax({
		url: assist_comment_get_url, //请求的url地址
		dataType: "json", //返回格式为json
		data: {
			"page": 1,
			"per_page": 10000,
		"assist_id":my_id

		}, //参数值
		type: "post", //请求方式
		success: function(res) {
			console.log(res)       ;
            var $item;
           var  ping= re.attr("myid");
            if(res.data.length<1){
            	var nocoment=$('<div></div>');
            	nocoment.html("亲现在没有评论哦");
                re.next(nocoment);


            }

			for(var i = 0; i <res.data.length; i++) {
				$item = $(getitemTpl());
				$item.find('.dis').html("<span style='font-size:20px ;color:#1E90FF;'>" + res.data[i].nickname + ":" + "</span>" +
					"<span style='font-size:20px'>" + res.data[i].content + "</span>");
				re.after($item);
			}

		}

	});

} //加载更多评论
function upstorylist(re) {

	my_id=re.attr("myid");
	alert(my_id);
	$.ajax({
		url: story_comment_get_url, //请求的url地址
		dataType: "json", //返回格式为json
		data: {
			"page": 1,
			"per_page": 5,
		"story_id":my_id

		}, //参数值
		type: "post", //请求方式
		success: function(res) {
			console.log(res)  ;
            if(res.data.length<1){
                var nocoment=$('<div></div>');
                nocoment.html("亲现在没有评论哦");
                re.after(nocoment);


            }
            var $item;
			for(var i = 0; i <res.data.length; i++) {
				$item = $(getitemTpl());
				$item.find('.dis').html("<span style='font-size:20px ;color:#1E90FF;'>" + res.data[i].nickname + ":" + "</span>" +
					"<span style='font-size:20px'>" + res.data[i].content + "</span>");
				re.after($item);
			}

		}

	});

} //加载故事更多评论


function upuser() {
	$.ajax({
		url: assist_get_url, //请求的url地址
		dataType: "json", //返回格式为json
		data: {

			"page": findpage,
			"per_page": 5,
			"type": findtype

		}, //参数值
		type: "post", //请求方式
		success: function(res) {
           find_length=res.data.length;
			if(res.data.length) {
                console.log(res);
                var $content = $('.content1');

                var $item;

                for (var i = 0; i < res.data.length; i++) {
                    $item = $(getuserTpl());
                    $content.append($item);

                    $('.user').eq(findnumber).attr("myid", res.data[i].assist_id);
                    $('.userimg').eq(findnumber).attr('src', res.data[i].headimgurl);
                    $('.usermessage').eq(findnumber).html(res.data[i].nickname + "<br/>" + res.data[i].date);
                    $('.usercoment').eq(findnumber).attr("myid", res.data[i].assist_id);
                    $('.number').eq(findnumber).html(res.data[i].level);
                    $('.useradd').eq(findnumber).attr("myid", res.data[i].assist_id);
                    $('.userreadmore').eq(findnumber).attr("myid",res.data[i].assist_id);
                    $('.userreadmore').eq(findnumber).attr("pinglun",findnumber);
                    $('.userpinglun').eq(findnumber).attr("id",findnumber);
                    $('.userpublish').eq(findnumber).text(res.data[i].content);

                    var photo = getphoto(res.data[i].img);
                    $('.picture').eq(findnumber).append(photo);
                    findnumber++;

                }
            }

		}

	});
	findpage++;





} //加载更多寻饰启示

function upstory() {
	$.ajax({
		url: story_get_url, //请求的url地址
		dataType: "json", //返回格式为json
		data: {

			"page": storypage,
			"per_page": 5,
			"type": storytype

		}, //参数值
		type: "post", //请求方式
		success: function(res) {

			if(res.data.length) {
				console.log(res);

           story_length=res.data.length;

				var $content = $('.content2');
				var $item;
				for(var i = 0; i < res.data.length; i++) {
					$item = $(getstoryTpl());
					$content.append($item);
					$('.storyimg').eq(storynumber).attr('src', res.data[i].headimgurl);
					$('.storymessage').eq(storynumber).html(res.data[i].nickname + "<br/>" + res.data[i].date);
					$('.storynumber').eq(storynumber).html(res.data[i].num_like);
                    $('.storynumber').eq(storynumber).attr("myid",res.data[i].num_like);
                    $('.storyadd').eq(storynumber).attr("myid",res.data[i].story_id );
                    $('.storyreadmore').eq(storynumber).attr("myid",res.data[i].story_id);
                    $('.storyreadmore').eq(storynumber).attr("pinglun",storynumber);
					$('.storypublish').eq(storynumber).html(res.data[i].content);
					$('.storyzan').eq(storynumber).attr("myid",res.data[i].story_id);
                    $('.storypinglun').eq(storynumber).attr("myid",storynumber);
                    $('.storyzan').eq(storynumber).attr("like",res.data[i].is_like);
					if(res.data[i].is_like<2){
                       $('.storyzan').eq(storynumber).css({"background-image":"url(mobile/moments/img/lovebigr.png)"});
					}
					storynumber++;
				}
                console.log(storynumber);
			}
		}

	});
	storypage++;


} //加载更多饰品故事
function getphoto(res) {

	var allphoto = $('<div></div>');

	for(var i = 0; res.length != 0, i < res.length; i++) {

		var photo = $('<img class="pic" />');
		photo.attr('src', res[i]['url']);
		allphoto.append(photo);

	}

	return allphoto;
} //照片添加

function getitemTpl(tpl) {
	if(!tpl) {
		tpl = $('#listItemTpl').html();
	}
	return tpl;
} //评论模板获取
function getuserTpl(tpl) {
	if(!tpl) {
		tpl = $('#userItemTpl').html();
	}
	return tpl;
} //寻饰启示模板获取
function getstoryTpl(tpl) {
	if(!tpl) {
		tpl = $('#storyItemTpl').html();
	}
	return tpl;
} //饰品故事获取

$(document).ready(function() {
	upuser();
    upstory();
	$('.content2').hide();
	changestate(); //改变点击状态
	var stop = true;
	$(window).scroll(function() {
		totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());
		if($(document).height() <= totalheight) {

			if($('.content1').is(':hidden')) {
				if(story_length>4) {
                    upstory();
                }

			} else {
                if(find_length>4) {
                    upuser();
                }
			}
		}
	});

	$(".zuixin").click(function() {

        $(this).css({"color":"black"});
		if($('.content2').is(':hidden')) {

			findtype = 1;
			findpage = 1;
			findnumber=0;
			$('.content1').empty();
			upuser();
            $(".zuiji").css({"color":"#4ABC96"});

		} else {
			storytype = 1;
			storypage = 1;
			storynumber=0;
			$('.content2').empty();
            $(".zuizan").css({"color":"#4ABC96"});
			upstory();



		}

	});
    $(".findthing").click(function() {
        location.href="trader/create";

    });
	$(".zuiji").click(function() {
        $(".zuixin").css({"color":" #4ABC96"});
        $(this).css({"color":"black"});
		findtype = 2;
		findpage = 1;
        findnumber=0;
		$('.content1').empty();
        if(find_length>4) {
            upuser();
        }
	});
	$(".zuizan").click(function() {
        $(".zuixin").css({"color":" #4ABC96"});
        $(this).css({"color":"black"});

		storytype = 2;
		storypage = 1;
        storynumber=0;
		$('.content2').empty();
		if(story_length>4) {
            upstory();
        }

	});

});
$(document).on('click', '.userreadmore', function() {

	        	upfindlist($(this));
});
$(document).on('click', '.storyreadmore', function() {

    upstorylist($(this));

});

$(document).on('click', '.useradd', function() {
	var myid=$(this).attr("myid");

    location.href="moments/submit?a=1&myid="+myid;
});
$(document).on('click', '.storyadd', function() {
    var myid=$(this).attr("myid");
	location.href="moments/submit?a=3&myid="+myid;
});
$(document).on('click', '.share', function() {

    window.location.href = share_url;
});
$(document).on('click', '.storyzan', function() {
		var likestates = $(this).attr('myid');
    var likestate= $(this).attr('like');
    var myzan= $(this).siblings(".storynumber").attr("myid");

    if(likestate>1){
    	myzan++;
        $(this).css({"background-image":"url(mobile/moments/img/lovebigr.png)"});
        $(this).siblings(".storynumber").html(myzan);
        $(this).attr("like",1);
    }
    else{
        myzan=myzan-1;
        $(this).css({"background-image":"url(mobile/moments/img/loveb.png)"});
        $(this).siblings(".storynumber").html(myzan);
        $(this).attr("like",2);
	}
    addlike($(this));



});

