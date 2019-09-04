@include('index.public.top')
<body class="page-action">

<div class="wraper-bg">
    @include('index.public.head')

    <div class="login-panel">
        <div class="login pure-g">
            <div class="box login pure-u-1 pure-u-md-13-24" style="margin: 0 auto">
                <form class="pure-form pure-form-stacked" >
                    <input type="hidden" name="method" value="login" />
                    <fieldset>
                        <legend>报名参加-确认信息</legend>
                        <label for="email">活动名称</label>
                        <input class="pure-input-1"  id="name"  disabled value="{{$activity['activity_name']}}" type="text">
                        <input class="pure-input-1" name="a_id" id="a_id" disabled value="{{$activity['id']}}" type="hidden">
                        <label for="email">学号</label>
                        <input class="pure-input-1" disabled name="school_number" id="school_number" value="{{session('user.school_number')}}"  type="text">
                        <label for="password2">系部</label>
                        <input class="pure-input-1" name="department" id="department"  value="{{session('user.department')}}"  type="text" >
                        <label for="username">班级</label>
                        <input class="pure-input-1" name="class" id="class" value="{{session('user.class')}}"    type="text" >
                        <label for="password">姓名</label>
                        <input class="pure-input-1" name="user_name" value="{{session('user.user_name')}}" id="user_name" type="text" >
                    </fieldset>
                    <fieldset>
                        <button type="button" onclick="reg()" class="pure-button pure-input-1 pure-button-primary">报&nbsp;&nbsp;名</button>
                    </fieldset>
                </form>
            </div>
        </div>

    </div>
</div>
    @include('index.public.footer')
    <script>
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        function reg() {
            if($("#name").val() ===''){
                layer.msg('活动名称', {
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

            var  a_id = $("#a_id").val();
            var  school_number = $("#school_number").val();
            var  department = $("#department").val();
            var  class1 = $("#class").val();
            var  user_name = $("#user_name").val();
            var url = "{{url('user/enroll')}}";
            var postData ={"a_id":a_id,"school_number":school_number,'department':department,'class1':class1,'user_name':user_name};
            $.post(url,postData,function (result) {
                if(result.error === 1 ){
                    layer.alert(result.msg,function () {
                        location.href = "/";
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