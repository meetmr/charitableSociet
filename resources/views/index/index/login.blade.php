@include('index.public.top')
<body class="page-action">

<div class="wraper-bg">
    @include('index.public.head')
<div class="login-panel">
        <div class="login pure-g">
            <div class="box login pure-u-1 pure-u-md-13-24" style="margin: 0 auto">
                <form class="pure-form pure-form-stacked" action="/UserServlet" method="post">
                    <input type="hidden" name="method" value="login" />
                    <fieldset>
                        <legend>用户登录</legend>

                        <label for="username">学号</label>
                        <input class="pure-input-1" name="username" id="school_number" type="text" placeholder="请输入学号">
                        <input class="pure-input-1" name="url" id="url" value="{{$url}}" type="hidden" >

                        <label for="password">设置密码</label>
                        <input class="pure-input-1" name="pwd" id="password" type="password"  placeholder="请输入密码">

                    </fieldset>
                    <fieldset>
                        <button type="button"  onclick="login()" class="pure-button pure-input-1 pure-button-primary">登&nbsp;&nbsp;录</button>
 <br>
                        <span style="cursor: pointer" ><a href="{{url('retrieve')}}">忘记密码</a></span>
                    </fieldset>
                </form>
            </div>
    </div>

</div>

@include('index.public.footer')
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    function login() {
        var school_number = $("#school_number").val();
        var password = $("#password").val();
    var jump = $("#url").val();
        var reg1 = /^\d{8}\b/;
        var pass = /^\w{6,16}$/;
        if(!reg1.test($("#school_number").val())){
            layer.msg('学号格式不对哦', {
                icon: 5,
                skin: 'layer-ext-moon',
            });
            return;
        }
        if(!pass.test($("#password").val())){
            layer.msg('密码格式不对', {
                icon: 5,
                skin: 'layer-ext-moon',
            });
            return;
        }
        var url = "{{url('login')}}";
        var postData ={"school_number":school_number,'password':password,'url':jump}
        $.post(url,postData,function (result) {
            if(result.error === 1 ){
                 var url = result.url;
                layer.msg(result.msg);
                location.href = url;
            }else if (result.error === 2 ){
                layer.alert(result.msg,function () {
                    location.href = "{{ url('user/activate') }}";
                });
            }
            else {
                layer.msg(result.msg, {
                    icon: 5,
                    skin: 'layer-ext-moon',
                });

            }
        },"json")
    }
</script>
