<div class="container">
    <div class="logo"><a href="{{ url('/') }}">爱心社 v1.0</a></div>
    <div class="left_open">
        <i title="展开左侧栏" class="iconfont">&#xe699;</i>
    </div>
    <ul class="layui-nav right" lay-filter="">
        <li class="layui-nav-item">
            @if(session('admin'))
                <a href="javascript:;">{{session('admin.user_name')}}</a>
            @endif

            <dl class="layui-nav-child"> <!-- 二级菜单 -->
                {{--<dd><a onclick="x_admin_show('个人信息','http://www.baidu.com')">个人信息</a></dd>--}}
                <dd><a href="{{ url('admin/outlogin') }}">退出</a></dd>
            </dl>
        </li>
    </ul>
</div>