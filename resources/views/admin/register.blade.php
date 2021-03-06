<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>后台登录</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel="stylesheet" href="/admin/assets/css/reset.css">
        <link rel="stylesheet" href="/admin/assets/css/supersized.css">
        <link rel="stylesheet" href="/admin/assets/css/style.css">
		<style type="text/css">
			/*按钮css*/
	        .sel_btn{
	            height: 41px;line-height: 41px;padding: 0 11px;margin-top: 20px;
	            width: 280px;background: #ef4300;border-radius: 3px;color: #fff;
	            display: inline-block;text-decoration: none;font-size: 17px;outline: none;
	        }
	        .ch_cls{background: #ef4300;}
	        #code{width: 90px;margin-top:-20px!important;line-height:40px;}
	        #img{float: left; line-height:40px;margin-top: -13px; margin-left: 5px;}
			a{text-decoration: none; border-bottom: 0px solid; color: #fff}
	        h1{color: #fff}
	        body{color: #111}
		</style>
    </head>

    <body onkeydown="keyLogin();">
        <div class="page-container">
            <h1><b>用户注册</b></h1>
            <form>
                <input type="text" name="username"  autocomplete="off" maxlength="20" class="username" placeholder="请输入用户名">
                <input type="text" name="nickname" autocomplete="off" class="nickname" maxlength="25" placeholder="请输入昵称">
                <input type="text" name="email" autocomplete="off" class="email" maxlength="25" placeholder="请输入邮箱">
                <input type="password" name="password"  class="password" maxlength="25" placeholder="请输入密码">
                <input type="password" name="repassword"  class="repassword" maxlength="25" placeholder="请输入确认密码">
                <a class="sel_btn ch_cls" href="#" style="margin-top:20px;" lay-submit id="doregister"><b>注&nbsp;&nbsp;&nbsp;&nbsp;册</b></a>
            </form>
        </div>

        <!-- Javascript -->
        <script src="/admin/assets/js/jquery-1.8.2.min.js"></script>
        <script src="/admin/assets/js/supersized.3.2.7.min.js"></script>
        <script src="/admin/assets/js/supersized-init.js"></script>
        <script src="/admin/assets/js/scripts.js"></script>
    	<script src="/admin/lib/layui/layui.all.js" charset="utf-8"></script>
		<script>
		$("#change").click(function(){  
		       $url = "{{ URL('index/captcha') }}";  
		       $url = $url + "/" + Math.random();  
		       document.getElementById('img').src=$url;  
		    });

			function keyLogin(){
			 if (event.keyCode==13)  //回车键的键值为13
			   document.getElementById("doregister").click(); //调用登录按钮的登录事件
			}

			$('#doregister').click(function () {
		        $.ajaxSetup({
		            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
		        });
				$.ajax({
					type:'post',
					url:'/admin/doregister',
					data:$('form').serialize(),
					dataType:'json',
					success: function (data) {
						if (data.code == 1) {
							layer.msg(data.msg,{
								time:1000,
								icon:6,		
							},function () {
								location.href = '/admin/login'
							}); 
						} else {
							layer.open({
								title:'注册失败！',
								content:data.msg,
								icon:2,
								anim:1
							});
						}
					},
		            error : function (msg ) {
		                var json=JSON.parse(msg.responseText);
		                $.each(json.errors, function(index, obj) {
		                    layer.open({
		                       content:obj[0],
		                       icon:5,
		                       anim:6  
		                    });
		                    return false;
		                });
		            }
				});
			});
		</script>
    </body>
</html>

