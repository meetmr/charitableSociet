<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/index/css/pure-min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/index/css/grids-responsive-min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/index/css/global.css')}}">
    <script src="https://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
    <script src="{{asset('/layer/layer.js')}}"></script>
    <script src="{{asset('/ueditor/ueditor.config.js')}}"></script>
    <script src="{{asset('/ueditor/ueditor.all.min.js')}}"></script>
    <script src= "{{asset('/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript" src="https://cdn.bootcss.com/canvas-nest.js/1.0.1/canvas-nest.min.js"></script>
    <script type="text/javascript" src="{{asset('/js/function.js')}}"></script>
</head>