<!DOCTYPE html>
<html class="x-admin-sm">
    
    <head>
        <meta charset="UTF-8">
        <title>欢迎页面-X-admin2.2</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <link rel="stylesheet" href="/admin/css/font.css">
        <link rel="stylesheet" href="/admin/css/xadmin.css">
        <link rel="stylesheet" href="/admin/drop/dist/basic.min.css">
        <link rel="stylesheet" href="/admin/drop/dist/dropzone.min.css">
        <script type="text/javascript" src="/admin/lib/layui/layui.js" charset="utf-8"></script>
        <script type="text/javascript" src="/admin/drop/dist/dropzone.min.js"></script>
        <script type="text/javascript" src="/admin/js/xadmin.js"></script>
	    <style type="text/css">
	    .dropzone {
	        border: 2px dashed #778899;
	        border-radius: 5px;
	        background: white;
	    }
	    .layui-input:focus, .layui-textarea:focus{border-color:#003398!important}
	    </style>
        <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
        <!--[if lt IE 9]>
            <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
            <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="layui-fluid">
            <div class="layui-row">
                <form class="layui-form" id="uploadForm">
				  <div class="layui-form-item" style="width: 70%;">
				    <label class="layui-form-label">音乐名称</label>
				      <div class="layui-input-block">
				        <input type="text" name="title" required  lay-verify="required" maxlength="50" placeholder="请输入音乐名称" autocomplete="off" class="layui-input">
				     </div>
				  </div>
				  <div class="layui-form-item layui-form-text" style="width: 70%;">
					  <label class="layui-form-label">音乐描述</label>
					    <div class="layui-input-block">
					      <textarea name="text" placeholder="请输入音乐描述内容" class="layui-textarea"></textarea>
					    </div>
				   </div>			
			       <div class="layui-form-item">
			           <label class="layui-form-label">音乐文件</label>
			           <div class="form-group" style="width: 430px; margin-left: 110px;">
			               <div id="dropz" class="dropzone"></div>
			           </div>
			           <div id="imgs" style="padding: 5px 10px 10px 5px;text-align: center;"></div>
			           <span id="music_Id"></span>
			       </div>
			        <div class="layui-form-item">
			            <label for="L_repass" class="layui-form-label">
			            </label>
			            <a class="layui-btn" id="btn" onclick="save_content()">保存</a>
			        </div>
              </form>
            </div>
        </div>
        <script>
        	//初始化插件
		    Dropzone.autoDiscover = false;

		    //视频截图上传
		    var myDropzone = new Dropzone("#dropz", {
		        headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
		        autoProcessQueue: true, //自动上传
		        url: "/admin/upload",//文件提交地址
		        type:"post",  
		        paramName:"music", //默认为file
		        maxFiles:1,//一次性上传的文件数量上限
		        maxFilesize: 1024, //文件大小，单位：MB
		        acceptedFiles: ".MP3,.FLAC,.APE,.wmv,.wav,.mid", //上传的类型
		        uploadMultiple: true,
		        addRemoveLinks:true,
		        parallelUploads: 1,//一次上传的文件数量
		        dictDefaultMessage:'拖动要上传音乐到此',
		        dictMaxFilesExceeded: "只能上传一首音乐",
		        dictResponseError: '文件上传失败!',
		        dictFallbackMessage:"浏览器不受支持",
		        dictFileTooBig:"文件过大上传文件最大支持.",
		        dictRemoveFile: '删除',
		        dictCancelUpload: "取消",
		        addRemoveLinks: true,
		        init:function(){
		            this.on("addedfile", function(file) {
		                //上传文件时触发的事件
		                document.querySelector('div .dz-success-mark').style.display = 'block';
		            });
		            this.on("success",function(file,data){
		                //上传成功触发的事件
		                console.log('ok');
		                document.querySelector('div .dz-success-mark').style.display = 'block';
		                $("#music_Id").append("<input type='hidden'"+" name='music_id'" + "value=" + data.id + ">");
		                $('.dz-remove').remove('href');
		                $("#dropz a:first").attr('onclick',"picture_del(this,'"+ data.id +"')");
		            });
		            this.on("error",function (file,data) {
		                //上传失败触发的事件
		                console.log('fail');
		                var message = '';
		                //lavarel框架有一个表单验证，
		                //对于ajax请求，JSON 响应会发送一个 422 HTTP 状态码，
		                //对应file.accepted的值是false，在这里捕捉表单验证的错误提示
		                if (file.accepted){
		                    $.each(data,function (key,val) {
		                        message = message + val[0] + ';';
		                    })
		                }
		            });
		            this.on("removedfile",function(file){
		            });
		        }
		    });

		    function save_content() {
		        var index = parent.layer.getFrameIndex(window.name); //得到当前iframe层的索引
		        $.ajaxSetup({
		            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
		        });
		        $.ajax({
		            type: "POST",
		            url: "/admin/music",
		            data:$('form').serialize(),
		            success: function (result) {
		                if (result == 1) {
		                    layer.alert('添加成功', function () {
		                        window.parent.location.reload(index, function () {
		                            location.href = '/admin/video';
		                        });
		                    });
		                } else {
		                    layer.alert('添加失败');
		                }
		            },
		            error : function (msg ) {
		                var json=JSON.parse(msg.responseText);
		                $.each(json.errors, function(index, obj) {
		                    layer.alert(obj[0]);
		                    return false;
		                });
		            }
		        })
		    }
		</script>

    </body>

</html>
