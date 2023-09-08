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
	@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
	<!-- Content -->
	@yield('content')

	<!-- Footer -->
	@include('footer')

</body>
</html>