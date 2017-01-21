  $(document).ready(function (){

    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': x_csrf_token,
    }
});

  $('#introduce').focus(function (){
  this.style.borderBottom="5px solid #328CCB";
  this.style.fontSize="2rem";
  this.style.textAlign="left";
  this.style.lineHeight="50px";
  this.style.paddingLeft="12px";
  $('.in,.inpic').show();
  $(this).attr('placeholder','');
  // $('.intro').css('height','300px');
});
$('#introduce').blur(function (){
  this.style.borderBottom="2px solid #999";
  this.style.fontSize="2.6rem";
  this.style.textAlign="center";
  this.style.lineHeight="350px";
  this.style.paddingLeft="12px";
  $('.in,.inpic').hide();
  $(this).attr('placeholder','不超过200个字');
});

$('#back').click(function (){
    history.back();
});



  
$(function(){
    var uploader = Qiniu.uploader({
                runtimes: 'html5,flash,html4', 
                browse_button: 'pickfiles',
                // uptoken: window.token,
                 uptoken_func: function(file){    // 在需要获取uptoken时，该方法会被调用
            // do something

            $.ajax({
                url:token_url,  //我的改成了8080端口，这里修改成你自己的，这个URL获取uptoken用的
                type:"POST",
                async:false,
                dataType:"json",
                data:{
                    path:"moments",
                },
                success:function(data)
                {
                    console.log(data);
                    if(data.error==0){
                        window.token=data.uptoken;
                        window.file_name = data.key;
                        console.log(file_name);
                        console.log(token);
                    }else{
                        alert(data.msg);
                    }
                },
                error:function(a,b,c)
                {
                    console.log(a+b+c);
                }
            });
            file['name']=window.file_name;
            return window.token;
        },
                get_new_uptoken:true,
                nique_names: false , 
                save_key: false ,
                domain: 'http://qiniu.yoogus.com/',
                container: 'container',
                max_file_size: '100mb',
                flash_swf_url: 'Moxie.swf',
                max_retries: 3,
                dragdrop: true, 
                drop_element: 'container',
                chunk_size: '4mb',
                multi_selection: false,
                auto_start: false,
                init: {
                'FilesAdded': function(up, files) {
                    plupload.each(files, function(file) {

                    showPreview(file);


                      // console.log(file);
                      // console.log("每个文件上传前");
                      // lrz(file, {width:100,quaility:0.7}).then(function(){
                      //   console.log("压缩成功");
                      // }).catch(function () {
                        // 压缩失败会执行
                      //   console.log("压缩图片失败");
                      // })

                      var Split=file['name'].split('.');
                      var type=Split[Split.length-1];
                      // console.log(file['name']);
                      var file1=file['name'];
                    //   $.ajax({
                    //       url:"getname.php",   //我的改成了8080端口，这里修改成你自己的 这里url获取文件名用的
                    //       type:"POST",
                    //       async:false,
                    //       dataType:"json",
                    //       data:{
                    //         'pw':"zhanghao",
                    //         'type':type
                    //       },
                    //       success:function(data)
                    //       { console.log(data);
                    //         if(data.error==0){
                    //           file['name']=data.data['key'];
                    //           console.log('newFilename:'+file['name']);
                    //         }else{
                    //           alert(data.msg);
                    //         }
                    //       },
                    //       error:function(a,b,c)
                    //       {
                    //         console.log(a+b+c);
                    //       }
                    //     });
                    });
                },
                'BeforeUpload': function(up, file) {
                      
                        
                },
                'UploadProgress': function(up, file) {
                },
                'UploadComplete': function() {
                  console.log('成功上传');
                  // window.location.reload(true);
                },
                'FileUploaded': function(up, file, info) {
                },
                'Error': function(up, err, errTip) {
                }
            }
            });

  //提交按钮
$(document).ready(function (){
  $("#sub").click(function (){
    uploader.start();
  });
});



  
  });







