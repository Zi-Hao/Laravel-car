<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Car') - 驾校预约报名系统</title>
    <!-- 样式 -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
      <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"></script>
      <script src="https://cdn.bootcss.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
</head>
<body>
<div id="app" class="{{ route_class() }}-page">
    @include('layouts._header')
    <div class="container">
        @yield('content')
    </div>
    @include('layouts._footer')
</div>
<!-- JS 脚本 -->
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>