<!doctype html>
<html lang="en">
  <head>
  	<title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="login1/css/style.css">

	</head>

	
	<body class="img js-fullheight" style="background-image: url(login1/images/bg.jpg);">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Bakool Outdoor</h2>
				</div>
			</div>
			@if(session()->has('loginError'))
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				{{ session('loginError') }}
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			  </div>
			@endif
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<b><h3 class="mb-4 text-center">Login</h3></b>
		      	<form action="/login" method="post" class="signin-form">
					@csrf
		      	<div class="form-group">
		      		<input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Username" required 
					name="username" id="username" value="{{ old('username') }}">
					  @error('username')
					  <div class="invalid-feedback">{{ $message }}</div>
				   @enderror
		      	</div>
	            <div class="form-group">
	              <input id="password-field" type="password" class="form-control" placeholder="Password" required name="password" id="password">
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-secondary submit px-3">Sign In</button>
	            </div>
	            <div class="form-group d-md-flex">
	            	<div class="w-50">
		            	<label class="checkbox-wrap checkbox-primary">Remember Me
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
									</label>
								</div>
								<div class="w-50 text-md-right">
									<a href="#" style="color: #fff">Forgot Password</a>
								</div>
	            </div>
	          </form>
	          <p class="w-100 text-center">&mdash; Haven't account? &mdash;</p>
	          <div class="social d-flex text-center">
				<a href="/register" class="px-2 py-2 ml-md-1 rounded"><span class="ion-logo-twitter mr-2"></span>Register</a>
	          </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

  <script src="login1/js/jquery.min.js"></script>
  <script src="login1/js/popper.js"></script>
  <script src="login1/js/bootstrap.min.js"></script>
  <script src="login1/js/main.js"></script>

	</body>
</html>
