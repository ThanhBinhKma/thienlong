<!DOCTYPE html>
<html> 
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> @yield('title') </title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <base href="{{asset('')}}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon01.ico') }}" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <!-- jvectormap -->
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <!-- Daterange picker -->
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/dropzone/dist/dropzone.css">
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  {{-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&subset=vietnamese" rel="stylesheet"> --}}
  <link rel="stylesheet" href="css/_all.css">
  <link rel="stylesheet" href="css/admin_core.css">
  {{-- <link rel="stylesheet" href="css/sweetalert.css"> --}}
  <link rel="stylesheet" href="css/sweetalert2.min.css">
  <link rel="stylesheet" href="vendor/select2/select2.min.css">
  <link rel="stylesheet" href="css/style.css">
  @yield('addcss')
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		@include('admin.layouts.header')
		@include('admin.layouts.aside')
		<div class="content-wrapper">
			@yield('content')
		</div>
		@include('admin.layouts.footer')
	</div>
	<!-- jQuery 3 -->
	<script src="bower_components/jquery/dist/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
	  $.widget.bridge('uibutton', $.ui.button);
	</script>
	<!-- Bootstrap 3.3.7 -->
	<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<!-- Morris.js charts -->
	<!-- Sparkline -->
	<!-- jvectormap -->
	<!-- daterangepicker -->
	<script src="bower_components/moment/min/moment.min.js"></script>
	<!-- datepicker -->
	<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
	<script type="text/javascript" src="js/dropzone.js"></script>
	<!-- Bootstrap WYSIHTML5 -->
	<!-- Slimscroll -->
	<!-- FastClick -->
	<!-- iCheck 1.0.1 -->
	
	<script src="plugins/iCheck/icheck.min.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/adminlte.min.js"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	{{-- <script src="dist/js/pages/dashboard.js"></script> --}}
	<!-- AdminLTE for demo purposes -->
	<script src="{{ asset('bower_components/ckeditor/ckeditor.js') }}"></script>

	<script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
            entities: false,
            basicEntities: false,
            entities_greek: false,
            entities_latin: false,
        };
	</script>
	 <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
	 <script src="vendor/laravel-filemanager/js/stand-alone-button.js"></script>
	 <script>
		CKEDITOR.replace('content', options);
	</script>
	 

	<script src="dist/js/demo.js"></script>
	<script src="js/sweetalert2.min.js"></script>
	 {{--<script src="js/app.js"></script>--}}
	<script src="js/admin_core.js"></script>
	
	@yield('addjs')
</body>
</html>