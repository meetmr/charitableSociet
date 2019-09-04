@include('public.top')

<body>

<div class="x-body ">
    <form  class="layui-form">
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">描述</label>
            <input type="hidden" name="w_id" value="{{$word['id']}}">
            <div class="layui-input-block">
                <textarea name="centent" placeholder="请输入内容" class="layui-textarea" lay-verify="required"></textarea>
            </div>
        </div>
            <div class="layui-form-item">
                <label class="layui-form-label"></label>
                <button class="layui-btn" lay-submit lay-filter="addId">
                    提交回复
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
            $.post("{{url('admin/replys/huifu')}}",data.field,function(info){
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