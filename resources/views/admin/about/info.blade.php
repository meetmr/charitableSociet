@include('public.top')

<body>
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">相册管理</a>
        <a>
          <cite>相册列表</cite>
        </a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<xblock>
    <!--<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>-->
    <button  class="layui-btn" onclick="x_admin_show('添加相册','{{url('admin/about/add')}}')"><i class="layui-icon"></i>添加</button>

</xblock>

<div class="x-body" >

    <div class="container-wrap">
        <div class="box-1">
            <table class="layui-table">
                <thead>
                <tr>
                    <th style="text-align: center" width="80">标题</th>
                    <th style="text-align: center" width="100">时间</th>
                    <th style="text-align: center" width="100">封面</th>
                    <th style="text-align: center" width="100">内容</th>
                    <th style="text-align: center" width="20">操作</th>
                </tr>
                </thead>
                <tbody>
                        <tr  style="text-align: center">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                        <td class="td-manage" width="10">
                            <div class="layui-input-inline" >
                                <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"  onclick="x_admin_show('修改','/admin/activity/edit/',1000,500)"><i class="layui-icon layui-icon-edit"></i>编辑</a>
                                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del" onclick="delete_user(this,'')" ><i class="layui-icon layui-icon-delete"></i>删除</a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="page">

    </div>
    <script>
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        layui.use('laydate', function(){
            var laydate = layui.laydate;
            //执行一个laydate实例
            laydate.render({
                elem: '#start' //指定元素
            });

            //执行一个laydate实例
            laydate.render({
                elem: '#end' //指定元素
            });
        });
        //更改状态
        /*删除*/
        function delete_user(obj,id){
            layer.confirm('确认要删除吗？',function(index){
                $.ajax({
                    url:"{{url('/admin/activity/delete')}}",
                    type:"POST",
                    dataType:"json",
                    data:{id:id,}, //id},
                    success:function (res) {
                        if (res.error === 1){
                            $(obj).parents("tr").remove();
                            layer.msg('已删除!',{icon:1,time:1000});
                        }else {
                            layer.alert("删除失败", {icon: 5});
                        }
                    }
                });
            });
        }
        function over1(s,id) {
            layer.confirm('是否设置结束？',function(index){
                $.ajax({
                    url:"{{url('/admin/activity/over')}}",
                    type:"POST",
                    dataType:"json",
                    data:{s:s,id:id,}, //id},
                    success:function (res) {
                        if (res.error === 1){
                            layer.msg('设置成功!',{icon:1,time:1000});

                            window.location.reload();
                        }else {
                            layer.alert("设置失败", {icon: 5});
                        }
                    }
                });
            });
        }
    </script>
</body>
</html>