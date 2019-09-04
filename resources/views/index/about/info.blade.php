@include('index.public.top')
<style>a{text-decoration:none}</style>
<body class="page-action"  id="wraper-bg">
	<div id="wraper-bg" class="wraper-bg">
	@include('index.public.head')
<div class="splash-wrap">
	<div class="box-content-wraper"  style="margin-top: 5em">
		<div class="page-words">
			<div class="box-list" style="margin-bottom: 1em">

				@foreach($abouts as $about)
					<a href="/about/{{$about->id}}" >
				<div class="item" style=" ">
					<img class="head-img mt" src="{{$about->icon}}"  style="height: 4em;border-radius:50%;width: 4em;margin-left:-1em">
					<div class="flexx"><div class="user-info">
							<img class="head-img mi"src="{{$about->icon}}" style="border-radius: 50%;height:4em;width:4em;margin-left:-2em">
							<span class="name">{{$about->title}}</span>
							<div class="message"></div>
							<div class="info"><span class="count" style="margin-left: 1em">{{$about->time}}</span>
							</div>
						</div>
					</div>
				</div>
					</a>
				@endforeach
			</div>
		</div>


	</div>

</div>

@include('index.public.footer')
</body>
</html>