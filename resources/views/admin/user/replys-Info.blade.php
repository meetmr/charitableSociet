@include('public.top')

<body>
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">成员管理</a>
        <a>
          <cite>成员列表</cite>
        </a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<xblock>
    <!--<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>-->
    <button disabled class="layui-btn" onclick="x_admin_show('')"><i class="layui-icon"></i>添加</button>
    <div class="layui-input-inline">
        <form class="layui-form" action="{{ url('admin/user/info') }}" method="post" onsubmit="return foo();">
            {{ csrf_field() }}
            <div class="layui-input-inline">
                <input type="text" name="key" id="key" autocomplete="off" placeholder="请输入学号或者姓名..." class="layui-input">
            </div>
            <button type="submit" class="layui-btn" lay-submit="" lay-filter="sreach"><i class="layui-icon"></i></button>
        </form>
    </div>
    <span  style="text-align: center;margin-left: 3em" ></span>

</xblock>


<div class="x-body" >

    <div class="container-wrap">
        <div class="box-1">
            <table class="layui-table">
                <thead>
                <tr>
                    <th style="text-align: center" width="80">内容</th>
                    <th style="text-align: center" width="100">时间</th>
                    <th style="text-align: center" width="100">姓名</th>
                    <th style="text-align: center" width="50">操作</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($words  as $value)
                        <tr  style="text-align: center">
                                      <td style="text-align: left;width: 20%">{{ str_limit($value->content,40,'...') }}</td>


                        <td>{{ getTime($value->time) }}</td>
                        <td>{{ $value->name }}</td>
                       <td class="td-manage" width="10">
                            <div class="layui-input-inline" >
                                    <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"  onclick="x_admin_show('回复','/admin/replys/{{$value->id}}/huifu',500,300)"><i class="layui-icon layui-icon-edit"></i>回复</a>
                                    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del" onclick="delete_user(this,'{{ $value->id}}')" ><i class="layui-icon layui-icon-delete"></i>删除</a>
                            </div>
                        </td>                    </tr>
                 @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="page">
        {{ $words->links() }}
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
                    url:"{{url('admin/replys/delete')}}",
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
        function foo() {
            if($("#key").val() ===''){
                layer.msg('请输入点内容呗');
                return false;
            }
        }

        function admin(s,id) {
            layer.confirm('是否更新权限？',function(index){
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
