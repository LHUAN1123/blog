<!DOCTYPE html>
<html class="x-admin-sm">
    
    <head>
        <meta charset="UTF-8">
        <title>欢迎页面-X-admin2.2</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <link rel="stylesheet" href="/admin/css/font.css">
        <link rel="stylesheet" href="/admin/css/xadmin.css">
        <script type="text/javascript" src="/admin/lib/layui/layui.js" charset="utf-8"></script>
        <script type="text/javascript" src="/admin/js/xadmin.js"></script>
        <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
        <!--[if lt IE 9]>
            <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
            <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="layui-fluid">
            <div class="layui-row">
                <form class="layui-form">
                  <div class="layui-form-item">
                      <label for="username" class="layui-form-label">
                          <span class="x-red">*</span>用户名
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" id="username" name="username" value="{{$result->username}}" maxlength="10" required="" lay-verify="required"
                          autocomplete="off" class="layui-input">
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          <span class="x-red">*</span>将会成为您唯一的登入名
                      </div>
                  </div>
				  <div class="layui-form-item">
                      <label for="L_email" class="layui-form-label">
                          <span class="x-red">*</span>昵称
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" id="L_email" name="nickname" value="{{$result->nickname}}" maxlength="15" required="" lay-verify="email"
                          autocomplete="off" class="layui-input">
                      </div>
                  </div>

                  <div class="layui-form-item">
                      <label for="L_email" class="layui-form-label">
                          <span class="x-red">*</span>邮箱
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" id="L_email" maxlength="50" value="{{$result->email}}" name="email" required="" lay-verify="email"
                          autocomplete="off" class="layui-input">
                      </div>

        				    <label class="layui-form-label">选择框</label>
        				    <div class="layui-input-inline">
        				      <select name="role" lay-verify="required">
        				        <option value="">请选择一个角色</option>
        				        @foreach($data as $v)
        				        <option value="{{$v->id}}"{{$result->role == $v->id?'selected' : ''}}>{{$v->name}}</option>
        				        @endforeach
        				      </select>
        				    </div>
        				  </div>
                  <div class="layui-form-item">
                      <label for="L_repass" class="layui-form-label">
                      </label>
                      <a class="layui-btn" id="btn" onclick="update()">修改角色</a>
                  </div>
              </form>
            </div>
        </div>
        <script>layui.use(['form', 'layer'],
            function() {
                $ = layui.jquery;
                var form = layui.form,
                layer = layui.layer;

                //自定义验证规则
                form.verify({
                    nikename: function(value) {
                        if (value.length < 5) {
                            return '昵称至少得5个字符啊';
                        }
                    },
                    pass: [/(.+){6,12}$/, '密码必须6到12位'],
                    repass: function(value) {
                        if ($('#L_pass').val() != $('#L_repass').val()) {
                            return '两次密码不一致';
                        }
                    }
                });
            });

        // 添加
	        function update() {
	              var index = parent.layer.getFrameIndex(window.name); //得到当前iframe层的索引
	              $.ajaxSetup({
	                  headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
	              });
	              $.ajax({
	                  type: "POST",
	                  url: "/admin/user/{{$result->id}}",
	                  data:$('form').serialize(),
	                  success: function (data) {
	                      if (data.code == 1) {
	                          layer.alert(data.msg, function () {
	                              window.parent.location.reload(index, function () {
	                                  location.href = '/admin/user';
	                              });
	                          });
	                      } else {
	                          layer.alert(data.msg);
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
