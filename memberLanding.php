<!doctype HTML>
<html>
	<head>
		<title>Matcha</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/modalLogin.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/chat.css" rel="stylesheet">
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
						<li><a href="#" data-toggle="modal" data-target="#filter-modal">Filters</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">

			  <li class="dropdown">
				  <a id="notiflink" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Notifications <span class="caret"></span></a>
				  <ul class="dropdown-menu" id="notifdrop">
				  </ul>
			  </li>

		  		<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">History <span class="caret"></span></a>
                <ul class="dropdown-menu">
				<?php
					include "config/connect.php";
					include "classes/User.class.php";
        			session_start();
					$pdo = connect();
					$sql = $pdo->query("USE db_matcha");
					$stmt = $pdo->prepare("SELECT user_viewed FROM view_history
							WHERE user = :user
							ORDER BY time_viewed DESC
							LIMIT 10");
					$stmt->bindParam(":user", $_SESSION["logged_on_user"]);
					$stmt->execute();
					while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
					{
						$stmt2 = $pdo->prepare("SELECT name, surname FROM users
								WHERE username = :user");
						$stmt2->bindParam(":user", $row["user_viewed"]);
						$stmt2->execute();
						$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
						echo '<li><a href="userProfile.php?user=' . $row["user_viewed"] . '">' . $row2["name"] . " " . $row2["surname"] . '</a></li>';
					}
					
				?>
                </ul>
              </li>
			  <li><a onclick="chatClick()" href="#" data-dismiss="modal" data-toggle="modal" data-target="#chat-modal" id="chat_link">Chat</a> </li>
			  <li><a href="#" data-dismiss="modal" data-toggle="modal" data-target="#change-modal">Change Password</a></li>
			  <li><a href="index.php">Logout</a>

		  </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <?php
		$minMatchingInterests = intval($_POST["minInter"]);
		$bUseMatchingInterests = ($_POST["minInter"] == NULL ? false : true);

		$lowerAge = intval($_POST["lowerAge"]);
		$upperAge = intval($_POST["upperAge"]);
		$bUseAgeRange = (($_POST["lowerAge"] != NULL && $_POST["upperAge"] != NULL) ? true : false);

		$lowerFame = intval($_POST["lowerFame"]);
		$upperFame = intval($_POST["upperFame"]);
		$bUseFameRange = (($_POST["lowerFame"] != NULL && $_POST["upperFame"] != NULL) ? true : false);

		$tagString = $_POST["interTags"];
		$bUseTags = ($_POST["interTags"] == NULL ? false : true);

		if ($bUseTags == true)
		{
			$tagArray = explode("#", $tagString);
		}

		$users = array();
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

			$stmt3 = $pdo->prepare("SELECT * FROM blocks WHERE (user = :user AND blocked_user = :blocked_user)
					OR (user = :blocked_user AND blocked_user = :user)");
			$stmt3->bindParam(":blocked_user", $row["username"]);
			$stmt3->bindParam(":user", $_SESSION["logged_on_user"]);
			$stmt3->execute();
			if ($stmt3->rowCount() > 0)
				continue ;
			$userInterests = array();
			$totalInt = 0;
			$bCanUseProfile = ($bUseTags == true ? false : true);
			while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
			{
					foreach ($interests as $interest)
					{
							if (strtolower($interest) === strtolower($row2["interest"]))
								$matchingInterests++;
							if (!$bCanUseProfile)
							{
									foreach ($tagArray as $tag)
									{
											if (trim(strtolower($tag)) === strtolower($row2["interest"]))
												$bCanUseProfile = true;
									}
							}
					}
					$userInterests[] = $row2["interest"];
					
					$totalInt++;
			}
			if ($matchingInterests >= $minMatchingInterests || !$bUseMatchingInterests)
			{
				if ($row["age"] >= $lowerAge && $row["age"] <= $upperAge || !$bUseAgeRange)
				{
						if ($row["fame"] >= $lowerFame && $row["fame"] <= $upperFame || !$bUseFameRange)
						{
								if ($bCanUseProfile)
								{
									$profileCard = '<div class="jumbotron">
											<h1>' . $row["name"] . ' ' . $row["surname"] . '</h1>
											<p>Fame rating: ' . $row["fame"] . '</p>
											<p><a class="btn btn-lg btn-primary" href="userProfile.php?user=' . $row["username"] . '" role="button">View profile &raquo;</a></p>
											</div>';
									$user = new User($profileCard, $row["age"], $userInterests, $totalInt, $matchingInterests, $row["fame"]);
									//echo $user;
									$users[] = $user;
								}
						}
				}
			}
		}
		function ageCmp($a, $b)
		{
				if ($a->age > $b->age)
					return (1);
				else if ($a->age < $b->age)
					return (-1);
				else
					return (0);
		}

		function fameCmp($a, $b)
		{
				if ($a->fame < $b->fame)
					return (1);
				else if ($a->fame > $b->fame)
					return (-1);
				else
					return (0);
		}

		function interCmp($a, $b)
		{
				if ($a->matchingInterests < $b->matchingInterests)
					return (1);
				else if ($a->matchingInterests > $b->matchingInterests)
					return (-1);
				else
					return (0);
		}

		if ($_POST["sortBy"] === "A")
		{
				usort($users, ageCmp);
		}
		else if ($_POST["sortBy"] === "F")
		{
				usort($users, fameCmp);
		}
		else
		{
				usort($users, interCmp);
		}
		foreach ($users as $user)
		{
			echo $user->profileCard;
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

		<div class="modal fade" id="filter-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog">
				<div class="loginmodal-container">
					<h1 class="loginHead">Filters</h1>
					<h4 class="loginHead">Apply Filters</h4><br>
					<form class="loginHead" name="filterForm" id="filterForm" method="POST" action="memberLanding.php">
						<h5 class="loginHead">Age Range</h5>
						<?php
							echo '<input class="input_box" id="lowerAge" name="lowerAge" type="text" placeholder="Enter a lower age range" value="';
							echo $_POST["lowerAge"];
							echo '"><br>';
							echo '<input class="input_box" id="upperAge" name="upperAge" type="text" placeholder="Enter an upper age range" value="';
							echo $_POST["upperAge"];
							echo '"><br>';
							echo '<h5 class="loginHead">Fame Range</h5>';
							echo '<input class="input_box" id="lowerFame" name="lowerFame" type="text" placeholder="Enter a lower fame range" value="';
							echo $_POST["lowerFame"];
							echo '"><br>';
							echo '<input class="input_box" id="upperFame" name="upperFame" type="text" placeholder="Enter a upper fame range" value="';
							echo $_POST["upperFame"];
							echo '"><br>';
							echo '<h5 class="loginHead">Minimum amount of common interests</h5>';
							echo '<input class="input_box" id="minInter" name="minInter" type="text" placeholder="Minimum common interests" value="';
							echo $_POST["minInter"];
							echo '"><br>';
							echo '<h5 class="loginHead">Filter by interest tags</h5>';
							echo '<input class="input_box" id="interTags" name="interTags" type="text" placeholder="Interest tags, sperate with #" value="';
							echo $_POST["interTags"];
							echo '"><br>';
							echo '<label>Sort by</label><br>';
							echo '<input name="sortBy" type="radio" value="F"';
							if ($_POST["sortBy"] === F)
								echo "checked";
							echo '>Fame Rating &bull;';
							echo '<input name="sortBy" type="radio" value="A"';
							if ($_POST["sortBy"] === A)
								echo "checked";
							echo '>Age &bull;';
							echo '<input name="sortBy" type="radio" value="I"';
							if ($_POST["sortBy"] === I)
								echo "checked";
							echo '>Common Interests<br><br>';
						?>
						<input type="submit" name="submit" class="login loginmodal-submit" value="Apply">
						</form>

				</div>
			</div>
		</div>

	<div id="chat-modal" class="modal modal-wide fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">Chat</h4>
				</div>
				<div class="modal-body" id="chat">
				</div>
				<div class="modal-footer">
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<script src="js/checkOnline.js"></script>
		 <script src="js/getChat.js"></script>
	</body>
</html>