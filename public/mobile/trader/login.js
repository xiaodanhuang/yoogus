$(function () {

    $.ajaxSetup({
        headers : {
            'x_csrf':x_csrf_token
        }
    });
    // $.ajax({
    //     url:token_url,  //我的改成了8080端口，这里修改成你自己的，这个URL获取uptoken用的
    //     type:"POST",
    //     async:false,
    //     dataType:"json",
    //     data:{
    //         // 'pw':"zhanghao"
    //     },
    //     success:function(data)
    //     {
    //         console.log(data);
    //         if(data.error==0){
    //             $("#uptoken").val(data.uptoken);
    //
    //         }else{
    //             alert(data.msg);
    //         }
    //     },
    //     error:function(a,b,c)
    //     {
    //         console.log(a+b+c);
    //     }
    // });
    var img='';
    var uploader = Qiniu.uploader({
        runtimes: 'html5,flash,html4',
        browse_button: 'pickfiles',
        // uptoken: $("#uptoken").val(),
        uptoken_func: function(file){    // 在需要获取uptoken时，该方法会被调用
            // do something
            $.ajax({
                url:token_url,  //我的改成了8080端口，这里修改成你自己的，这个URL获取uptoken用的
                type:"POST",
                async:false,
                dataType:"json",
                data:{
                    path:"goods",
                },
                success:function(data)
                {
                    console.log(data);
                    if(data.error==0){
                        $("#uptoken").val(data.uptoken);
                        window.file_name = data.key;
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
            return $("#uptoken").val();
        },
        get_new_uptoken: true,
        nique_names: true ,
        save_key: false ,
        domain: 'http://qiniu.hduhelp.com/',
        // domain: 'http://imgs.yoogus.com/',
        container: 'container',
        max_file_size: '100mb',
        flash_swf_url: 'Moxie.swf',
        max_retries: 3,
        dragdrop: true,
        drop_element: 'container',
        chunk_size: '4mb',
        multi_selection: false,
        auto_start: true,
        init: {
            'FilesAdded': function(up, files) {
                plupload.each(files, function(file) {

                    var Split=file['name'].split('.');
                    var type=Split[Split.length-1];
                    // $.ajax({
                    //     url:getname_url,   //我的改成了8080端口，这里修改成你自己的 这里url获取文件名用的
                    //     type:"POST",
                    //     async:false,
                    //     dataType:"json",
                    //     data:{
                    //         // 'pw':"zhanghao",
                    //         'type':type
                    //     },
                    //     success:function(data)
                    //     { console.log(data);
                    //         if(data.error==0){
                    //             // file['name']=data.data;
                    //             file['name']="test";
                    //             console.log('newFilename:'+file['name']);
                    //         }else{
                    //             alert(data.msg);
                    //         }
                    //     },
                    //     error:function(a,b,c)
                    //     {
                    //         console.log(a+b+c);
                    //     }
                    // });
                });
            },
            'BeforeUpload': function(up, file) {
            },
            'UploadProgress': function(up, file) {
            },
            'UploadComplete': function() {
                img='<img src="http://qiniu.yoogus.com/'+file_name+'" class="uploadPic"></img>'
                $("#pickfiles").empty();
                $("#pickfiles").append(img);
                img='';
                alert('成功上传');
            },
            'FileUploaded': function(up, file, info) {
                // var res = parseJSON(info);
                // alert(info.hash);
            },
            'Error': function(up, err, errTip) {
            }
        }
    });
});
