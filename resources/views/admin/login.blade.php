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
            <h1><b>用户登录</b></h1>
            <form>
                <input type="text" name="username"  autocomplete="off" maxlength="20" class="username" placeholder="请输入用户名">
                <input type="password" name="password"  class="password" maxlength="25" placeholder="请输入密码">
                <div style="height: 60px;margin-top:20px;">
				   <img src="{{ URL('index/captcha/1') }}" alt="验证码" title="刷新图片" width="110" height="43" id="img" border="0">
				   <input type="text" id="code" autocomplete="off" placeholder="请输入验证码" name="captcha"><span> <a id="change" href="javascript:;" code_src=""> 换一张</a></span>
                </div>
                 
                <a class="sel_btn ch_cls" href="#" style="margin-top:-10px;" lay-submit id="login"><b>登&nbsp;&nbsp;&nbsp;&nbsp;录</b></a>
                <div style="margin-top: 15px;color: #fff;" id="forget" ><span><b><a href="/admin/forget">忘记密码？</a></b></span><span style="margin-left: 110px;"><b><a href="/admin/register">注册</a></b></span></div>
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
			   document.getElementById("login").click(); //调用登录按钮的登录事件
			}

			$('#login').click(function () {
		        $.ajaxSetup({
		            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
		        });
				$.ajax({
					type:'post',
					url:'/admin/doLogin',
					data:$('form').serialize(),
					dataType:'json',
					success: function (data) {
						if (data.code == 2) {
							layer.msg('登录成功，正在跳转！', {
								time:1000,
								icon:6,
							}, function () {
								location.href = '/'
							}); 
						} else {
							layer.open({
								title:'登录失败！',
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

