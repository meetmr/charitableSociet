@include('index.public.top')
<body class="page-action">

<div class="wraper-bg">

    @include('index.public.head')

    <div class="box-content-wraper">
        <div class="box-list">

            <div class="" style="margin-top: 3em
">
            </div>
            @foreach( $activityRow as $activity)
                <div class="item pure-g">
                    <div class="info pure-u-1-1 pure-u-md-3-24">
                        <div class="time">{{ $activity->start_time}}</div>
                        <div class="type">{{ $activity->activity_type}}</div>
                    </div>
                    <div class="content pure-u-1-1 pure-u-md-19-24">
                        <div class="title">{{ $activity->activity_name}}</div>
                        <div class="sub">{{ $activity->activity_content}}</div>
                        <a href="/action/{{$activity->id}}" class="pure-button pure-input-1 pure-button-primary">活动详情</a>
                    </div>
                </div>
            @endforeach
                <div class="" style="margin-top: 12em
">
                </div>
        </div>
    </div>
</div>
@include('index.public.footer')


</body>
</html>