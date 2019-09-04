@include('public.top')

<body>
<div class="x-body" >
    <xblock>
        <!--<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>-->
        <button class="layui-btn" onclick="x_admin_show('添加订单','{:url(\'index/Order/addOrder\')}',600,600)"><i class="layui-icon"></i>添加</button>
        <a href="/admin/activity/export/{{$id}}" class="layui-btn" style="background: #FF5722" ><i style="color:red" class="iconfont nav_right"></i>  导出活动名单</a>

        <span class="x-right" style="line-height:40px">共{{$count}}名同学报名</span>
    </xblock>

    <div class="container-wrap">
        <div class="box-1">
            <table class="layui-table">
                <thead>
                <tr>
                    <th style="text-align: center" width="80">姓名</th>
                    <th style="text-align: center" width="100">学号</th>
                    <th style="text-align: center" width="100">系部</th>
                    <th style="text-align: center" width="100">班级</th>
                    <th style="text-align: center" width="20">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($participateInfo as $value)
                <tr style="text-align: center">
                    <td>{{$value->name}}</td>
                    <td>{{$value->school_number}}</td>
                    <td>{{$value->department}}</td>
                    <td>{{$value->class}}</td>
                    <td class="td-manage" width="10" style="text-align: center">
                        <div class="layui-input-inline" >
                            <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del" onclick="delete_user(this,'{{$value->id}}')" ><i class="layui-icon layui-icon-delete"></i>删除</a>
                        </div>
                    </td>
                </tr>
                @endforeach
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
        /*删除*/
        function delete_user(obj,id){
            layer.confirm('确认要删除吗？',function(index){
                $.ajax({
                    url:"{{url('admin/activity/deleteA')}}",
                    type:"POST",
                    dataType:"json",
                    data:{id:id, }, //id},
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
        function export1(id) {
            layer.confirm('导出活动名单？',function(index){
                $.ajax({
                    url:"{{url('admin/activity/export')}}",
                    type:"POST",
                    dataType:"json",
                    data:{id:id, }, //id},
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
    </script>
</div>
</body>
</html>