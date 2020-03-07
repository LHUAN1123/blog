


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>商品列表</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="stylesheet" href="/admin/css/font.css">
  <link rel="stylesheet" href="/admin/css/xadmin.css">
  <script src="/admin/lib/layui/layui.js" charset="utf-8"></script>
  <script type="text/javascript" src="/admin/js/xadmin.js"></script>
</head>
<body>
<form action="" method="post">
<div class="layui-fluid layadmin-cmdlist-fluid">
  <div class="layui-row layui-col-space30">
    <div class="layui-col-md2 layui-col-sm4">
        <div class="cmdlist-container">
	        <span class="flow">
              <i class="layui-icon layui-icon-rate"></i>
              {{$str}}
            </span><br/>
            <a href="javascript:;">
              <img style="width: 100%;height: 100%;" src="/upload/file2020-02\1581834690.jpg">
            </a>
            <a href="javascript:;">
              <div class="cmdlist-text">
                <p class="info">2018春夏季新款港味短款白色T恤+网纱中长款chic半身裙套装两件套</p>
                <div class="price">
                    <b>￥79</b>
                    <p>
                      ¥
                      <del>130</del>
                    </p>
                </div>
              </div>
            </a>
        </div>
    </div>
  </div>
</div>
<div class="layui-form-item" style="margin-left: -50px;">
  <label for="L_repass" class="layui-form-label">
  </label>
  <a class="layui-btn" id="btn" onclick="save_content()">秒杀</a>
</div>
</form>
  <script>
      function save_content() {
          var index = parent.layer.getFrameIndex(window.name); //得到当前iframe层的索引
          $.ajaxSetup({
              headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
          });
          $.ajax({
              type: "POST",
              url: "/admin/start",
              data:$('form').serialize(),
              success: function (result) {
                  if (result.code == 4) {
                      layer.alert('秒杀成功', function () {
                          window.parent.location.reload(index, function () {
                              location.href = '/admin/role';
                          });
                      });
                  } else {
                      layer.alert(result.msg);
                  }
              }
          })
      }
  </script>  
</body>
</html>