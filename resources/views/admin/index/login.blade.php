@include('public.top')

<body class="login-bg">

    <div class="login layui-anim layui-anim-up">
        <div class="message">爱心社-后台管理登录</div>
        <div id="darkbannerwrap"></div>

        <form method="post" class="layui-form" >
            <input name="username" id="school_number" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            <input name="password" id="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
            <hr class="hr20" >
        </form>
    </div>

    <script>
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $(function  () {
            layui.use('form', function(){
              var form = layui.form;

              form.on('submit(login)', function(data){
                  var school_number = $("#school_number").val();
                  var password = $("#password").val();
                  var data ={"school_number":school_number,"password":password};
                  var url = "{{url('admin/login')}}";
                  $.post(url,data,function (result) {
                      if(result.error === 0){
                          layer.msg(result.msg);
                      }else if(result.error ===1){
                          location.href="{{url('admin/index')}}"
                      }
                  },"json");
                return false;
              });
            });
        })
    </script>

</body>
</html>