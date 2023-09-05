<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="">
        <meta name="robots" content="">
        <title>404 Error - HRMS </title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('backend/assets/img/favicon.png')}}">
		
			<!-- Bootstrap CSS -->
            <link rel="stylesheet" href="{{asset('backend/assets/css/bootstrap.min.css')}}">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{asset('backend/assets/css/font-awesome.min.css')}}">
		
		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="{{asset('backend/assets/css/line-awesome.min.css')}}">

		<!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('backend/assets/css/style.css')}}">
        <link rel="stylesheet" type="text/css" href="/backend/assets/css/<?php if(@$theme_data->color){?>{{@$theme_data->color}}<?php }else{ echo "light_grey"; }?>.css">
	
    </head>
    <body class="error-page">
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			
			<div class="error-box">
				<h1>{{$code}}</h1>
				<h3><i class="fa fa-warning"></i> Oops! Page not found.</h3>
                <p>
                <strong>{{ @$message }}</strong><br>
                Meanwhile, you may <a href="{{ route ('dashboard')}}">return to dashboard</a> or try using the Button.
                </p>
				<a href="{{ route ('dashboard')}}" class="btn btn-custom">Back to Home</a>
			</div>
		
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="{{asset('backend/assets/js/jquery-3.2.1.min.js')}}"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="{{asset('backend/assets/js/popper.min.js')}}"></script>
        <script src="{{asset('backend/assets/js/bootstrap.min.js')}}"></script>
		
		<!-- Custom JS -->
		<script src="{{asset('backend/assets/js/app.js')}}"></script>
		
    </body>
</html>

