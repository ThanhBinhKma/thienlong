<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Human Share </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{asset('')}}">
    <link rel="icon" href="{{ asset('images/favicon/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="common/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="common/css/font-awesome.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" type="text/css" href="/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="/css/login-responsive.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="css/detailcv.css">
    <link rel="stylesheet" href="css/bookingres.css">
    <link rel="stylesheet" type="text/css" href="/css/category_responsive.css">
    <link rel="stylesheet" href="css/freelancer.css">
    @yield('css')

</head>

<body>
<div id=" " class="overlayer display-none "></div>
<span class="loader display-none">
	  <span class="loader-inner display-none"></span>
	</span>
@include('layouts.header')
<div class="site-content box-search-category">
    @yield('content')
</div>
@include('layouts.footer')

<!-- Scripts -->
<script src="common/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="{{asset('js/popper/popper.min.js')}}"></script>
<script src="common/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="{{asset('js/jquery.validate.min.js')}}"></script>
<script type="text/javascript" src="common/js/jquery-dateformat.min.js"></script>
<script type="text/javascript" src="common/js/moment.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script type="text/javascript" src="common/js/jquery-ui.min.js"></script>



<script type="text/javascript" src="{{asset('js/dropzone.js')}}"></script>
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://code.iconify.design/1/1.0.3/iconify.min.js"></script>
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('js/index.js')}}"></script>

@yield('js')

<script>
    $('.carousel').carousel({
        interval: 5000
    })
</script>

</body>
</html>
