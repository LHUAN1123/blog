<!DOCTYPE html>
<html class="x-admin-sm">
    
    <head>
        <meta charset="UTF-8">
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
                    <div class="layui-form-item" >
                        <label for="L_username" class="layui-form-label">
                            <span class="x-red">*</span>权限标题</label>
                        <div class="layui-input-inline" style="width: 40%;">
                            <input type="text" id="L_username" name="title" required="" value="{{$power->title}}" autocomplete="off" class="layui-input"></div>
                    </div>
                   <div class="layui-form-item">
                    <label class="layui-form-label">选择框</label>
                    <div class="layui-input-block" style="width: 40%;">
                        <select name="category" lay-verify="">
                          <option value="">请选择一个类别</option>
                          @foreach($data as $v)
                          <option value="{{$v->id}}" {{$power->category == $v->id?'selected':''}}>{{$v->type}}</option>
                          @endforeach
                        </select>  
                    </div>
                  </div>

                    <div class="layui-form-item" style="width: 90%;">
                        <label class="layui-form-label">权限路由</label>
                        <div class="layui-input-block">
                          <input type="text" name="urls" required   placeholder="请输入路由" value="{{$power->urls}}" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label for="L_repass" class="layui-form-label"></label>
                        <a class="layui-btn" id="btn" onclick="save_content()">编辑</a>
                    </div>
                </form>
            </div>
        </div>

 
    </body>
    <script>

            //Demo
            layui.use('form', function(){
              var form = layui.form;
              
              //监听提交
              form.on('submit(formDemo)', function(data){
                layer.msg(JSON.stringify(data.field));
                return false;
              });
            });
              function save_content() {
                var index = parent.layer.getFrameIndex(window.name); //得到当前iframe层的索引
                $.ajaxSetup({
                      headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
                    });
                $.ajax({
                    url:'/admin/power/{{$power->id}}',
                    type:'post',
                    data: $("form").serialize(),
                    dataType: 'json',
                    success:function (data) {
                        if (data.code == 1) {
                            layer.msg(data.msg, {
                                icon:1,
                                time:2000
                            }, function () {
                                window.parent.location.reload(index, function () {
                                    location.href = '/admin/power';
                                });                                    
                            });
                        } else {
                            layer.alert(data.msg);
                        }
                    }
                });
              }
    </script>
</html>