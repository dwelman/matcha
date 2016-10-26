<!doctype HTML>
<html>
<head>
	<title>Matcha</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/funkyradio.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="container" style="padding-top: 60px;">
	<div class="page-header">
		<h1>Firstname von Lastname  <small> ~username</small></h1>
	</div>
	<div class="row">
		<!-- left column -->
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="text-center">
				<img src="site_images/ppic.jpg" class="avatar img-circle img-thumbnail" alt="avatar">
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
		<div class="col-md-8 col-sm-6 col-xs-12 personal-info">

			<form class="form-horizontal" role="form">
				<h3>Profile Info</h3>
				<div class="form-group">
					<label class="col-lg-3 control-label">Gender</label>
					<div class="col-lg-8">
						<div class="funkyradio">
							<div class="funkyradio-primary">
								<input type="radio" name="radio" id="radio1"/>
								<label for="radio1">Male</label>
							</div>
							<div class="funkyradio-primary">
								<input type="radio" name="radio" id="radio2"/>
								<label for="radio2">Female</label>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label">Gender preference</label>
					<div class="col-lg-8">
						<div class="funkyradio">
							<div class="funkyradio-primary">
								<input type="checkbox" name="checkbox" id="checkbox1" checked/>
								<label for="checkbox1">Male</label>
							</div>
							<div class="funkyradio-primary">
								<input type="checkbox" name="checkbox" id="checkbox2" checked/>
								<label for="checkbox2">Female</label>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label"></label>
					<div class="col-md-8">
						<input class="btn btn-primary" value="Save Changes" type="button">
						<span></span>
						<input class="btn btn-default" value="Cancel" type="reset">
					</div>
				</div>

		</div>
		</form>
	</div>
</div>
</div>

</body>
</html>