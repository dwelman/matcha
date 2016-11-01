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
		<h1 class="page-header">
		<?php
			include("config/connect.php"); 

			$pdo = connect();
			$sql = $pdo->query("USE db_matcha");
			$stmt = $pdo->prepare("UPDATE users SET fame = fame + 1 WHERE username = :name");
			$stmt->bindParam(':name', $_GET["user"]);
			$stmt->execute();
			$stmt = $pdo->prepare("SELECT username FROM users WHERE username = :name");
			$stmt->bindParam(':name', $_GET["user"]);
			$stmt->execute();
			if ($stmt->rowCount() != 1)
			{
				header("Location: memberLanding.php?error=1");
				return ;
			}
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			echo $row["username"];
		?>'s Profile</h1>

		<div id="row" class="row">
			<!-- left column -->
				<div class="text-center">
					<img id="profile_pic" src="site_images/ppic.jpg" class="avatar img-circle img-thumbnail" alt="avatar">
				</div>
				<br>

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

				<h3 id="pi">Personal info</h3>
				
				<?php
					$sql = $pdo->query("USE db_matcha");
					$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :name");
					$stmt->bindParam(':name', $_GET["user"]);
					$stmt->execute();
					$row = $stmt->fetch(PDO::FETCH_ASSOC);
					echo '<p>Name: ' . $row["name"] . '</p>';
					echo '<p>Surname: ' . $row["surname"] . '</p>';
					echo '<p>Age: ' . $row["age"] . '</p>';
					echo '<p>Gender: ' . $row["gender"] . '</p>';
					echo '<p>Preference: ' . $row["preference"] . '</p>';
					echo '<h3>Interests</h3>'
				?>
					
					<div class="container">
					</div>
					<div class="row">
						<?php
							$sql = $pdo->query("USE db_matcha");
							$stmt = $pdo->prepare("SELECT interest FROM user_interests WHERE user = :name");
							$stmt->bindParam(':name', $_GET["user"]);
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
						?>
					</div>		
						</div>
					</div>
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

	<script type="text/javascript" src="js/profileCheck.js"></script>
	<script type="text/javascript" src="js/getUserData.js"></script>
	<script type="text/javascript" src="js/upload.js"></script>
</html>