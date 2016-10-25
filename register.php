<!doctype HTML>
<html>
	<head>
		<title>Matcha</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
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
										<li><a href="index.php">Home</a></li>
										<li class="active"><a href="#">Register</a></li>
										<li><a href="login.php">Login</a></li>
									</ul>
								</nav>
							</div>
						</div>

<!--
						<div class="inner cover">
							<h1 class="cover-heading">Come meet your match</h1>
								<p class="lead">Matcha is a dating site like no other, come and meet your soulmate today</p>
								<p class="lead">
									<a href="#" class="btn btn-lg btn-default">Register Now</a>
								</p>
						</div>
-->
							<h1 class="cover-heading">Register Today</h1>
								<form name="registerForm" id="registerForm" method="POST">
								<input id="username" name="username" type="text" placeholder="Username" required><br>
								<input id="name" name="name" type="text" placeholder="First name" required><br>
								<input id="surname" name="surname" type="text" placeholder="Last name" required><br>
								<input id="password" name="password" type="text" placeholder="Password" required><br>
								<input id="confpsw" name="confpsw" type="text" placeholder="Confirm password" required><br>
								<input id="email" name="email" type="text" placeholder="Email address" required><br>
								<label>And I am a</label><br>
								<input id="gender" name="gender" type="radio" value="M">Man
								<input id="gender" name="gender" type="radio" value="F">Woman<br>
								<label>Looking for a</lbale><br>
								<input id="preference" name="preference" type="radio" value="M">Man
								<input id="preference" name="preference" type="radio" value="F">Woman
								<input id="preference" name="preference" type="radio" value="B">Either
								</form>
						<div class="mastfoot">
							<div class="inner">
								<p>Matcha by daviwel and ddu-toit 2016</p>
							</div>
						</div>
					</div>
				</div>
			</div>
	</body>
</html>