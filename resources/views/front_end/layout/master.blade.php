<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<section class="container">
		@include('front_end.layout.header')
		@yeild('content')
		@include('front_end.layout.footer')
	</section>
</body>
</html>