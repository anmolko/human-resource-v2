<!DOCTYPE html>
<html lang="en">
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="">
		<meta name="robots" content="">
		<title>Login - HRMS</title>

		<!-- Favicon -->
		<link rel="shortcut icon" type="image/x-icon" href="{{asset('backend/assets/img/canosoft_favicon.png')}}">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('backend/assets/css/bootstrap.min.css')}}">

		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{asset('backend/assets/css/font-awesome.min.css')}}">

		<!-- Main CSS -->
		<link rel="stylesheet" href="{{asset('backend/assets/css/style.css')}}">

<style>
    .account-box .account-btn {
        background: #00C5FB;
        background: -moz-linear-gradient(left, #00C5FB 0%, #0253CC 100%);
        background: -webkit-linear-gradient(left, #00C5FB 0%, #0253CC 100%);
        background: -ms-linear-gradient(left, #00C5FB 0%, #0253CC 100%);
        background: linear-gradient(to right, #00C5FB 0%, #0253CC 100%);
        border: 0;
        border-radius: 4px;
        display: block;
        font-size: 22px;
        padding: 10px 26px;
        width: 100%;
    }
</style>

	</head>
	<body class="account-page">

		<!-- Main Wrapper -->
		<div class="main-wrapper">
			<div class="account-content">
				<div class="container">
					<!-- Account Logo -->
					<div class="account-logo">
						<a href="/"><img src="{{asset('backend/assets/img/canosoft.png')}}" style="width: 200px;" alt="Company Logo"></a>
					</div>
					<!-- /Account Logo -->

					<div class="account-box">
                        @yield('content')

					</div>
				</div>
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
