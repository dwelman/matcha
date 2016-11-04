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
	<link href="css/chat.css" rel="stylesheet">
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

				<li class="dropdown">
					<a id="notiflink" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Notifications <span class="caret"></span></a>
					<ul class="dropdown-menu" id="notifdrop">
					</ul>
				</li>

				<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">History <span class="caret"></span></a>
                <ul class="dropdown-menu">
				<?php
					include_once "config/connect.php";
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
					$pdo = NULL;
				?>
                </ul>
              </li>

				<li><a onclick="chatClick()" href="#" data-dismiss="modal" data-toggle="modal" data-target="#chat-modal" id="chat_link">Chat</a> </li>
				<li><a href="#" data-dismiss="modal" data-toggle="modal" data-target="#change-modal">Change Password</a></li>
				<li><a href="index.php">Logout</a></li>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</nav>

<div class="container" style="padding-top: 60px;">
	<h1 class="page-header">
		<?php
		//include("config/connect.php");
		include("src/getImageData.php");
		session_start();

		$pdo = connect();
		$sql = $pdo->query("USE db_matcha");
		$stmt = $pdo->prepare("SELECT username FROM users WHERE username = :name");
		$stmt->bindParam(':name', $_GET["user"]);
		$stmt->execute();
		if ($stmt->rowCount() != 1)
		{
			header("Location: memberLanding.php?error=1");
			return ;
		}
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$stmt = $pdo->prepare("SELECT * FROM blocks WHERE (user = :user AND blocked_user = :blocked_user)
				OR (user = :blocked_user AND blocked_user = :user)");
		$stmt->bindParam(":blocked_user", $_GET["user"]);
		$stmt->bindParam(":user", $_SESSION["logged_on_user"]);
		$stmt->execute();
		if ($stmt->rowCount() > 0)
		{
			header("Location: memberLanding.php");
			return ;
		}
		$stmt = $pdo->prepare("INSERT INTO notifications (user, message, link)
				VALUES (:user, :message, :link)");
		$stmt->bindParam(":user", $_GET["user"]);
		$message = $_SESSION["logged_on_user"] . " has viewed your profile!";
		$stmt->bindParam(":message", $message);
		$link = '<a href="userProfile.php?user=' . $_SESSION["logged_on_user"] . '">';
		$stmt->bindParam(":link", $link);
		$stmt->execute();
		$stmt = $pdo->prepare("INSERT INTO view_history (user, user_viewed)
				VALUES (:user, :user_viewed)");
		$stmt->bindParam(":user", $_SESSION["logged_on_user"]);
		$stmt->bindParam(':user_viewed', $_GET["user"]);
		$stmt->execute();
		$stmt = $pdo->prepare("UPDATE users SET fame = fame + 1 WHERE username = :name");
		$stmt->bindParam(':name', $_GET["user"]);
		$stmt->execute();

		echo $row["username"];
		?>'s Profile - 
		<?php
			$stmt2 = $pdo->prepare("SELECT last_online FROM users WHERE username = :name");
			$stmt2->bindParam(':name', $_GET["user"]);
			$stmt2->execute();
			$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
			date_default_timezone_set("Africa/Johannesburg");
			if (time() - strtotime($row2["last_online"]) > 60)
			{
				echo "last online " . date("d F H:i", strtotime($row2["last_online"]));
			}
			else
				echo "online ";
			$stmt = $pdo->prepare("SELECT image_path FROM images WHERE user = :name AND is_main = 'N'");

			$stmt->bindParam(':name', $_GET["user"]);
			$stmt->execute();
			while ($img = $stmt->fetch(PDO::FETCH_COLUMN))
				$imgs[] = $img;
			$stmt = $pdo->prepare("SELECT image_path FROM images WHERE user = :name AND is_main = 'Y'");
			$stmt->bindParam(':name', $_GET["user"]);
			$stmt->execute();
			$profile = $stmt->fetch(PDO::FETCH_COLUMN);
		?>
		</h1>
	<div id="row" class="row">
		<!-- left column -->
		<div class="text-center">
			<a data-toggle='modal' data-target='#modalimg'>
				<img id="profile_pic" src="<?php echo $profile?>" class="avatar img-circle img-thumbnail"
					 alt="avatar" style="width: 50%" onclick="<?php echo "setModal('" . $profile . "', 0)";?>">
			</a>
			<br>
			<br>
			<?php
				$data = getImageData($_SESSION['logged_on_user']);
				if (count($profile) != 1)
					echo "This user cannot recieve likes since they do not have any photos!";
				if (count($data) <= 0)
				echo "You cannot like anyone since you do not have any photos!";
				if (count($profile) == 1 && count($data) > 0)
					echo "<a id=\"likebtn\" href=\"#\" class=\"btn btn-lg btn-primary\" onclick=\"likeUser()\">
					<span class=\"glyphicon glyphicon-thumbs-up\"></span> Like</a>";
			?>
			<a id="blkbtn" data-toggle="modal" data-target="#blockModal" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-ban-circle"></span> Block</a>
			<a id="blkbtn" data-toggle="modal" data-target="#reportModal" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-bullhorn"></span> Report</a>
		</div>
		<br>
		<div class="row">
			<?php
			foreach ($imgs as $img)
			{
				echo "<div class='col-xs-6 col-md-3'>" .
					"<a class='thumbnail' data-toggle='modal' data-target='#modalimg'" .
					"onclick= 'setModal(\"$img\", 0)'>" .
					"<img src='$img' alt=''>" .
					"</a></div>";
			}
			?>
		</div>

		<?php
		$sql = $pdo->query("USE db_matcha");
		$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :name");
		$stmt->bindParam(':name', $_GET["user"]);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		?>
		<h3 id="pi">Bio</h3>
		<?php echo '<p>' . $row["bio"] . '</p>';?>

		<h3 id="pi">Personal info</h3>
		<?php
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

<div id="modalimg" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<img id="modalsrc" src="" class="img-responsive">
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="blockModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="loginmodal-container">
			<h1 class="loginHead">Block User</h1><br>
			<p class="loginHead">Are you sure? If you block this user you will no longer be able to access their profile, and they will not be able to access yours</p>
			<p class="loginHead">This is permanent</p>
			<form method="POST" action="src/blockUser.php">
				<?php
				session_start();
				echo '<input type="hidden" name="user" value="' . $_GET["user"] . '">';
				?>
				<button class="btn btn-lg btn-primary btn-block" name="submit" type="submit" value="submit">Block</button>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="loginmodal-container">
				<h1 class="loginHead">Report User</h1><br>
				<p class="loginHead">Are you sure? Reporting a user will also block them</p>
				<p class="loginHead">This is permanent</p>
				<form method="POST" action="src/reportUser.php">
					<?php
						session_start();
						echo '<input type="hidden" name="user" value="' . $_GET["user"] . '">';
					?>
					<input type="text" name="report" placeholder="Reason for report">
					<button class="btn btn-lg btn-primary btn-block" name="submit" type="submit" value="submit">Report</button>
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

<script type="text/javascript" src="js/getUserData.js"></script>
<script type="text/javascript" src="js/like.js"></script>
<script src="js/checkOnline.js"></script>
<script src="js/getChat.js"></script>

</html>