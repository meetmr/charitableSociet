<style>
    a{
        text-decoration:none;
        color:#333;
    }
</style>
<body class="page-index">
<div class="wraper-bg">

    <div class="header">
        <div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed" id="home">

            <a class="logo-set pure-menu-heading" href="/">
                <img class="logo" src="/index/picture/logo.png">
            </a>
	&nbsp;&nbsp;
            <a class="title-set pure-menu-heading" href="/">
                <span class="big-text">爱心社</span>
                <span class="small-text"> charitable societ</span>
                <span ></span>
            </a>
            <ul class="home-menu-list pure-menu-list">

                <li class="pure-menu-item"><a href="{{ url('/words') }}" class="pure-menu-link">留言板</a></li>
                @if(session('user'))
                    @if(session('user'))
                 <li class="pure-menu-item" style="color: #5e5d5d"><a href="{{ url('user/edit') }}">{{session('user.user_name')}}</a></li>
                    @endif
                    <li class="pure-menu-item"><a href="{{ url('user/outlogin') }}" class="pure-menu-link">注销</a></li>

                @else
                    <li class="pure-menu-item"><a class="pure-menu-link" href="{{ url('register') }}">注册</a></li>
                    <li class="pure-menu-item"><a class="pure-menu-link" href="{{ url('login') }}">登陆</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>