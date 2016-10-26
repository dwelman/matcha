<!doctype HTML>
<html>
	<head>
		<title>Matcha</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/funkyradio.css" rel="stylesheet">
		<link href="css/modalLogin.css" rel="stylesheet">
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	</head>
	<body>
	<div class="container" style="padding-top: 60px;">
		<h1 class="page-header">Edit Profile</h1>
		<div id="row" class="row">
			<!-- left column -->
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="text-center">
					<img src="site_images/ppic.jpg" class="avatar img-circle img-thumbnail" alt="avatar">
					<h6>Upload a photo...</h6>
					<input type="file" class="text-center center-block well well-sm">
				</div>
				<div class="row">
					<div class="col-xs-6 col-md-3">
						<a href="#" class="thumbnail">
							<img src="http://lorempixel.com/200/200/people/8/" alt="">
						</a>
					</div>
					<div class="col-xs-6 col-md-3">
						<a href="#" class="thumbnail">
							<img src="http://lorempixel.com/200/200/people/5/" alt="">
						</a>
					</div>
					<div class="col-xs-6 col-md-3">
						<a href="#" class="thumbnail">
							<img src="http://lorempixel.com/200/200/people/1/" alt="">
						</a>
					</div>
					<div class="col-xs-6 col-md-3">
						<a href="#" class="thumbnail">
							<img src="http://lorempixel.com/200/200/people/2/" alt="">
						</a>
					</div>
				</div>
			</div>
			<!-- edit form column -->
			<div id ="personal" class="col-md-8 col-sm-6 col-xs-12 personal-info">

				<h3 id="pi">Personal info</h3>
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<label class="col-lg-3 control-label">First name</label>
						<div class="col-lg-8">
							<input class="form-control" value="Dean" type="text" id="firstname" onfocus="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">Last name</label>
						<div class="col-lg-8">
							<input class="form-control" value="derp" type="text" id="lastname">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">Email</label>
						<div class="col-lg-8">
							<input class="form-control" value="ex@email.com" type="text" placeholder="example@email.com" id="email">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Old Password</label>
						<div class="col-md-8">
							<input class="form-control" value="" type="password">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">New password</label>
						<div class="col-md-8">
							<input class="form-control" value="" type="password">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Confirm new password</label>
						<div class="col-md-8">
							<input class="form-control" value="" type="password">
						</div>
					</div>
					<h3>Profile Info</h3>
					<div class="form-group">
						<label class="col-lg-3 control-label">Gender</label>
						<div class="col-lg-8">
							<div class="funkyradio">
								<div class="funkyradio-primary">
									<input type="radio" name="radio" id="radio1"/>
									<label for="radio1">Male</label>
								</div>
								<div class="funkyradio-primary">
									<input type="radio" name="radio" id="radio2"/>
									<label for="radio2">Female</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">Gender preference</label>
						<div class="col-lg-8">
							<div class="funkyradio">
								<div class="funkyradio-primary">
									<input type="checkbox" name="checkbox" id="checkbox1" checked/>
									<label for="checkbox1">Male</label>
								</div>
								<div class="funkyradio-primary">
									<input type="checkbox" name="checkbox" id="checkbox2" checked/>
									<label for="checkbox2">Female</label>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Bio</label>
						<div class="col-md-8">
							<textarea class="form-control" rows="3" placeholder="Tell people about you" maxlength="255"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-8">
							<input class="btn btn-primary" value="Save Changes" type="button" onclick="verifyDetails(10)">
							<span></span>
							<input class="btn btn-default" value="Cancel" type="reset">
						</div>
					</div>
			</div>
			</form>
			</div>
		</div>
	</div>
	<a href="#" data-toggle="modal" data-target="#login-modal">Login</a>

	<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="loginmodal-container">
				<h1>Login to Your Account</h1><br>
				<form>
					<input type="text" name="user" placeholder="Username">
					<input type="password" name="pass" placeholder="Password">
					<input type="submit" name="login" class="login loginmodal-submit" value="Login">
				</form>

				<div class="login-help">
					<a href="#">Register</a> - <a href="#">Forgot Password</a>
				</div>
			</div>
		</div>
	</div>
	</body>
	<script type="text/javascript" src="js/profileCheck.js"></script>
</html>