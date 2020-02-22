<!DOCTYPE html>
<html class="x-admin-sm">
    <head>
        <meta charset="UTF-8">
        <title>欢迎页面-X-admin2.2</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <link rel="stylesheet" href="/admin/css/font.css">
        <link rel="stylesheet" href="/admin/css/xadmin.css">
<<<<<<< HEAD
        <link rel="stylesheet" href="/admin/font/iconfont.css">
=======
>>>>>>> origin/liang
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
            <a href="/admin/welcome">首页</a>
            <a>
              <cite>视频上传</cite></a>
          </span>
          <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
            <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
        </div>
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body ">
<<<<<<< HEAD
                            <form class="layui-form layui-col-space5" method="get" action="/admin/video">
                                <div class="layui-inline layui-show-xs-block">
                                    <input class="layui-input"  autocomplete="off" placeholder="开始日" name="start" id="start">
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <input class="layui-input"  autocomplete="off" placeholder="截止日" name="end" id="end">
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <input type="text" name="username"  placeholder="请输入用户名" autocomplete="off" class="layui-input">
=======
                            <form class="layui-form layui-col-space5">
                                <div class="layui-inline layui-show-xs-block">
                                    <input type="text" name="username"  placeholder="请输入视频标题" autocomplete="off" class="layui-input">
>>>>>>> origin/liang
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                                </div>
                            </form>
                        </div>
                        <div class="layui-card-header">
<<<<<<< HEAD
                            <button class="layui-btn" onclick="xadmin.open('上传视频','/admin/video/create',1000,800)"><i class="layui-icon"></i>添加</button>
                             <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>             
=======
                            <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
                            <button class="layui-btn" onclick="xadmin.open('添加用户','./admin-add.html',600,400)"><i class="layui-icon"></i>添加</button>
>>>>>>> origin/liang
                        </div>
                        <div class="layui-card-body ">
                            <table class="layui-table layui-form">
                              <thead>
                                <tr>
<<<<<<< HEAD
                                  <th style="width: 1%;text-align: center;">
                                    <input type="checkbox" name=""  lay-skin="primary">
                                  </th>
                                  <th style="width: 15%;text-align: center;">视频标题</th>
                                  <th style="width: 10%;text-align: center;">视频截图</th>
                                  <th style="width: 12%;text-align: center;">视频简介</th>
                                  <th style="width: 8%;text-align: center;">发布人</th>
                                  <th style="width: 10%;text-align: center;">发布时间</th>
                                  <th style="width: 6%;text-align: center;">状态</th>
                                  <th style="width: 7%;text-align: center;">操作</th>
                              </thead>
                              <tbody>
                                @foreach($data as $k=>$v)
                                <tr style="text-align: center;">
                                  <td style="width: 1%;text-align: center;">
                                    <input type="checkbox" name=""  lay-skin="primary">
                                  </td>
                                  <td>{{$v->title}}</td>
                                  <td>
                                      <ul>
                                          <li><img src="/{{$v->url}}"></li>
                                      </ul>
                                  </td>
                                  <td>{{$v->text}}</td>
                                  <td>{{$v->nickname}}</td>
                                  <td>{{date('Y-m-d', $v->create_time)}}</td>
                                  <td class="td-status">
                                    @if($v->status == 0)
                                    未审核
                                    @elseif ($v->status == 1)
                                    审核拒绝
                                    @elseif ($v->status == 2)
                                    审核通过
                                    @endif
                                  </td>
                                  <td class="td-manage">
                                    <a onclick="member_stop(this,'10001')" href="javascript:;"  title="审核">
                                      <span class="iconfont icon-xxx">&#xe600;</span>
=======
                                  <th>
                                    <input type="checkbox" name=""  lay-skin="primary">
                                  </th>
                                  <th>ID</th>
                                  <th>登录名</th>
                                  <th>手机</th>
                                  <th>邮箱</th>
                                  <th>角色</th>
                                  <th>加入时间</th>
                                  <th>状态</th>
                                  <th>操作</th>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>
                                    <input type="checkbox" name=""  lay-skin="primary">
                                  </td>
                                  <td>1</td>
                                  <td>admin</td>
                                  <td>18925139194</td>
                                  <td>113664000@qq.com</td>
                                  <td>超级管理员</td>
                                  <td>2017-01-01 11:11:42</td>
                                  <td class="td-status">
                                    <span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span></td>
                                  <td class="td-manage">
                                    <a onclick="member_stop(this,'10001')" href="javascript:;"  title="启用">
                                      <i class="layui-icon">&#xe601;</i>
>>>>>>> origin/liang
                                    </a>
                                    <a title="编辑"  onclick="xadmin.open('编辑','admin-edit.html')" href="javascript:;">
                                      <i class="layui-icon">&#xe642;</i>
                                    </a>
                                    <a title="删除" onclick="member_del(this,'要删除的id')" href="javascript:;">
                                      <i class="layui-icon">&#xe640;</i>
                                    </a>
                                  </td>
                                </tr>
<<<<<<< HEAD
                                @endforeach
                              </tbody>
                            </table>
                        </div>
=======
                              </tbody>
                            </table>
                        </div>
                        <!-- 单走一个六！傻逼！！！！！ -->
>>>>>>> origin/liang
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
        
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });
      });

       /*用户-停用*/
      function member_stop(obj,id){
          layer.confirm('确认要停用吗？',function(index){

              if($(obj).attr('title')=='启用'){

                //发异步把用户状态进行更改
                $(obj).attr('title','停用')
                $(obj).find('i').html('&#xe62f;');

                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                layer.msg('已停用!',{icon: 5,time:1000});

              }else{
                $(obj).attr('title','启用')
                $(obj).find('i').html('&#xe601;');

                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                layer.msg('已启用!',{icon: 5,time:1000});
              }
              
          });
      }

      /*用户-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              $(obj).parents("tr").remove();
              layer.msg('已删除!',{icon:1,time:1000});
          });
      }



      function delAll (argument) {

        var data = tableCheck.getData();
  
        layer.confirm('确认要删除吗？'+data,function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
      }
    </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
</html>