<!doctype HTML>
<html>
	<head>
		<title>Matcha</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/modalLogin.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/cardStyle.css" rel="stylesheet">
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</head>
	<body>
	<?php
		session_start();
		if ($_SESSION["logged_on_user"] == "")
		{
			header("Location: index.php");
			return ;
		}
	?>

	<!-- Fixed navbar -->
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
            <li><a href="editProfile.php">Profile</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#" data-dismiss="modal" data-toggle="modal" data-target="#change-modal">Change Password</a></li>
			<li><a href="index.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <?php
          include "config/connect.php";
          session_start();

          $pdo = connect();
					$minMatchingInterests = 1;
	  	    $sql = $pdo->query("USE db_matcha");
					$stmt = $pdo->prepare("SELECT interest FROM user_interests WHERE user = :user");
					$stmt->bindParam(":user", $_SESSION["logged_on_user"]);
					$stmt->execute();
					while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	        {
							$interests[] = $row["interest"];
					}
		      $stmt = $pdo->prepare("SELECT preference FROM users WHERE username = :name");
		      $stmt->bindParam(':name', $_SESSION["logged_on_user"]);
		      $stmt->execute();
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          if ($row["preference"] == "B")
          {
              $stmt = $pdo->prepare("SELECT * FROM users WHERE username != :name");
              $stmt->bindParam(':name', $_SESSION["logged_on_user"]);
          }
          else
          {
              $stmt = $pdo->prepare("SELECT * FROM users WHERE gender = :prefer AND username != :name");
              $stmt->bindParam(':prefer', $row["preference"]);
              $stmt->bindParam(':name', $_SESSION["logged_on_user"]);
          }
          $stmt->execute();
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	        {
							$matchingInterests = 0;
							$stmt2 = $pdo->prepare("SELECT interest FROM user_interests WHERE user = :user");
							$stmt2->bindParam(":user", $row["username"]);
							$stmt2->execute();
							while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
							{
									foreach ($interests as $interest)
									{
											if ($interest === $row2["interest"])
												$matchingInterests++;
									}
							}
							if ($matchingInterests >= $minMatchingInterests)
							{
								echo '<div class="jumbotron">';
								echo '<h1>' . $row["name"] . ' ' . $row["surname"] . '</h1>';
								echo '<p><a class="btn btn-lg btn-primary" href="userProfile.php?user=' . $row["username"] . '" role="button">View profile &raquo;</a>
							</p>';
								echo '</div>';
							}
          }
          $pdo = NULL;
      ?>
    </div> <!-- /container -->

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

	<?php
		$ip = $_SERVER['REMOTE_ADDR'];
		echo $ip;
		echo "<br>";
		echo gethostbyaddr($ip);
	?>

	</body>
</html>