@include('public.top')
<div class="x-body layui-anim layui-anim-up">
    <blockquote class="layui-elem-quote">欢迎管理员：
        <span class="x-red">{{session('admin.user_name')}}</span></blockquote>
    <fieldset class="layui-elem-field">
        <legend>数据统计</legend>
        <div class="layui-field-box">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-body">
                        <div class="layui-carousel x-admin-carousel x-admin-backlog" lay-anim="" lay-indicator="inside" lay-arrow="none" style="width: 100%; height: 90px;">
                            <div carousel-item="">
                                <ul class="layui-row layui-col-space10 layui-this">
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>成员总数</h3>
                                            <p><cite>{{$userCount}}</cite></p></a>
                                    </li>
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>活动总数</h3>
                                            <p><cite>{{$aCount}}</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>留言总数</h3>
                                            <p><cite>{{$wordCount}}</cite></p>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset class="layui-elem-field">
        <legend>开发团队</legend>
        <div class="layui-field-box">
            <table class="layui-table">
                <tbody>
                <tr>
                    <th>版权所有</th>
                    <td>爱心社</td>
                </tr>
                <tr>
                    <th>开发者</th>
                    <td>王恒兵</td></tr>
                </tbody>
            </table>
        </div>
    </fieldset>
</div>
