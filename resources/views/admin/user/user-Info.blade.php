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
    <span  style="text-align: center;margin-left: 3em" >共{{$count}}名同学</span>
  <a href="{{url('admin/activity/export')}}"><button class="layui-btn"  lay-submit="" lay-filter="sreach">导出名单</button></a>
</xblock>


<div class="x-body" >

    <div class="container-wrap">
        <div class="box-1">
            <table class="layui-table">
                <thead>
                <tr>
                    <th style="text-align: center" width="80">学号</th>
                    <th style="text-align: center" width="100">姓名</th>
                    <th style="text-align: center" width="100">管理员</th>
                    <th style="text-align: center" width="40">邮箱</th>
                    <th style="text-align: center" width="20">是否验证</th>
                    <th style="text-align: center" width="50" >系部</th>
                    <th style="text-align: center" width="50" >班级</th>
                    <th style="text-align: center" width="50">操作</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($users  as $value)
                        <tr  style="text-align: center">
                        <td>{{ $value->school_number }}</td>
                        <td>{{ $value->user_name }}</td>
<td>
                                @if($value->admin )
                                    是
                                @else
                                    否
                                @endif
                            </td>
		         <td>{{ $value->emal }}</td>
                         <td>
                            @if($value->is_serious)
                                已验证
                            @else
                               <span style="color: red">未验证</span>
                            @endif
                        </td> 
		  <td>{{ $value->department }}</td>
                        <td>{{ $value->class }}</td>
                        <td class="td-manage" width="10">
                            <div class="layui-input-inline" >
                                <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"  onclick="x_admin_show('修改','/admin/user/{{$value->id}}/edit',500,500)"><i class="layui-icon layui-icon-edit"></i>编辑</a>
                                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del" onclick="delete_user(this,'{{ $value->id}}')" ><i class="layui-icon layui-icon-delete"></i>删除</a>
                            </div>
                        </td>
                    </tr>
                 @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="page">
        {{ $users->links() }}
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
                    url:"{{url('admin/user/delete')}}",
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
        function foo() {
            if($("#key").val() ===''){
                layer.msg('请输入点内容呗');
                return false;
            }
        }
    </script>
</body>
</html>