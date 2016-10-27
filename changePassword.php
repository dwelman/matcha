<!doctype HTML>
<html>
	<head>
		<title>Change Password</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/changePass.css" rel="stylesheet">
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</head>
	<body>

		<div class="container">
		<form class="form-signin" method="POST" action="src/changeUserPassword.php">
			<h2 class="form-signin-heading">Change your password</h2>
			<input type="password" id="password" name="password" class="form-control" placeholder="New Password" required autofocus>
			<input type="password" id="confpsw" name="confpsw" class="form-control" placeholder="Confirm New Password" required>
			<?php
				echo '<input type="hidden" name="user" value="' . $_GET["verif"] . '">';
			?>
			<button class="btn btn-lg btn-primary btn-block" name="submit" type="submit" value="submit">Change Password</button>
		</form>

		</div>
	</body>
</html>