$(function(){
    var Q1=new QiniuJsSDK();
    var uploader1 = Q1.uploader({
                runtimes: 'html5,flash,html4', 
                browse_button: 'pickfiles',
                // uptoken: window.token,
                 uptoken_func: function(file){    // 在需要获取uptoken时，该方法会被调用
            // do something

            $.ajax({
                url:token_url,  //我的改成了8080端口，这里修改成你自己的，这个URL获取uptoken用的
                type:"POST",
                async:false,
                dataType:"json",
                data:{
                    path:"moments",
                },
                success:function(data)
                {
                    console.log(data);
                    if(data.error==0){
                        window.token=data.uptoken;
                        window.file_name = data.key;
                        console.log(file_name);
                        console.log(token);
                    }else{
                        alert(data.msg);
                    }
                },
                error:function(a,b,c)
                {
                    console.log(a+b+c);
                }
            });
            file['name']=window.file_name;

            return window.token;
        },
                get_new_uptoken:true,
                nique_names: false , 
                save_key: false ,
                domain: 'http://qiniu.yoogus.com/',
                container: 'container1',
                max_file_size: '100mb',
                flash_swf_url: 'Moxie.swf',
                max_retries: 3,
                dragdrop: true, 
                drop_element: 'container1',
                chunk_size: '4mb',
                multi_selection: false,
                auto_start: false,
                init: {
                'FilesAdded': function(up, files) {
                    plupload.each(files, function(file) {

                    showPreview(file);


                      // console.log(file);
                      // console.log("每个文件上传前");
                      // lrz(file, {width:100,quaility:0.7}).then(function(){
                      //   console.log("压缩成功");
                      // }).catch(function () {
                        // 压缩失败会执行
                      //   console.log("压缩图片失败");
                      // })

                      var Split=file['name'].split('.');
                      var type=Split[Split.length-1];
                      var file2=file['name'];
                    //   $.ajax({
                    //       url:"getname.php",   //我的改成了8080端口，这里修改成你自己的 这里url获取文件名用的
                    //       type:"POST",
                    //       async:false,
                    //       dataType:"json",
                    //       data:{
                    //         'pw':"zhanghao",
                    //         'type':type
                    //       },
                    //       success:function(data)
                    //       { console.log(data);
                    //         if(data.error==0){
                    //           file['name']=data.data['key'];
                    //           console.log('newFilename:'+file['name']);
                    //         }else{
                    //           alert(data.msg);
                    //         }
                    //       },
                    //       error:function(a,b,c)
                    //       {
                    //         console.log(a+b+c);
                    //       }
                    //     });
                    });
                },
                'BeforeUpload': function(up, file) {
                      
                        
                },
                'UploadProgress': function(up, file) {
                },
                'UploadComplete': function() {
                  console.log('成功上传');
                  // window.location.reload(true);
                },
                'FileUploaded': function(up, file, info) {
                },
                'Error': function(up, err, errTip) {
                }
            }
            });

  //提交按钮
$(document).ready(function (){
  $("#sub").click(function (){
    uploader1.start();
  });
});



  
  });





$(function(){
    var Q2=new QiniuJsSDK();
    var uploader2 = Q2.uploader({
                runtimes: 'html5,flash,html4', 
                browse_button: 'pickfiles',
                // uptoken: window.token,
                 uptoken_func: function(file){    // 在需要获取uptoken时，该方法会被调用
            // do something

            $.ajax({
                url:token_url,  //我的改成了8080端口，这里修改成你自己的，这个URL获取uptoken用的
                type:"POST",
                async:false,
                dataType:"json",
                data:{
                    path:"moments",
                },
                success:function(data)
                {
                    console.log(data);
                    if(data.error==0){
                        window.token=data.uptoken;
                        window.file_name = data.key;
                        console.log(file_name);
                        console.log(token);
                    }else{
                        alert(data.msg);
                    }
                },
                error:function(a,b,c)
                {
                    console.log(a+b+c);
                }
            });
            file['name']=window.file_name;
            return window.token;
        },
                get_new_uptoken:true,
                nique_names: false , 
                save_key: false ,
                domain: 'http://qiniu.yoogus.com/',
                container: 'container2',
                max_file_size: '100mb',
                flash_swf_url: 'Moxie.swf',
                max_retries: 3,
                dragdrop: true, 
                drop_element: 'container2',
                chunk_size: '4mb',
                multi_selection: false,
                auto_start: false,
                init: {
                'FilesAdded': function(up, files) {
                    plupload.each(files, function(file) {

                    showPreview(file);


                      // console.log(file);
                      // console.log("每个文件上传前");
                      // lrz(file, {width:100,quaility:0.7}).then(function(){
                      //   console.log("压缩成功");
                      // }).catch(function () {
                        // 压缩失败会执行
                      //   console.log("压缩图片失败");
                      // })

                      var Split=file['name'].split('.');
                      var type=Split[Split.length-1];
                      var file3=file['name'];
                    //   $.ajax({
                    //       url:"getname.php",   //我的改成了8080端口，这里修改成你自己的 这里url获取文件名用的
                    //       type:"POST",
                    //       async:false,
                    //       dataType:"json",
                    //       data:{
                    //         'pw':"zhanghao",
                    //         'type':type
                    //       },
                    //       success:function(data)
                    //       { console.log(data);
                    //         if(data.error==0){
                    //           file['name']=data.data['key'];
                    //           console.log('newFilename:'+file['name']);
                    //         }else{
                    //           alert(data.msg);
                    //         }
                    //       },
                    //       error:function(a,b,c)
                    //       {
                    //         console.log(a+b+c);
                    //       }
                    //     });
                    });
                },
                'BeforeUpload': function(up, file) {
                      
                        
                },
                'UploadProgress': function(up, file) {
                },
                'UploadComplete': function() {
                  console.log('成功上传');
                  // window.location.reload(true);
                },
                'FileUploaded': function(up, file, info) {
                },
                'Error': function(up, err, errTip) {
                }
            }
            });

  //提交按钮



  
  });



