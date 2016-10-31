<!doctype HTML>
<html>
	<head>
		<title>Matcha</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/modalLogin.css" rel="stylesheet">
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</head>
	<body>
		<?php
			session_start();
			$_SESSION["logged_on_user"] = "";
		?>
		<div class="site-wrapper">
			<div class="site-wrapper-inner">
				<div class="cover-container">
					<div class="masthead clearfix">
            			<div class="inner">
              				<h3 class="masthead-brand">Matcha</h3>
              				<nav>
                				<ul class="nav masthead-nav">
                  					<li><a href="#" data-toggle="modal" data-target="#register-modal">Register</a></li>
                  					<li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a></li>
                				</ul>
              				</nav>
            			</div>
          			</div>

          			<div class="inner cover">
            			<h1 class="cover-heading">Come meet your match</h1>
            				<p class="lead">Matcha is a dating site like no other, come and meet your soulmate today</p>
            				
          			</div>

          			<div class="mastfoot">
            			<div class="inner">
              				<p>Matcha by daviwel and ddu-toit 2016</p>
            			</div>
          			</div>
        		</div>
      		</div>
   		</div>

	<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="loginmodal-container">
				<h1 class="loginHead">Login to Your Account</h1><br>
				<form method="POST" action="src/loginUser.php">
					<input type="text" name="username" placeholder="Username">
					<input type="password" name="password" placeholder="Password">
					<input type="submit" name="submit" class="login loginmodal-submit" value="Login">
				</form>
	
				<div class="login-help">
					<a href="#" data-dismiss="modal" data-toggle="modal" data-target="#register-modal">Register</a> - <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#forgot-modal">Forgot Password</a>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="loginmodal-container">
				<h1 class="loginHead">Find your match today</h1>
				<h4 class="loginHead">Register</h4><br>
				<form class="loginHead" name="registerForm" id="registerForm" method="POST" action="src/registerUser.php">
					<input class="input_box" id="username" name="username" type="text" placeholder="Username" required><br>
					<input name="name" type="text" placeholder="First name" required><br>
					<input name="surname" type="text" placeholder="Last name" required><br>
					<input name="age" type="text" placeholder="Age" required><br>
					<input name="password" type="password" placeholder="Password" required><br>
					<input name="confpsw" type="password" placeholder="Confirm password" required><br>
					<input name="email" type="text" placeholder="Email address" required><br>
					<label>And I am a</label><br>
					<input name="gender" type="radio" value="M">Man &bull; 
					<input name="gender" type="radio" value="F">Woman<br>
					<label>Looking for a</label><br>
					<input name="preference" type="radio" value="M">Man &bull;  
					<input name="preference" type="radio" value="F">Woman &bull; 
					<input name="preference" type="radio" value="B">Either<br>
					<input type="submit" name="submit" class="login loginmodal-submit" value="Register">
					</form>

					<div class="login-help">
					<a href="#" data-dismiss="modal" data-toggle="modal" data-target="#login-modal">Login</a>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="forgot-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="loginmodal-container">
				<h1 class="loginHead">Forgot your password?</h1><br>
				<form method="POST" action="src/sendPasswordEmail.php">
					<input type="text" name="username" placeholder="Username">
					<input type="submit" name="submit" class="login loginmodal-submit" value="Send">
				</form>
			</div>
		</div>
	</div>

	</body>
</html>