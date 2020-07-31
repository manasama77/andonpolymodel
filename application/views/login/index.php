<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="<?=base_url();?>vendor/bootstrap4/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url();?>vendor/font-awesome/css/font-awesome.min.css">
	<title>Login</title>
	<style>
		body {
			font-family: "Lato", sans-serif;
		}



		.main-head{
			height: 150px;
			background: #FFF;

		}

		.sidenav {
			height: 100%;
			background-color: #000;
			overflow-x: hidden;
			padding-top: 20px;
		}


		.main {
			padding: 0px 10px;
		}

		@media screen and (max-height: 450px) {
			.sidenav {padding-top: 15px;}
		}

		@media screen and (max-width: 450px) {
			.login-form{
				margin-top: 10%;
			}

			.register-form{
				margin-top: 10%;
			}
		}

		@media screen and (min-width: 768px){
			.main{
				margin-left: 40%; 
			}

			.sidenav{
				width: 40%;
				position: fixed;
				z-index: 1;
				top: 0;
				left: 0;
			}

			.login-form{
				margin-top: 80%;
			}

			.register-form{
				margin-top: 20%;
			}
		}


		.login-main-text{
			margin-top: 20%;
			padding: 60px;
			color: #fff;
		}

		.login-main-text h2{
			font-weight: 300;
		}

		.btn-black{
			background-color: #000 !important;
			color: #fff;
		}
	</style>
</head>
<body>
	<div class="sidenav">
		<div class="login-main-text">
			<h2>Andon<br> Login Page</h2>
			<p>Login from here to access.</p>
			<p><small>Version <?=VERSION_APP;?></small></p>
		</div>
	</div>
	<div class="main">
		<div class="col-md-6 col-sm-12">
			<div class="login-form">
				<form action="<?=site_url();?>" method="post">
					<div class="form-group">
						<label for="">User Name</label>
						<input type="text" id="username" name="username" class="form-control" placeholder="User Name">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" id="password" name="password" class="form-control" placeholder="Password">
					</div>
					<div class="form-group">
						<label>
							<input type="checkbox" id="remember" name="remember" value="on"> Remember Me
						</label>
					</div>
					<button type="submit" class="btn btn-black btn-block">Login</button>
				</form>
			</div>
		</div>
	</div>
	
	<script src="<?=base_url();?>vendor/jquery/jquery-3.5.1.min.js"></script>
	<script src="<?=base_url();?>vendor/popper/popper.min.js"></script>
	<script src="<?=base_url();?>vendor/bootstrap4/js/bootstrap.bundle.min.js"></script>
	<script src="<?=base_url();?>vendor/momentjs/moment.js"></script>
	<script src="<?=base_url();?>vendor/blockuijs/jquery.blockUI.js"></script>
</body>
</html>