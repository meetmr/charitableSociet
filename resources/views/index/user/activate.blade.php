@include('index.public.top')
<style>

</style>
<body class="page-action">

<script src="{{ asset('/admin/lib/layui/layui.js') }}" charset="utf-8"></script>
<script type="text/javascript" src="{{ asset('/admin/js/xadmin.js') }}"></script>
<link rel="stylesheet" href="{{ asset('/admin/css/xadmin1.css') }}">

<div class="wraper-bg">
    @include('index.public.head')
    <div class="login-panel">
        <div class="login pure-g" style="margin-bottom: 3em">
            <div class="box login pure-u-1 pure-u-md-13-24" style="margin: 0 auto">
                <form class="pure-form pure-form-stacked" >
                    <input type="hidden" name="method" value="login" />
                    <fieldset>
                        <legend>填写个人信息</legend>
                            <div class="layui-input-block">
                                {{--<button type="button" class="layui-btn" >上传图片</button>--}}
                                <input type="hidden" id="img_url" name="icon_path" value="http://love.1flove.com/5ugbk1TSXENSqTCSxVIAa7tK0bvS3mKjPd2mCUVY.jpg"/>
                                <div class="layui-upload-list">
                                    <img class="layui-upload-img" src="http://love.1flove.com/5ugbk1TSXENSqTCSxVIAa7tK0bvS3mKjPd2mCUVY.jpg" width="80px" height="80px" id="demo1" style="border-radius: 50%"/>
                                    <p id="demoText"></p>
                                </div>
                            </div>
                        <label for="school_number">学号</label>
                        <input class="pure-input-1"  disabled value="{{ $userInfo['school_number'] }}"  type="text">
                        <label for="department">系部</label>
                        <select  style="font-size: 1em" name="department"  class="pure-input-1"  id="department" >
                            <option value="信息工程系">信息工程系</option>
                            <option value="电子工程系">电子工程系</option>
                            <option value="机电工程系">机电工程系</option>
                            <option value="经济与管理系">经济与管理系</option>
                            <option value="汽车工程系">汽车工程系</option>
                            <option value="数字艺术系">数字艺术系 </option>
 		               <option value="电气工程系">电气工程系 </option>

                        </select>                        <label for="class">班级</label>
                        <input class="pure-input-1"  name="class" placeholder="如：软件16-5" id="class" type="text" value="">
                        <label for="user_name">姓名</label>
                        <input class="pure-input-1" name="user_name"  id="user_name" type="text" value="">
                        <input class="pure-input-1" name="user_id" id="user_id" type="hidden" value="{{ $userInfo['id'] }}">
                    </fieldset>
                    <fieldset>
                        <button type="button" onclick="activate()" class="pure-button pure-input-1 pure-button-primary">完&nbsp;&nbsp;成</button>
                    </fieldset>
                </form>
            </div>
    </div>

</div>

@include('index.public.footer')
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    function activate() {

        var  department = $("#department").val();
        var  class1 = $("#class").val();
        var  user_name = $("#user_name").val();
        var  img_url = $("#img_url").val();
        if(department === ''){
            layer.msg('请填写系部');
            return;
        }
        if(class1 === ''){
            layer.msg('请填写班级');
            return;
        }
        if(user_name === ''){
            layer.msg('请填写姓名');
            return;
        }
        var url = "{{url('user/activate')}}";
        var postData ={"department":department,"class1":class1,'user_name':user_name,'icon_path':img_url};
        $.post(url,postData,function (result) {
            if(result.error === 1 ){
                layer.alert(result.msg,function () {
                  location.href = "{{ url('/') }}";
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
    <script type="text/javascript">
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

        layui.use('upload', function(){
            var upload = layui.upload
                , $ = layui.jquery;
            var uploadInst = upload.render({
                elem: '#demo1' //绑定元素
                ,url: "{{url('user/up') }}"
                ,before: function(obj){
                    //预读本地文件示例，不支持ie8
                    obj.preview(function(index, file, result){
                        $('#demo1').attr('src', result); //图片链接（base64）
                    });
                }
                ,done: function(res){
                    //如果上传失败
                    if(res.code === 0){
                        return layer.msg('上传失败');
                    }
                    //上传成功
                    document.getElementById("img_url").value = res.url;

                }
                ,error: function(){
                    //演示失败状态，并实现重传
                    var demoText = $('#demoText');
                    demoText.html('<span style="color: #FF5722;">上传失败</span>');
                    demoText.find('.demo-reload').on('click', function(){
                        uploadInst.upload();
                    });
                }
            });
        });
    </script>
