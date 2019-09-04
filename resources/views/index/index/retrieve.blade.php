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
                        <legend>找回密码</legend>
                        <label for="email">Email</label>
                        <input class="pure-input-1" name="email" id="email"  type="email" placeholder="请输入注册时输入的邮箱">
                        <label for="username">学号</label>
                        <input class="pure-input-1" name="school_number" id="school_number" type="text" placeholder="请输入注册时输入的学号">
                        <label for="username">姓名</label>
                        <input class="pure-input-1" name="user_name" id="user_name" type="text" placeholder="请输入姓名">
                        <label for="username">系部</label>
                        <input class="pure-input-1" name="department" id="department" type="text" placeholder="请输入系部">
                        <label for="username">班级</label>
                        <input class="pure-input-1" name="class"  id="class" type="text" placeholder="请输入班级">

                    </fieldset>
                    <fieldset>
                        <button type="button" onclick="reg()" class="pure-button pure-input-1 pure-button-primary">确&nbsp;&nbsp;定</button>
                    </fieldset>
                </form>
            </div>
    </div>

</div>

@include('index.public.footer')
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    function reg() {

        if($("#email").val() ===''){
            layer.msg('邮箱不能为空', {
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

        if($("#user_name").val() ===''){
            layer.msg('姓名不能为空', {
                icon: 5,
                skin: 'layer-ext-moon',
            });
            return;
        }
        if($("#class").val() ===''){
            layer.msg('班级不能为空', {
                icon: 5,
                skin: 'layer-ext-moon',
            });
            return;
        }
        if($("#department").val() ===''){
            layer.msg('系部不能为空', {
                icon: 5,
                skin: 'layer-ext-moon',
            });
            return;
        }

        var  email = $("#email").val();
        var  school_number = $("#school_number").val();
        var  user_name = $("#user_name").val();
        var url = "{{url('retrieve')}}";
        var class1 =  $("#class").val();
        var department =  $("#department").val();
        var postData ={"email":email,"school_number":school_number,'user_name':user_name,'class':class1,'department':department};
        $.post(url,postData,function (result) {
            if(result.error == -1 ){
                layer.msg(result.msg, {
                    icon: 5,
                    skin: 'layer-ext-moon',
                });
            }else {
                 layer.alert(result.msg,function () {
                    window.location.reload();  //刷新父级页面
                });
            }
        },"json")

    }
</script>