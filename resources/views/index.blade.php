<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{url('frontend/css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{url('frontend/css/tiny-slider.css')}}">
		<link rel="stylesheet" href="{{url('frontend/css/style.css')}}">
		<link rel="stylesheet" href="{{url('frontend/js/bootstrap.bundle.min.js')}}">
		<link rel="stylesheet" href="{{url('frontend/js/custom.js')}}">
		<link rel="stylesheet" href="{{url('frontend/js/tiny-slider.js')}}">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<!-- Sweet alert -->
		<link rel="stylesheet" href="{{url('frontend/js/sweetAlert.js')}}">
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css">
		<!-- Styles -->
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
		<?php
			use App\Models\Settings;
		?>
		@php
			$shopName = Settings::all()->first();
		@endphp
		<title>{{$shopName->website_name}}</title>
	</head>

	<body>

		<!-- Start Header/Navigation -->
		@include('frontend.mainPages.nav')
		<!-- End Header/Navigation -->

		<!-- main display/body  -->
		@yield('content')
		<!-- End main display -->

		<!-- Start Footer Section -->
		@include('frontend.mainPages.footer')
		<!-- End Footer Section -->

		<script src="{{url('frontend/js/bootstrap.bundle.min.js')}}"></script>
		<script src="{{url('frontend/js/tiny-slider.js')}}"></script>
		<script src="{{url('frontend/js/custom.js')}}"></script>
	</body>
</html>
