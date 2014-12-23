<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="{{ URL::asset('images/favicon.ico') }}">

	@yield('meta')

	<title>
		@yield('title')
	</title>

	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/normalize.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/skeleton.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main.css') }}">
	
	@yield('head')
</head>
<body>

@include('layouts.navigation')

@yield('body')

@include('layouts.footer')
	
</body>
<script>document.getElementsByTagName("main")[0].style.minHeight = (window.innerHeight - (document.getElementsByTagName("nav")[0].clientHeight + document.getElementsByTagName("footer")[0].clientHeight + 41)) + 'px'</script>
</html>