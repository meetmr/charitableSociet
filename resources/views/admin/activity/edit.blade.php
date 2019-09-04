@include('public.top')

@include('UEditor::head')
<body>

<div class="x-body ">
  <form  class="layui-form">
    <div class="layui-form-item">
      <label for="activity_name" class="layui-form-label">活动名称</label>
      <div class="layui-input-inline">
        <input type="text" id="activity_name" name="activity_name"  value="{{$activityRow['activity_name']}}"  lay-verify="required" autocomplete="off" class="layui-input" >
        <input type="hidden" id="id" name="id"  value="{{$activityRow['id']}}"  lay-verify="required" autocomplete="off" class="layui-input" >
      </div>
    </div>
    <div class="layui-form-item">
      <label for="factory_date" class="layui-form-label">活动时间</label>
      <div class="layui-inline"> <!-- 注意：这一层元素并不是必须的 -->
        <input type="text" name="start_time"   value="{{$activityRow['start_time']}}"  lay-verify="required" class="layui-input" id="data">
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
        <input type="number" id="number" name="number"  value="{{$activityRow['number']}}" lay-verify="required" autocomplete="off" class="layui-input" >
      </div>
    </div>

    <div class="layui-form-item">
      <label class="layui-form-label">活动类型</label>
      <div class="layui-input-block"  style="width: 190px;" >
        <select name="activity_type"  lay-verify="required">
          <option value="校内" @if($activityRow['activity_type'] =='校内') selected @endif>校内</option>
          <option value="校外"  @if($activityRow['activity_type'] =='校外') selected @endif >校外</option>
          <option value="联谊"  @if($activityRow['activity_type'] =='联谊') selected @endif >联谊</option>
        </select>
      </div>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">参与者</label>
      <div class="layui-input-block"  style="width: 190px;" >
        <select name="participant"  lay-verify="required">
          <option value="社内成员" @if($activityRow['participant'] =='社内成员') selected @endif>社内成员</option>
          <option value="学院在校生"  @if($activityRow['participant'] =='学院在校生') selected @endif>学院在校生</option>
        </select>
      </div>
    </div>
    <div class="layui-form-item">
      <label for="place" class="layui-form-label">活动地点</label>
      <div class="layui-input-inline">
        <input type="text" id="place" name="place"   value="{{$activityRow['place']}}"  lay-verify="required" autocomplete="off" class="layui-input" >
      </div>
    </div>
    <div class="layui-form-item layui-form-text">
      <label class="layui-form-label">活动内容</label>
      <div class="layui-input-block">
        <textarea name="activity_content" placeholder="请输入内容"  lay-verify="required" class="layui-textarea">{{$activityRow['activity_content']}}</textarea>
      </div>
    </div>
    <div class="layui-form-item layui-form-text">
      <label class="layui-form-label">活动总结</label>
      <div class="layui-input-block">
        <textarea name="summary" id="content">{{$activityRow['summary']}}</textarea>
      </div>
    </div>
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
            $.post("{{url('admin/activity/edit')}}",data.field,function(info){
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
<script type="text/javascript">

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    UE.getEditor('content',{initialFrameWidth:800,initialFrameHeight:400,zIndex:0});

    ue.ready(function() {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
    });

</script>
<!-- 实例化编辑器 -->
{{--<script type="text/javascript">--}}
    {{--var ue = UE.getEditor('container');--}}

    {{--initialFrameWidth:900,--}}
        {{--initialFrameHeight : 350,//文本框宽和高--}}
        {{----}}
{{--</script>--}}


</body>

</html>