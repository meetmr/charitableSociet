
@include('public.top')
<!-- 顶部开始 -->
@include('public.head')

<!-- 顶部结束 -->
<!-- <div class="x-slide_left"></div> -->
@include('public.left')

<!-- 左侧菜单结束 -->

@yield("content")


<!-- 底部开始 -->
@include('public.footer')

<!-- 底部结束 -->
