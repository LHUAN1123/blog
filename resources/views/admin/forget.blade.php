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
	        h1{color: #fff}
	        body{color: #111}
		</style>
    </head>

    <body onkeydown="keyLogin();">
        <div class="page-container">
            <h1><b>忘记密码</b></h1>
            <form>
                <input type="text" name="email" id="email" autocomplete="off" maxlength="20" class="username" placeholder="请输入绑定的邮箱">
                <input type="password" name="newpass" id="newpass" style="display:none" autocomplete="off" maxlength="20" class="username" placeholder="请输入新密码">
                <a class="sel_btn ch_cls forget" href="#" style="margin-top:10px;" lay-submit id="forget"><b>下一步</b></a>
                <a class="sel_btn ch_cls forget1" href="#" style="margin-top:10px;display:none" lay-submit id="doemail"><b>确认修改</b></a>
            </form>
        </div>

        <!-- Javascript -->
        <script src="/admin/assets/js/jquery-1.8.2.min.js"></script>
        <script src="/admin/assets/js/supersized.3.2.7.min.js"></script>
        <script src="/admin/assets/js/supersized-init.js"></script>
        <script src="/admin/assets/js/scripts.js"></script>
    	<script src="/admin/lib/layui/layui.all.js" charset="utf-8"></script>
		<script>
			function keyLogin(){
			 if (event.keyCode==13)  //回车键的键值为13
			   //document.getElementById("doemail").click(); //调用登录按钮的登录事件
			   $('#doemail').click();
			}

			$('.forget').click(function () {
		        $.ajaxSetup({
		            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
		        });
				$.ajax({
					type:'post',
					url:'/admin/doforget',
					data:$('form').serialize(),
					dataType:'json',
					success: function (data) {
						if (data.code == 1) {
							layer.msg(data.msg, {
								time:2000,
								icon:6,
							}, function () {
								$('#doemail').css("display","block");
								$('#email').css("display", "none");
								$("#forget").css("display", 'none');
								$("#newpass").css("display", "block");
//								$("#hide").val(data.result);
							}); 
						} else {
							layer.open({
								title:'失败！',
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

			$('.forget1').click(function () {
				$.ajaxSetup({
					headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
				});
				$.ajax({
					type:'post',
					url:'/admin/modify_pass',
					data:$('form').serialize(),
					dataType:'json',
					success: function (data) {
						if (data.code == 1) {
							layer.msg(data.msg, {
								time:2000,
								icon:6,
							}, function () {
							location.href = '/admin/login'
						});
			} else {
				layer.open({
					title:'失败！',
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

