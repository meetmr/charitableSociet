@include('public.top')

<body>

<div class="x-body ">
  <form  class="layui-form">
    <div class="layui-form-item">
      <label for="activity_name" class="layui-form-label">活动名称</label>
      <div class="layui-input-inline">
        <input type="text" id="activity_name" name="activity_name"    lay-verify="required" autocomplete="off" class="layui-input" >
      </div>
    </div>
    <div class="layui-form-item">
      <label for="factory_date" class="layui-form-label">活动时间</label>
      <div class="layui-inline"> <!-- 注意：这一层元素并不是必须的 -->
        <input type="text" name="start_time"  lay-verify="required" class="layui-input" id="data">
      </div>
      <script>
          layui.use('laydate', function(){
              var laydate = layui.laydate;

              //日期时间选择器
              laydate.render({
                  elem: '#data'
                  ,type: 'datetime'
              });
          });
      </script>
    </div>
    <div class="layui-form-item">
      <label for="number" class="layui-form-label">参与人数</label>
      <div class="layui-input-inline">
        <input type="number" id="number" name="number" lay-verify="required" autocomplete="off" class="layui-input" >
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label">活动类型</label>
      <div class="layui-input-block"  style="width: 190px;" >
        <select name="activity_type"  lay-verify="required">
          <option value="校内">校内</option>
          <option value="校外">校外</option>
          <option value="联谊">联谊</option>
        </select>
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">参与者</label>
      <div class="layui-input-block"  style="width: 190px;" >
        <select name="participant"  lay-verify="required">
          <option value="社内成员">社内成员</option>
          <option value="学院在校生">学院在校生</option>
        </select>
      </div>
    </div>
    <div class="layui-form-item">
      <label for="place" class="layui-form-label">活动地点</label>
      <div class="layui-input-inline">
        <input type="text" id="place" name="place" lay-verify="required" autocomplete="off" class="layui-input" >
      </div>
    </div>
    <div class="layui-form-item layui-form-text">
      <label class="layui-form-label">活动内容</label>
      <div class="layui-input-block">
        <textarea name="activity_content" placeholder="请输入内容"    lay-verify="required" class="layui-textarea"></textarea>
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label"></label>
      <button class="layui-btn" lay-submit lay-filter="addId">
        添加
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
            $.post("{{url('admin/activity/add')}}",data.field,function(info){
                if (info.error===1) {
                    layer.alert("修改成功", {icon: 6},function () {
                        window.parent.location.reload();  //刷新父级页面
                        // 获得frame索引
                        var index = parent.layer.getFrameIndex(window.name);
                        //关闭当前弹出层
                        parent.layer.close(index);
                    });
                }else{
                    layer.alert("添加失败", {icon: 5});
                }
            },'json');
            return false;
        });
    });
</script>
</body>

</html>