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
		<div class="site-wrapper">
			<div class="site-wrapper-inner">
				<div class="cover-container">
					<div class="masthead clearfix">
            			<div class="inner">
              				<h3 class="masthead-brand">Matcha</h3>
              				<nav>
                				<ul class="nav masthead-nav">
                  					<li class="active"><a href="#">Home</a></li>
                  					<li><a href="register.php">Register</a></li>
                  					<li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a></li>
                				</ul>
              				</nav>
            			</div>
          			</div>

          			<div class="inner cover">
            			<h1 class="cover-heading">Come meet your match</h1>
            				<p class="lead">Matcha is a dating site like no other, come and meet your soulmate today</p>
            				<p class="lead">
              					<a href="#" class="btn btn-lg btn-default">Register Now</a>
            				</p>
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
					<input type="text" name="user" placeholder="Username">
					<input type="password" name="pass" placeholder="Password">
					<input type="submit" name="submit" class="login loginmodal-submit" value="Login">
				</form>
	
				<div class="login-help">
					<a href="register.php">Register</a> - <a href="#" data-toggle="modal" data-target="#forgot-modal">Forgot Password</a>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="forgot-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="loginmodal-container">
				<h1 class="loginHead">Forgot your password?</h1><br>
				<form method="POST" action="src/sendPasswordLink.php">
					<input type="text" name="email" placeholder="Email Address">
					<input type="submit" name="submit" class="login loginmodal-submit" value="Send">
				</form>
			</div>
		</div>
	</div>

	</body>
</html>