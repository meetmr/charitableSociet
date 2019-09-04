@include('index.public.top')
<style>
    .detail  img{
        display:block;margin:0 auto;padding:10px; /* max-width:650px */
    }
    /*以下为兼容手机代码*/
    @media(max-width:760px){
        .detail  img{max-width: 100%;height: auto;width: auto\9;}
    }
</style>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<title>{{ $title }}</title>
<link rel="stylesheet" type="text/css" href="{{ asset('/index/css/pure-min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('/index/css/grids-responsive-min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('/index/css/global.css')}}">
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
<script src="{{asset('/layer/layer.js')}}"></script>
<script src="{{asset('/ueditor/ueditor.config.js')}}"></script>
<script src="{{asset('/ueditor/ueditor.all.min.js')}}"></script>
<script src= "{{asset('/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<body class="page-action"  id="wraper-bg">
<style>
    textarea{ resize:none;}
    a{
        text-decoration:none;
        color: #aaa;
    }
    a:link{
        text-decoration:none;
    }
    a:visited{
        text-decoration:none;
    }
    a:hover{
        text-decoration:none;
        color: #ccc;
    }
    a:active{
        text-decoration:none;
    }
</style>
<div id="wraper-bg" class="wraper-bg">
    @include('index.public.head')
    <div class="detail box-content-wraper">
        <div class="box-content">
            <div class="banner">
                <span class="title">{{ $activity['activity_name'] }}</span>
            </div>
            <div class="content">
                <p class="message"><span class="trans">“</span>{{ $activity['activity_name'] }}
                   <span class="trans">”</span></p>
                <form class="pure-form pure-form-aligned" action="/ActivityServlet" method="post">
                    <fieldset>
                        <legend>活动信息</legend>
                        <div class="pure-control-group">
                       
                            <span class="pure-form-message-inline"  style="font-size: 1em">&nbsp;&nbsp;&nbsp;&nbsp;{{ $activity['activity_content'] }}</span>
                        </div>

                        <div class="pure-control-group">
                            <label for="name">活动类型</label>
                            <span class="pure-form-message-inline">{{ $activity['activity_type'] }}</span>
                        </div>

                        <div class="pure-control-group">
                            <label for="name">时间安排</label>
                            <span class="pure-form-message-inline">{{ $activity['start_time'] }}</span>
                        </div>

                        <div class="pure-control-group">
                            <label for="name">人数安排</label>
                            <span class="pure-form-message-inline">{{ $activity['number'] }}</span>
                        </div>

                        <div class="pure-control-group">
                            <label for="name">参与者</label>
                            <span class="pure-form-message-inline">{{ $activity['participant'] }}</span>
                        </div>

                        <div class="pure-control-group">
                            <label for="name">地点安排</label>
                            <span class="pure-form-message-inline">{{ $activity['place'] }}</span>
                        </div>
                        @if($activity['is_over'] !== 1)

                        <div class="pure-control-group">
                            <label for="name">已报人数</label>
                            <span class="pure-form-message-inline">  {{ countCheenroll($activity['id']) }}</span>
                        </div>
                        @endif

                    @if($activity['is_over'] === 1)
                        <div class="pure-control-group">
                            <label for="name">活动总结</label>
                            <div class="detail">
                                {!! $activity['summary']!!}
                            </div>
                        </div>
                        @endif
                        @if($activity['is_over'] !== 1)
                        <div class="pure-controls">
                            @if( is_cheenroll($activity['id']))
                                <a  disabled  class="pure-button pure-button-">已报名</a>
                            @else
                                @if(session('user'))
                                    @if( countCheenroll($activity['id'])  >= $activity['number'])
                                        <a  disabled  class="pure-button pure-button-">人数已满</a>
                                    @else
                                        <a href="/user/enroll/{{$activity['id']}}" class="pure-button pure-button-primary">报名</a>

                                    @endif
                                @else
                                      <a href="/login?url={{$url}}" class="pure-button pure-button-primary">登录后报名</a>
                                @endif
                            @endif
                            @endif

                        </div>
                    </fieldset>
                </form>
                @if($activity['is_over'] === 1)

                    <div class="box-content">
                        <div class="content" style="padding-bottom: 1em" style=" background-color:rgba(255,0,15,0.2);}">
                            <h3> 评论 </h3>
                            @if(session('user'))
                            <div class="nav pure-menu pure-menu-horizontal"  >
                                    <form method="post">
                                        <input type="hidden" value="save" name="method" />
                                        <input type="hidden" id="id" name="id" value="{{$activity['id']}}">
                                        <textarea rows="5" style="width:99%;outline:none;border-radius: 1em;resize:none" class="current" id="content" name="content"></textarea> <br />
                                        <button type="button" onclick="sub()"  class="pure-button pure-button-primary">提交</button>
                                    </form>
                                </div>
                            @else
                                   <a href="/login?url={{$url}}" class="pure-button pure-button-primary">登录后留言</a>
                            @endif
                            <br />
                        </div>
                    </div>
                <?php  $info = geComment($activity['id'])?>
                    <div class="page-words">
                        <div class="box-list">
                            @foreach($info as $value)
     <?php $user = getCommentUser($value->u_id)?>
                            <div class="item" style=" ">
                                <img class="head-img mt" src="{{$user['icon_path']}}"  style="border-radius: 50% ;height: 5em;width: 5em;margin-left:-1em">
                                <div class="flexx"><div class="user-info">
                                        <img class="head-img mi" src="{{$user['icon_path']}}" style="border-radius: 50%;height:5em;width:5em;margin-left:-2em">
                                        <span class="name">{{$value->name}}</span>
                                        <div class="message">{{$value->content}}</div>
                                        <div class="info"><span class="count">{{getTime($value->time)}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

            </div>
        </div>
    </div>
</div>
@include('index.public.footer')


</body>
</html>

<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    function sub() {
        var content = $("#content").val();
        var id = $("#id").val();
        $("#content").val('');

        if(content == ''){
            layer.msg('请输入点内容');
            return false;
        }
        if(content.length <= 5){
            layer.msg('内容不能低于5个字符');
            return false;
        }
        var url = "{{url('user/comment')}}";
        var postData ={"content":content,'id':id};
        $.post(url,postData,function (result) {
            if(result.error === 1 ){
                layer.msg(result.msg,function () {
                    window.location.reload();  //刷新父级页面
                });
            }else {
                layer.msg(result.msg, {
                    icon: 5,
                    skin: 'layer-ext-moon',
                });

            }
        },"json")
    }
</script>