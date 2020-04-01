<!DOCTYPE html>
<html class="x-admin-sm">
    <head>
        <meta charset="UTF-8">
        <title>丹漆随梦</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <link rel="stylesheet" href="/admin/css/font.css">
        <link rel="stylesheet" href="/admin/css/xadmin.css">
        <script src="/admin/lib/layui/layui.js" charset="utf-8"></script>
        <script type="text/javascript" src="/admin/js/xadmin.js"></script>
        <style type="text/css">
            .layui-carousel{width: 620px; height: 320px!important}
            .layui-field-title {margin: 5px 0 10px!important}
        </style>
        <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
        <!--[if lt IE 9]>
          <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
          <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body " style="font-size: 15px;font-weight:bold;">
                            <blockquote class="layui-elem-quote">您好:{{session('user_name')}}！
                                当前时间:<span id="nowTime"></span> <span id="nowDay"></span>
                            </blockquote>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-header">数据统计</div>
                        <div class="layui-card-body ">
                            <ul class="layui-row layui-col-space10 layui-this x-admin-carousel x-admin-backlog">
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>头像</h3>
                                        <p>
                                            <cite>66</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>待审核文章</h3>
                                        <p>
                                            <cite>12</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>所有评论</h3>
                                        <p>
                                            <cite>99</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>待审核图片</h3>
                                        <p>
                                            <cite>67</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>待审核视频</h3>
                                        <p>
                                            <cite>67</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6 ">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>管理员人数</h3>
                                        <p>
                                            <cite>6766</cite></p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="layui-col-sm6 layui-col-md3">
                    <div class="layui-card">
                        <div class="layui-card-header">下载
                            <span class="layui-badge layui-bg-cyan layuiadmin-badge">月</span></div>
                        <div class="layui-card-body  ">
                            <p class="layuiadmin-big-font">33,555</p>
                            <p>新下载
                                <span class="layuiadmin-span-color">10%
                                    <i class="layui-inline layui-icon layui-icon-face-smile-b"></i></span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="layui-col-sm6 layui-col-md3">
                    <div class="layui-card">
                        <div class="layui-card-header">下载
                            <span class="layui-badge layui-bg-cyan layuiadmin-badge">月</span></div>
                        <div class="layui-card-body ">
                            <p class="layuiadmin-big-font">33,555</p>
                            <p>新下载
                                <span class="layuiadmin-span-color">10%
                                    <i class="layui-inline layui-icon layui-icon-face-smile-b"></i></span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="layui-col-sm6 layui-col-md3">
                    <div class="layui-card">
                        <div class="layui-card-header">下载
                            <span class="layui-badge layui-bg-cyan layuiadmin-badge">月</span></div>
                        <div class="layui-card-body ">
                            <p class="layuiadmin-big-font">33,555</p>
                            <p>新下载
                                <span class="layuiadmin-span-color">10%
                                    <i class="layui-inline layui-icon layui-icon-face-smile-b"></i></span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="layui-col-sm6 layui-col-md3">
                    <div class="layui-card">
                        <div class="layui-card-header">下载
                            <span class="layui-badge layui-bg-cyan layuiadmin-badge">月</span></div>
                        <div class="layui-card-body ">
                            <p class="layuiadmin-big-font">33,555</p>
                            <p>新下载
                                <span class="layuiadmin-span-color">10%
                                    <i class="layui-inline layui-icon layui-icon-face-smile-b"></i></span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md12" style="margin-top: -5px;">
                    <fieldset class="layui-elem-field layui-field-title" >
                      <legend>常规轮播</legend>
                    </fieldset>  
                    <div class="layui-card" style="height: 320px;">
                        <div class="layui-carousel" id="test1" lay-filter="test1">
                          <div carousel-item="">
                            <div>            
                                <a href="javascript:;">
                                  <img style="width: 100%;height: 100%;" src="/upload/file2020-02\1581834690.jpg">
                                </a>
                            </div>
                            <div>            
                                <a href="javascript:;">
                                  <img style="width: 100%;height: 100%;" src="/upload/file2020-02\1581834690.jpg">
                                </a>
                            </div>
                            <div>            
                                <a href="javascript:;">
                                  <img style="width: 100%;height: 100%;" src="/upload/file2020-02\1581834690.jpg">
                                </a>
                            </div>
                            <div>            
                                <a href="javascript:;">
                                  <img style="width: 100%;height: 100%;" src="/upload/file2020-02\1581834690.jpg">
                                </a>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                <style id="welcome_style"></style>
                <div class="layui-col-md12">
                    <blockquote class="layui-elem-quote layui-quote-nm">感谢layui,百度Echarts,jquery,本系统由x-admin提供技术支持。</blockquote></div>
            </div>
        </div>
        </div>
        <script>
            function showTime(){
                nowtime=new Date();
                year=nowtime.getFullYear();
                month=nowtime.getMonth()+1;
                date=nowtime.getDate();
                document.getElementById("nowTime").innerText=year+"年"+month+"月"+date+"日   "+nowtime.toLocaleTimeString();
                var str = "星期" + "日一二三四五六".charAt(new Date().getDay());
                document.getElementById("nowDay").innerText= str;
            }
            setInterval("showTime()",1000);
            layui.use(['carousel', 'form'], function(){
              var carousel = layui.carousel
              ,form = layui.form;
              
              //常规轮播
              carousel.render({
                elem: '#test1'
                ,arrow: 'always'
              });
            });
       </script>
    </body>
</html>