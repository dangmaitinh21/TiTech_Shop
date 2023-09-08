<!DOCTYPE html>
<html lang="en">
<head>
	@include('head')
</head>
<body >
	<!-- <body class="animsition"> -->
	
	<!-- Header -->
    @include('header')

	<!-- Cart -->
	@include('cart')
	
	@include('sweetalert::alert')
	<!-- Content -->
	@yield('content')

	<!-- Footer -->
	@include('footer')

</body>
</html>