$(function(){
    var Q3=new QiniuJsSDK();
    var uploader3 = Q3.uploader({
                runtimes: 'html5,flash,html4', 
                browse_button: 'pickfiles',
                // uptoken: window.token,
                 uptoken_func: function(file){    // 在需要获取uptoken时，该方法会被调用
            // do something

            $.ajax({
                url:token_url,  //我的改成了8080端口，这里修改成你自己的，这个URL获取uptoken用的
                type:"POST",
                async:false,
                dataType:"json",
                data:{
                    path:"moments",
                },
                success:function(data)
                {
                    console.log(data);
                    if(data.error==0){
                        window.token=data.uptoken;
                        window.file_name = data.key;
                        console.log(file_name);
                        console.log(token);
                    }else{
                        alert(data.msg);
                    }
                },
                error:function(a,b,c)
                {
                    console.log(a+b+c);
                }
            });
            file['name']=window.file_name;
            return window.token;
        },
                get_new_uptoken:true,
                nique_names: false , 
                save_key: false ,
                domain: 'http://qiniu.yoogus.com/',
                container: 'container3',
                max_file_size: '100mb',
                flash_swf_url: 'Moxie.swf',
                max_retries: 3,
                dragdrop: true, 
                drop_element: 'container3',
                chunk_size: '4mb',
                multi_selection: false,
                auto_start: false,
                init: {
                'FilesAdded': function(up, files) {
                    plupload.each(files, function(file) {

                    showPreview(file);


                      // console.log(file);
                      // console.log("每个文件上传前");
                      // lrz(file, {width:100,quaility:0.7}).then(function(){
                      //   console.log("压缩成功");
                      // }).catch(function () {
                        // 压缩失败会执行
                      //   console.log("压缩图片失败");
                      // })

                      var Split=file['name'].split('.');
                      var type=Split[Split.length-1];
                      var file4=file['name'];
                    //   $.ajax({
                    //       url:"getname.php",   //我的改成了8080端口，这里修改成你自己的 这里url获取文件名用的
                    //       type:"POST",
                    //       async:false,
                    //       dataType:"json",
                    //       data:{
                    //         'pw':"zhanghao",
                    //         'type':type
                    //       },
                    //       success:function(data)
                    //       { console.log(data);
                    //         if(data.error==0){
                    //           file['name']=data.data['key'];
                    //           console.log('newFilename:'+file['name']);
                    //         }else{
                    //           alert(data.msg);
                    //         }
                    //       },
                    //       error:function(a,b,c)
                    //       {
                    //         console.log(a+b+c);
                    //       }
                    //     });
                    });
                },
                'BeforeUpload': function(up, file) {
                      
                        
                },
                'UploadProgress': function(up, file) {
                },
                'UploadComplete': function() {
                  console.log('成功上传');
                  alert('成功上传');
                  // window.location.reload(true);
                },
                'FileUploaded': function(up, file, info) {
                },
                'Error': function(up, err, errTip) {
                }
            }
            });

  //提交按钮
$(document).ready(function (){
  $("#sub").click(function (){
    uploader3.start(); 
    $.ajax({
        url:'http://localhost/yoogus/public/moments/assist/add',
        type:'post',
        dataType:'json',
        data:{
            'content':$('#introduce').val(),
            'level':$('#hurry').val(),
            'img[]':[file1,file2,file3,file4]
        },
        success:function (data){
            console.log('上传数据成功');
            console.log(data);
        },
        error:function (a,b,c){
            console.log(a+b+c);
        }
    });
  });
});



  
  });



function showPreview (file) {
    var image = new Image();
    var preloader = new mOxie.Image();
    preloader.onload = function() {
        preloader.downsize( 200, 200 );
        image.setAttribute( "src", preloader.getAsDataURL() );

        $('#imgList').append(image);
        // $('#imgList').append('<p>删除</p>');
    };
    preloader.load( file.getSource() );
}


});