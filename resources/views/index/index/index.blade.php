@include('index.public.top')
<body class="page-action"  id="wraper-bg">

<div id="wraper-bg" class="wraper-bg">
	@include('index.public.head')
<div class="splash-wrap">
		<div class="splash">
			<div class="splash-head pure-g">

				<div class="logo pure-u-1 pure-u-md-3-8">
					<img class="logo" src="/index/picture/logo.png">
				</div>

				<div class="text pure-u-1 pure-u-md-5-8">
					<div>
						<p class="centen1">
							心连心同献爱心
						</p>
						<p class="centen2">
							手牵手齐伸援手！
						</p>
						<p class="enters">
							<a href="{{ url('action') }}" class="pure-button pure-button-primary">往期活动</a>
							<a href="{{ url('about') }}" class="pure-button pure-button-primary">关于我们 :)</a>
						</p>
					</div>
				</div>
			</div>

			<p class="splash-subhead">'

			</p>

		</div>
	</div>


	<div class="box-content-wraper">
		<div class="box-list">
			@foreach( $activitys as $activity)
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
		</div>
	</div>

</div>

@include('index.public.footer')
</body>
</html>