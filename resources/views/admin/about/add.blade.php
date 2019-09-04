@include('public.top')
@include('UEditor::head')

<body>

<div class="x-body ">
  <form  class="layui-form">
    <div class="layui-form-item">
      <label for="activity_name" class="layui-form-label">相册名称</label>
      <div class="layui-input-inline">
        <input type="text" id="activity_name" name="title"    lay-verify="required" autocomplete="off" class="layui-input" >
      </div>
    </div>
    <div class="layui-form-item">
      <label for="factory_date" class="layui-form-label">开始时间</label>
      <div class="layui-inline"> <!-- 注意：这一层元素并不是必须的 -->
        <input type="text" name="start_time"  lay-verify="required" class="layui-input" id="data">
      </div>
      <script>
          layui.use('laydate', function(){
              var laydate = layui.laydate;
              //日期时间选择器
              laydate.render({
                  elem: '#data'
                  ,type: 'date'
              });
          });
      </script>
    </div>
    <div class="layui-form-item">
      <label for="factory_date" class="layui-form-label">结束时间</label>
      <div class="layui-inline"> <!-- 注意：这一层元素并不是必须的 -->
        <input type="text" name="end_time"  lay-verify="required" class="layui-input" id="datae">
      </div>
      <script>
          layui.use('laydate', function(){
              var laydate = layui.laydate;
              //日期时间选择器
              laydate.render({
                  elem: '#datae'
                  ,type: 'date'
              });
          });
      </script>
    </div>
    <div class="layui-form-item">
      <label class="layui-form-label">文章封面</label>
      <div class="layui-input-block">
        <button type="button" class="layui-btn" id="upload1">上传图片</button>
        <input type="hidden" id="img_url" name="icon" value=""/>
        <div class="layui-upload-list">
          <img class="layui-upload-img" width="100px" height="80px" id="demo1"/>
          <p id="demoText"></p>
        </div>
      </div>
    </div>
    <div class="layui-form-item layui-form-text">
      <label class="layui-form-label">内容</label>
      <div class="layui-input-block">
        <textarea name="coantent" id="content"></textarea>
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
<script type="text/javascript">

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    UE.getEditor('content',{initialFrameWidth:800,initialFrameHeight:400,zIndex:0});

    ue.ready(function() {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
    });

</script>

<script type="text/javascript">
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    layui.use('upload', function(){
        var upload = layui.upload
            , $ = layui.jquery;
        var uploadInst = upload.render({
            elem: '#upload1' //绑定元素
            ,url: "{{url('admin/about/up') }}"
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    $('#demo1').attr('src', result); //图片链接（base64）
                });
            }
            ,done: function(res){
                //如果上传失败
                if(res.code === 0){
                    return layer.msg('上传失败');
                }
                //上传成功
                document.getElementById("img_url").value = res.url;

            }
            ,error: function(){
                //演示失败状态，并实现重传
                var demoText = $('#demoText');
                demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                demoText.find('.demo-reload').on('click', function(){
                    uploadInst.upload();
                });
            }
        });
    });
</script>
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    layui.use(['form'], function(){
        $ = layui.jquery;
        var form = layui.form,layer = layui.layer;

        //监听提交
        form.on('submit(addId)', function(data){
            //console.log(data);
            $.post("{{url('admin/about/add')}}",data.field,function(info){
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