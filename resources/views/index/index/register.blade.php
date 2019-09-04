@include('index.public.top')
<body class="page-action">

<div class="wraper-bg">
    @include('index.public.head')

    <div class="login-panel">
        <div class="login pure-g" style="margin-bottom: 3em">
            <div class="box login pure-u-1 pure-u-md-13-24" style="margin: 0 auto">
                <form class="pure-form pure-form-stacked" >
                    <input type="hidden" name="method" value="login" />
                    <fieldset>
                        <legend>注册成为爱心社的一员</legend>
                        <label for="email">Email</label>
                        <input class="pure-input-1" name="email" id="email" type="email" placeholder="如：1781634625@qq.com">
                        <label for="username">学号</label>
                        <input class="pure-input-1" name="school_number" id="school_number" type="text" placeholder="数字8位用于登陆">
                        <label for="password">设置密码</label>
                        <input class="pure-input-1" name="pwd" id="password"   type="password" placeholder="任意字符6-20位">
                        <label for="password2">重复密码</label>
                        <input class="pure-input-1" name="rePwd" id="password2"  type="password" placeholder="任意字符6-20位">
                    </fieldset>
                    <fieldset>
                        <button type="button" onclick="reg()" class="pure-button pure-input-1 pure-button-primary">注&nbsp;&nbsp;册</button>
                    </fieldset>
                </form>
            </div>
    </div>

</div>

@include('index.public.footer')
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    function reg() {
        var reg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$"); //正则表达式
        var reg1 = /^\d{8}\b/;
        var pass = /^\w{6,16}$/;
        if($("#email").val() ===''){
            layer.msg('邮箱不能为空', {
                icon: 5,
                skin: 'layer-ext-moon',
            });
            return;
        }
        if(!reg.test($("#email").val())){
            layer.msg('邮箱格式不对哦', {
                icon: 5,
                skin: 'layer-ext-moon',
            });
            return;
        }

        if($("#school_number").val() ===''){
            layer.msg('学号不能为空', {
                icon: 5,
                skin: 'layer-ext-moon',
            });
            return;
        }
        if(!reg1.test($("#school_number").val())){
            layer.msg('学号格式不对哦', {
                icon: 5,
                skin: 'layer-ext-moon',
            });
            return;
        }

        if($("#password").val() ===''){
            layer.msg('密码不能为空', {
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
        if($("#password2").val() !== $("#password").val() ){
            layer.msg('重复密码格式不对', {
                icon: 5,
                skin: 'layer-ext-moon',
            });
            return;
        }

        var  email = $("#email").val();
        var  school_number = $("#school_number").val();
        var  password = $("#password").val();
        var url = "{{url('register')}}";
        var password2 =  $("#password2").val();
        var postData ={"email":email,"school_number":school_number,'password':password,'password2':password2};
        $.post(url,postData,function (result) {
            if(result.error === 1 ){
                layer.alert(result.msg,function () {
                  location.href = "{{ url('login') }}";
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
