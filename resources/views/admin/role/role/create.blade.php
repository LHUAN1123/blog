<!DOCTYPE html>
<html class="x-admin-sm">
    
    <head>
        <meta charset="UTF-8">
        <title>欢迎页面-X-admin2.2</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
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
                          <span class="x-red">*</span>角色名
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" id="name" name="name" required="" lay-verify="required"
                          autocomplete="off" class="layui-input">
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          <span class="x-red">*</span>添加一个角色
                      </div>
                  </div>
                  <div class="layui-form-item layui-form-text" style="width: 70%;">
                    <label class="layui-form-label">角色描述</label>
                      <div class="layui-input-block">
                        <textarea name="describe" placeholder="请输入内容" class="layui-textarea"></textarea>
                      </div>
                   </div> 
                  <div class="layui-form-item">
                      <label for="L_repass" class="layui-form-label">
                      </label>
                      <a class="layui-btn" id="btn" onclick="save_content()">添加角色</a>
                  </div>
              </form>
            </div>
        </div>
        <script>
          function save_content() {
              var index = parent.layer.getFrameIndex(window.name); //得到当前iframe层的索引
              $.ajaxSetup({
                  headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
              });
              $.ajax({
                  type: "POST",
                  url: "/admin/role",
                  data:$('form').serialize(),
                  success: function (result) {
                      if (result.code == 1) {
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
