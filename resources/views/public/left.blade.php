	<div class="left-nav">
    <div id="side-nav">
        <ul id="nav">
            <li>
                <a href="javascript:;">
                    <i class="layui-icon layui-icon-username"></i>
                    <cite>成员管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="{{url('admin/user/info')}}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>成员列表</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="{:url('index/personnel/adminList')}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>组织列表</cite>
                        </a>
                    </li >
 			<li>
                        <a _href="{{ url('admin/about/list') }}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>相册管理</cite>
                        </a>
                    </li >	
                </ul>
            </li>

            <li>
                <a href="javascript:;">
                    <i class="layui-icon layui-icon-flag"></i>
                    <cite>活动管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="{{ url('admin/activity/index') }}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>活动列表</cite>
                        </a>
                    </li >
 		<li>
                        <a _href="{{url('admin/replys/list')}}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>留言管理</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6df;</i>
                    <cite>系统设置</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="{:url('admin/Link/index')}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>友情链接</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="{:url('index/task/inTask')}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>系统配置</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="{:url('admin/Conf/index')}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>配置管理</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="{:url('admin/Conf/confList')}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>配置项</cite>
                        </a>
                    </li >
                </ul>
            </li>
        </ul>
    </div>
</div>