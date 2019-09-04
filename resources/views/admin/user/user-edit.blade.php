@include('public.top')

<body>

<div class="x-body ">
  <form  class="layui-form">
    <div class="layui-form-item">
      <label for="cost_name" class="layui-form-label">学号</label>
      <span style="color: red">*</span>
      <div class="layui-input-inline">
        <input type="text" id="cost_name" name="school_number"  disabled value="{{$user['school_number']}}" lay-verify="required" autocomplete="off" class="layui-input" >
        <p id="pLog" style="color:red"></p>
      </div>
    </div>
    <div class="layui-form-item">
      <label for="cost_name" class="layui-form-label">姓名</label>
      <span style="color: red">*</span>
      <div class="layui-input-inline">
        <input type="text" id="cost_name" name="user_name" value="{{$user['user_name']}}" lay-verify="required" autocomplete="off" class="layui-input" >
        <input type="hidden" id="id" name="id" value="{{$user['id']}}" lay-verify="required" autocomplete="off" class="layui-input" >
        <p id="pLog" style="color:red"></p>
      </div>
    </div>
    <div class="layui-form-item">
      <label for="cost_name" class="layui-form-label">班级</label>
      <span style="color: red">*</span>
      <div class="layui-input-inline">
        <input type="text" id="cost_name" name="class" value="{{$user['class']}}" lay-verify="required" autocomplete="off" class="layui-input" >
      </div>
    </div>
    <div class="layui-form-item">
      <label for="cost_name" class="layui-form-label">系部</label>
      <span style="color: red">*</span>
      <div class="layui-input-inline">
        <input type="text" id="cost_name" name="department"  value="{{$user['department']}}" lay-verify="required" autocomplete="off" class="layui-input" >
      </div>
    </div>
    <div class="layui-form-item">
      <label for="cost_name" class="layui-form-label">邮箱</label>
      <span style="color: red">*</span>
      <div class="layui-input-inline">
        <input type="text" id="cost_name" name="emal" value="{{$user['emal']}}" lay-verify="required" autocomplete="off" class="layui-input" >
      </div>
    </div>
    {{--<div class="layui-form-item">--}}
      {{--<label for="cost_name" class="layui-form-label">密码</label>--}}
      {{--<span style="color: red">*</span>--}}
      {{--<div class="layui-input-inline">--}}
        {{--<input type="password" id="cost_name" name="password"  value="{{$user['password']}}"lay-verify="required" autocomplete="off" class="layui-input" >--}}
      {{--</div>--}}
    {{--</div>--}}

    <div class="layui-form-item">
      <label class="layui-form-label"></label>
      <button class="layui-btn" lay-submit lay-filter="addId">
        修改
      </button>
    </div>
  </form>
</div>
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    layui.use(['form'], function(){
        $ = layui.jquery;
        var form = layui.form,layer = layui.layer;

        //监听提交
        form.on('submit(addId)', function(data){
            //console.log(data);
            $.post("{{url('admin/user/edit')}}",data.field,function(info){
                if (info.error===1) {
                    layer.alert("修改成功", {icon: 6},function () {
                        window.parent.location.reload();  //刷新父级页面
                        // 获得frame索引
                        var index = parent.layer.getFrameIndex(window.name);
                        //关闭当前弹出层
                        parent.layer.close(index);
                    });
                }else{
                    layer.alert("修改失败", {icon: 5});
                }
            },'json');
            return false;
        });
    });
</script>
</body>

</html>