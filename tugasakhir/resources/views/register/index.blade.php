<!doctype html>
<html lang="en">
  <head>
  	<title>Register</title>
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
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<b><h3 class="mb-4 text-center">Register</h3></b>
		      	<form action="/register" method="post" class="signin-form">
                    @csrf  
		      		<div class="form-group">
		      			<input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username" id="username" required value="{{ old('username') }}">
                          @error('username')
                             <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
		      		</div>
					  <div class="form-group">
						<input type="text" name="nama_pelanggan" class="form-control @error('nama_pelanggan') is-invalid @enderror" placeholder="Nama" id="nama_pelanggan" required value="{{ old('nama_pelanggan') }}">
						@error('nama_pelanggan')
						   <div class="invalid-feedback">{{ $message }}</div>
						@enderror
					</div>
                      <div class="form-group">
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" id="email" required value="{{ old('email') }}">
                        @error('email')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
	            <div class="form-group">
	              <input id="password-field" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" id="password" required>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                  @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
	            </div>
				<div class="form-group">
	              <input id="password-field" name="password_confirm" type="password_confirm" class="form-control" placeholder="Confirm Password" id="password_confirm" required>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-secondary submit px-3">Register</button>
	            </div>
	          </form>
	          <p class="w-100 text-center">&mdash; Have account? &mdash;</p>
	          <div class="social d-flex text-center">
				<a href="/login" class="px-2 py-2 ml-md-1 rounded"><span class="ion-logo-twitter mr-2"></span>Login</a>
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
