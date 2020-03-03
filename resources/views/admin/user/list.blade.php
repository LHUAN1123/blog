<!DOCTYPE html>
<html class="x-admin-sm">
    <head>
        <meta charset="UTF-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <link rel="stylesheet" href="/admin/css/font.css">
        <link rel="stylesheet" href="/admin/css/xadmin.css">
        <script src="/admin/lib/layui/layui.js" charset="utf-8"></script>
        <script type="text/javascript" src="/admin/js/xadmin.js"></script>
        <!--[if lt IE 9]>
          <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
          <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="x-nav">
          <span class="layui-breadcrumb">
            <a href="">首页</a>
            <a>
              <cite>导航元素</cite></a>
          </span>
          <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
            <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
        </div>
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body ">
                            <form class="layui-form layui-col-space5">
                                <div class="layui-inline layui-show-xs-block">
                                    <input type="text" name="username"  placeholder="请输入用户名" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                                </div>
                            </form>
                        </div>
                        <div class="layui-card-header">
                            <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
                            <button class="layui-btn" onclick="xadmin.open('添加用户','/admin/user/create',800,400)"><i class="layui-icon"></i>添加</button>
                        </div>
                        <div class="layui-card-body ">
                            <table class="layui-table layui-form" id="table">
                              <thead>
                                <tr>
                                  <th style="width: 1%;text-align: center;">
                                    <input type="checkbox" name=""  lay-skin="primary">
                                  </th>
                                  <th style="width: 10%;text-align: center;">名称</th>
                                  <th style="width: 20%;text-align: center;">昵称</th>
                                  <th style="width: 12%;text-align: center;">状态</th>
                                  <th style="width: 12%;text-align: center;">邮箱</th>
                                  <th style="width: 10%;text-align: center;">加入时间</th>                                  
                                  <th style="width: 10%;text-align: center;">操作</th>
                              </thead>
                              <tbody>
                              	@foreach($data as $v)
                                <tr>
                                  <td style="width: 1%;text-align: center;">
                                    <input type="checkbox" name=""  lay-skin="primary">
                                  </td>
                                  <td style="text-align: center;">{{$v->username}}</td>
                                  <td style="text-align: center;">{{$v->nickname}}</td>
                                  <td style="text-align: center;">
								  @if($v->status == 1)
									可用
								  @else
									禁用
								  @endif
                                  </td>
                                  <td style="text-align: center;">{{$v->email}}</td>
                                  <td style="text-align: center;">{{date('Y-m-d', $v->create_time)}}</td>
                                  <td style="text-align: center;">
                                    <a title="编辑"  onclick="xadmin.open('编辑','/admin/user/{{$v->id}}/edit',800,400)" href="javascript:;">
                                      <i class="layui-icon" style="font-size: 20px;">&#xe642;</i>
                                    </a>
                                    <a title="删除" onclick="member_del(this,'{{$v->id}}')" href="javascript:;">
                                      <i class="layui-icon" style="font-size: 22px;">&#xe640;</i>
                                    </a>
                                  </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                        </div>
                        <div class="layui-card-body ">
                            <div class="page">
                                <div>
                                  <a class="prev" href="">&lt;&lt;</a>
                                  <a class="num" href="">1</a>
                                  <span class="current">2</span>
                                  <a class="num" href="">3</a>
                                  <a class="num" href="">489</a>
                                  <a class="next" href="">&gt;&gt;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </body>
    <script>
      layui.use(['laydate','form'], function(){
        var laydate = layui.laydate;
        var form = layui.form;
        
      });

	      /*删除*/
	    function member_del(obj,id){
	        layer.confirm('确认要删除吗？',function(index){
	            //发异步删除数据
	            var url = '/admin/user/' + id;

	            $.ajaxSetup({
	                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
	            });
	            $.ajax({
	                type: "DELETE",
	                url: url,
	                success: function (result) {

	                    if (result.code == 1) {
	                        $(obj).parents("tr").remove();
	                        layer.msg(result.msg,{icon:1,time:1000});
	                    } else {
	                        layer.alert(result.msg);
	                    }
	                }
	            })
	        });
	    }
    </script>
</html>