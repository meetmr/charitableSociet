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

<div id="wraper-bg" class="wraper-bg">
    @include('index.public.head')
    <div class="detail box-content-wraper" >
        <div class="box-content">
            <div class="banner">
                <span class="title"> {{$abouts['title']}}</span>
            </div>
            <div class="content">
                    <fieldset>
                        <legend>相册信息</legend>
                        <div class="pure-control-group">
                            <div class="detail">
                                {!! $abouts['coantent']!!}
                            </div>
                        </div>
                    </fieldset>
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