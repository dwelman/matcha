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
	<?php
		session_start();
		if ($_SESSION['logged_on_user'] == "")
			header("Location : index.php");
	?>
	<div class="container" style="padding-top: 60px;">
		<h1 class="page-header">Edit Profile ~ <?php echo $_SESSION['logged_on_user'];?></h1>

		<div id="row" class="row">
			<!-- left column -->
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="text-center">
					<img src="site_images/ppic.jpg" class="avatar img-circle img-thumbnail" alt="avatar">
					<h6>Upload a photo...</h6>
					<form>
						<input type="file" class="text-center center-block well well-sm">

					</form>
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
							<input class="form-control" value="" type="text" id="firstname" onfocus="" maxlength="24">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">Last name</label>
						<div class="col-lg-8">
							<input class="form-control" value="" type="text" id="lastname" maxlength="24">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">Email</label>
						<div class="col-lg-8">
							<input class="form-control" value="ex@email.com" type="text" placeholder="example@email.com" id="email" maxlength="128">
						</div>
					</div>

					<div class="form-group">
						<a class="cpass" href="#" data-toggle="modal" data-target="#login-modal">Change Password</a>
					</div>
					<h3>Profile Info</h3>
					<div class="form-group">
						<label class="col-lg-3 control-label">Gender</label>
						<div class="col-lg-8">
							<div class="funkyradio">
								<div class="funkyradio-primary">
									<input type="radio" name="radio" id="genmale"/>
									<label for="genmale">Male</label>
								</div>
								<div class="funkyradio-primary">
									<input type="radio" name="radio" id="genfem"/>
									<label for="genfem">Female</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">Gender preference</label>
						<div class="col-lg-8">
							<div class="funkyradio">
								<div class="funkyradio-primary">
									<input type="checkbox" name="checkbox" id="prefm"/>
									<label for="prefm">Male</label>
								</div>
								<div class="funkyradio-primary">
									<input type="checkbox" name="checkbox" id="preffem"/>
									<label for="preffem">Female</label>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Bio</label>
						<div class="col-md-8">
							<textarea class="form-control" rows="3" placeholder="Tell people about you" maxlength="255" id="bio"></textarea>
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

	<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="loginmodal-container">
				<h1>Change Password</h1><br>
				<form>
					<input class="passfield" type="password" name="oldpass" placeholder="old password">
					<input class="passfield" type="password" name="newpass" placeholder="new password">
					<input class="passfield" type="password" name="confnewpass" placeholder="confirm new password">
					<input  type="submit" name="login" class="login loginmodal-submit" value="Change">
				</form>
			</div>
		</div>
	</div>
	</body>
	<script type="text/javascript" src="js/profileCheck.js"></script>
	<script type="text/javascript" src="js/getUserData.js"></script>
</html>