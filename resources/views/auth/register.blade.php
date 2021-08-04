<!DOCTYPE html>
<html lang="en">
<head>
	<title><?= $data['title'] ?> | Study Club TI Polindra</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="/assets/login/images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="/assets/login/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/login/css/util.css"> 
	<link rel="stylesheet" type="text/css" href="/assets/login/css/main.css">
	<style>
		.swal2-timer-progress-bar {
			background: #2778c4 !important;
		}

		.login100-form-title {
			padding: 50px 15px;
		}

		.login100-form {
			padding: 43px 88px 43px 190px;
		}

		select {
			outline: none;
			border: none;
		}

		select.input100 {
			height: 45px;
		}

		@media (max-width: 480px) {
			.login100-form {
				padding: 43px 15px 57px 15px;
			}
		}
	</style>
	
	<script src="/assets/plugins/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="/assets/plugins/sweetalert2/dist/sweetalert2.all.js"></script>
</head>
<body>
	<div id="pesan"></div>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title">
					<span class="login100-form-title-1">
						Selamat Datang
					</span>
				</div>
				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				<form action="/registration" method="post" onsubmit="return false;" id="form">
					@csrf
					<div class="login100-form validate-form">

						<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
							<span class="label-input100">Bidang Study</span>
							<select name="category" id="category" class="input100">
								@foreach ($data['category'] as $c)
								<option value="<?= $c->id ?>"><?= $c->category ?></option>
								@endforeach
							</select>
							<span class="focus-input100"></span>
						</div>

						<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
							<span class="label-input100">Email</span>
							<input class="input100" type="text" id="email" name="email" placeholder="Email">
							<span class="focus-input100"></span>
						</div>

						<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
							<span class="label-input100">Password</span>
							<input class="input100" type="password" id="password" name="password" placeholder="Password" minlength="6">
							<span class="focus-input100"></span>
						</div>

						<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
							<span class="label-input100">Konfirmasi Password</span>
							<input class="input100" type="password" id="password2" name="password2" placeholder="Konfirmasi Password" minlength="6">
							<span class="focus-input100"></span>
						</div>

						<div class="container-login100-form-btn">
							<button class="login100-form-btn" id="register"> 
								Register
							</button>
						</div>
						<a href="/" class="small mt-3">Silahkan sign in bagi yang sudah punya akun!</a>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function () {
			$("#register").click(function () {
				let email = $("#email").val().trim();
				let password = $("#password").val().trim();
				let password2 = $("#password2").val().trim();
				if (email == "" && password == "" && password2 == "") {
					$("#pesan").html(Swal.fire('Ooops!', 'Email dan password tidak boleh kosong!', 'error'));
				} else if (email == "") {
					$("#pesan").html(Swal.fire('Ooops!', 'Email tidak boleh kosong!', 'error'));
				} else if (password == "") {
					$("#pesan").html(Swal.fire('Ooops!', 'Password tidak boleh kosong!', 'error'));
				} else if (password2 == "") {
					$("#pesan").html(Swal.fire('Ooops!', 'Konfirmasi Password tidak boleh kosong!', 'error'));
				} else if (password != password2) {
					$("#pesan").html(Swal.fire('Ooops!', 'Password tidak sama!', 'error'));
				} else {
					document.getElementById('form').onsubmit = false;
				}
			})
		});
	</script>
</body>
</html>