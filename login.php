<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8"/>
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
		<link rel="stylesheet" type="text/css" href="css/theme.css">
		<link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
		<style>
			body {
				background-image: url("burj.jpg");
				 background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center; 
			}
		</style>
	</head>
	
	<body>	
		<nav class="navbar navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand">SILUTEL</a>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="active"><a href="login.html"><span class="glyphicon glyphicon-log-in"></span> Login Form<span class="sr-only">(current)</span></a></li>																	
					</ul>
				</div>
			</div>
		</nav>
		
		<form>
			<div class="panel panel-success" style="margin:auto;margin-top:150px;width:35%;opacity:.97">
				<div class="panel-heading" style="text-align:center"><h4>Login Form</h4></div>

				<div class="panel-body">
					<div class="form-group">
						<label for="inputUsername3" class="col-sm-2 control-label" style="padding:5px;">Username </label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="inputUsername3" name="username" placeholder="Username">
						</div>
					</div>
					<div class="form-group" style="margin-top: 50px;">
						<label for="inputPassword3" class="col-sm-2 control-label" style="padding:5px;">Password </label>
						<div class="col-sm-10">
							<input type="password" class="form-control" id="inputPassword3" name="password" placeholder="Password">
						</div>
					</div>
					<div class="form-group" style="margin-top:-30px">
						<div class="col-sm-offset-2 col-sm-10">
							<input href="home.html" type="submit" id="buttonLogin" class="btn btn-default" id="login" style="margin-top: 15px;" value="Log in">
						</div>
					</div>
				</div>
			</div>
		</form>
	</body>
	
	
	<script src="bootstrap/js/bootstrap.min.js"></script>
</html>