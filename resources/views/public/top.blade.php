<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="{{ asset('/admin/favicon.ico') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('/admin/css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/font1.css')}}">
    <link rel="stylesheet" href="{{ asset('/admin/css/xadmin.css') }}">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js "></script>
    <script src="{{ asset('/admin/lib/layui/layui.js') }}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('/admin/js/xadmin.js') }}"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .container-wrap {
            width: 100%;
            height: 100%;
            white-space: nowrap;
            overflow: hidden;
            overflow-x: scroll; /* 1 */
            -webkit-backface-visibility: hidden;
            -webkit-perspective: 1000;
            -webkit-overflow-scrolling: touch; /* 2 */
            text-align: justify; /* 3 */
        &::-webkit-scrollbar {
             display: none;
         }
        }

        .container > div {
            display: inline-block;
            height: 50px;
            color: #fff;
            text-align: center;
            line-height: 50px;
        }
        .box-1 {
            width:100%;
        }

    </style>
</head>
<body>
