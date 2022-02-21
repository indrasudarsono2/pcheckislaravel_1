<!DOCTYPE html>
<html lang="en">
<head>
	<title>proton.iatca-jakarta.or.id</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ asset('Login/images/logo2.png') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('Login/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('Login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('Login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('Login/vendor/animate/animate.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('Login/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('Login/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('Login/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('Login/css/main.css') }}">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('{{ asset('Login/images/background2.jpg') }}');">
			<div class="wrap-login100 p-t-80 p-b-30">
				<form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
					@csrf
					<div class="login100-form-avatar">
						<img src="{{ asset('Login/images/logo2.png') }}" alt="PROTON">
					</div>

					<span class="login100-form-title p-t-20 p-b-45">
						PROFICIENCY CHECK FOR ATC RATINGS - ONLINE
					</span>
					@if (session('alert'))
						<div class="alert alert-danger alert-dismissible show fade">
							<div class="alert-body">
								<button class="close" data-dismiss="alert">
									<span>×</span>
								</button>
								Email does not exists !
							</div>
						</div>
					@endif
					@if (session('message'))
						<div class="alert alert-danger alert-dismissible show fade">
							<div class="alert-body">
								<button class="close" data-dismiss="alert">
									<span>×</span>
								</button>
								Wrong license number or password
							</div>
						</div>
					@endif
					@if (session('status'))
						<div class="alert alert-success alert-dismissible show fade">
							<div class="alert-body">
								<button class="close" data-dismiss="alert">
									<span>×</span>
								</button>
								Password edited successfully
							</div>
						</div>
					@endif
					@if (session('msg'))
					<div class="alert alert-success alert-dismissible show fade">
						<div class="alert-body">
							<button class="close" data-dismiss="success">
								<span>×</span>
							</button>
							{{ session('msg') }}
						</div>
					</div>
					@endif
					@if (session('warning'))
					<div class="alert alert-danger alert-dismissible show fade">
						<div class="alert-body">
							<button class="close" data-dismiss="success">
								<span>×</span>
							</button>
							{{ session('warning') }}
						</div>
					</div>
					@endif

					<div class="wrap-input100 validate-input m-b-10" data-validate = "License number is required">
						<input class="input100" type="text" name="license_number" placeholder="License Number">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-id-card"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock ml-1"></i>
						</span>
					</div>

					<div class="container-login100-form-btn p-t-10">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center w-full p-t-25 p-b-230">
						<a href="{{ url('/forgot_password') }}" class="txt1">
							<span style="color:white">Forgot Password?</span> 
						</a><br/>
						<div class="mt-1">
							<span style="color:white;">Powered By DPC IATCA Jakarta</span><br/>
							<img src="{{asset('iatca1.png')}}" alt="" width="80px" height="auto">
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="{{ asset('Login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('Login/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('Login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('Login/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('Login/js/main.js') }}"></script>

</body>
</html>