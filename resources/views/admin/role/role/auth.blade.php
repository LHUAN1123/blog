<!DOCTYPE html>
<html class="x-admin-sm">
  
  <head>
    <meta charset="UTF-8">
    <title>权限添加</title>
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
            <form action="" method="post" id="create" class="layui-form layui-form-pane">
                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>角色名
                    </label>
                    <div class="layui-input-inline">
                        <input type="hidden" name="role_id" value="{{$role->id}}">
                        <input type="text" id="name" name="name" value="{{$role->name}}" required="" lay-verify="required"
                        autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">
                        权限列表
                    </label>
                    <table  class="layui-table layui-input-block">
                        <tbody>
                            @foreach($data as $val)
                            <tr>
                                <td>
                                    <input type="checkbox" name="like1[write]" lay-skin="primary" lay-filter="father" title="{{$val->type}}">
                                </td>
                                <td>
                                    <div class="layui-input-block">
                                        @foreach($power as $v)
                                            @if($val->id == $v->category)
                                                @if(in_array($v->id,$own_powers))
                                                     <input name="power_id[]"  checked lay-skin="primary"  value="{{$v->id}}" type="checkbox" title="{{$v->title}}">
                                                @else
                                                    <input name="power_id[]"  lay-skin="primary"  value="{{$v->id}}" type="checkbox" title="{{$v->title}}"> 
                                                @endif                                                     
                                            @endif
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="layui-form-item">
                    <a class="layui-btn" id="btn" onclick="save_content()">添加</a>
              </div>
            </form>
        </div>
    </div>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;

        form.on('checkbox(father)', function(data){

            if(data.elem.checked){
                $(data.elem).parent().siblings('td').find('input').prop("checked", true);
                form.render(); 
            }else{
               $(data.elem).parent().siblings('td').find('input').prop("checked", false);
                form.render();  
            }
        });
          
          
        });

        function save_content() {
            var formData = new FormData(document.getElementById("create"));
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : ' {{ csrf_token() }} ' }
            });
            $.ajax({
                type: "post",
                data: formData,
                url: "{{url('/role/doauth')}}",
                cache:false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.code == 1) {
                        layer.msg(data.msg, {
                            time:2000,
                            icon:6

                        }, function () {
                            location.href = '/admin/role';
                        });
                    } else {
                        layer.alert(data.msg);
                    }
                }
            });
        }
    </script>

  </body>

</html>