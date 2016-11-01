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
		<link href="css/cardStyle.css" rel="stylesheet">
		<link href="css/alert.css" rel="stylesheet">
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
	 <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="navbar-brand">Matcha</div>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="memberLanding.php">Home</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
		  	<li><a href="#" data-dismiss="modal" data-toggle="modal" data-target="#change-modal">Change Password</a></li>
			<li><a href="index.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

	<div class="container" style="padding-top: 60px;">
		<h1 class="page-header">Edit Profile ~ <?php echo $_SESSION['logged_on_user'];?></h1>

		<div id="row" class="row">
			<!-- left column -->
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="text-center">
					<a href="#" class="thumbnail" data-toggle="modal" data-target="#modalimg">
					<img id="profile_pic" src="site_images/ppic.jpg" class="avatar img-circle img-thumbnail" alt="avatar">
						</a>
					<h6 id="img_stat">Upload a photo...</h6>
					<form id="image_upload_form" enctype="multipart/form-data" method="post">
						<input type="file" class="text-center center-block well well-sm" id="image1">
						<input type="button" value="Upload Photo" onclick="userUpload()">
						<progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
						<h3 id="status"></h3>
					</form>
				</div>
				<br>

				<div class="row">
					<div class="col-s-6 col-md-3">
						<a href="#" class="thumbnail" data-toggle="modal" data-target="#modalimg" >
							<img src="" alt="" id="img1" >
						</a>
					</div>
					<div class="col-s-6 col-md-3">
						<a href="#" class="thumbnail" data-toggle="modal" data-target="#modalimg">
							<img src="" alt="" id="img2">
						</a>
					</div>
					<div class="col-s-6 col-md-3">
						<a href="#" class="thumbnail" data-toggle="modal" data-target="#modalimg">
							<img src="" alt="" id="img3">
						</a>
					</div>
					<div class="col-s-6 col-md-3">
						<a href="#" class="thumbnail" data-toggle="modal" data-target="#modalimg">
							<img src="" alt="" id="img4">
						</a>
					</div>
					<div id="modalimg" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-body">
									<img id="modalsrc" src="" class="img-responsive">
									<button id="delete" type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modalimg">Delete</button>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<!-- edit form column -->
			<div id="personal" class="col-md-8 col-sm-6 col-xs-12 personal-info">

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
						<label class="col-lg-3 control-label">Age</label>
						<div class="col-lg-8">
							<input class="form-control" value="" type="text" id="age" maxlength="24">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">Email</label>
						<div class="col-lg-8">
							<input class="form-control" value="ex@email.com" type="text" placeholder="example@email.com" id="email" maxlength="128">
						</div>
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
						<div class="col-lg-3">
						<input class="btn btn-primary" value="Add Interest" type="button" onclick="verifyInterest(10)">
					</div>
						<div class="col-lg-8">
							<input class="form-control" value="" type="text" id="interest" onfocus="" maxlength="24">
						</div>
					</div>
					<br>
					<div class="container">
					</div>
					<div id="interest_div" class="row">

						<div id="place"></div>
						<?php
/*
							include("config/connect.php");
							session_start();

							if ($_SESSION["logged_on_user"] == "")
							{
								die("ERROR: NOT LOGGED ON");
							}
							$pdo = connect();
							$sql = $pdo->query("USE db_matcha");
							$stmt = $pdo->prepare("SELECT interest FROM user_interests WHERE user = :name");
							$stmt->bindParam(':name', $_SESSION["logged_on_user"]);
							$stmt->execute();
							while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
							{
								echo '<div class="col-xs-4">';
								echo '<div class="alert alert-info alert-dismissable" role="alert">';
								echo '<p class="alert-title">' . $row["interest"] . '</p>';
								echo '</div>';
								echo '</div>';
							}
							$pdo = NULL;
*/						?>

						<!--
						<div class="col-xs-4">
						<div class="alert alert-info alert-dismissable" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="color: white;">×</span></button>
							<p class="alert-title">Pernus</p>
						</div>
						</div>
						
						<div class="col-xs-4">
						<div class="alert alert-info alert-dismissable" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="color: white;">×</span></button>
							<p class="alert-title">Also Pernus</p>
						</div>
						</div>

						<div class="col-xs-4">
						<div class="alert alert-info alert-dismissable" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="color: white;">×</span></button>
							<p class="alert-title">Pernus Indeed</p>
						</div>
						</div>
						-->
					</div>
						</div>
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
				</form>
			</div>

			</div>
		</div>
	</div>

		<div class="modal fade" id="change-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="loginmodal-container">
				<h1 class="loginHead">Change Password</h1><br>
				<form method="POST" action="src/changeUserPassword.php">
					<input type="password" name="password" placeholder="New Password">
					<input type="password" name="confpsw" placeholder="Confirm New Password">
					<?php
						session_start();
						echo '<input type="hidden" name="user" value="' . hash("whirlpool", $_SESSION["logged_on_user"]) . '">';
					?>
					<button class="btn btn-lg btn-primary btn-block" name="submit" type="submit" value="submit">Change Password</button>
				</form>
			</div>
		</div>
	</div>

	</div>
	</body>
	<script type="text/javascript" src="js/upload.js"></script>
	<script type="text/javascript" src="js/profileCheck.js"></script>
	<script type="text/javascript" src="js/getUserData.js"></script>
	<script type="text/javascript" src="js/addInterest.js"></script>
	<script>
		getUserData();
	</script>
</html>