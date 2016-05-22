<?php
	session_start();
	if(isset($_SESSION["userlogin"])){
		require "db/connect.php";
		pindahPage($_SESSION["userlogin"]);
	}
	
	require "db/connect.php";
	
	$resp = "";
	if(isset($_POST["username"])){
		if(checkUsername($_POST["username"])) {
			if(isset($_POST["password"]) && checkPassword(($_POST["username"]),$_POST["password"])) {

				pindahPage($_POST["username"]);
				$_SESSION["userlogin"] = $_POST["username"];
				$user = $_SESSION["userlogin"];
				$result = queryDB("SELECT * FROM silutel.user WHERE Email='$user'");
				$row = pg_fetch_row($result);
				$_SESSION["userid"] = $row[2];
		
			}else{
				$resp = "Password Tidak Valid!";
			}
		}else{
			$resp = "Username Tidak Valid";
		}
	}
	
	function checkUsername($user){
		$result = queryDB("SELECT * FROM silutel.USER U WHERE U.Email ='$user' ");
		
		if(pg_num_rows($result) > 0) {
			pg_close();
			return true;
		} else {
			pg_close();
			return false;
		}
		
		pg_close();
		return false;
	}
	
	function checkPassword($user, $pass){		
		$result = queryDB("SELECT * FROM silutel.USER WHERE Email='$user' AND password='$pass'");

		$row = pg_fetch_row($result);
		
		if(pg_num_rows($result) > 0) {
			pg_close();
			return true;
		} else {
			pg_close();
			return false;
		}
		
		pg_close();
		return false;
	}

	function pindahPage($user) {
		$result = queryDB("SELECT * FROM silutel.USER U WHERE U.Email ='$user'");
		$row = pg_fetch_row($result);
		$job = $row[4];
		if($job === "MG") {
			header("Location: lihat-booking.php");
			session_start();
		} else if ($job === "IN") {
			header("Location: lihat-inventori.php");
			session_start();
		} else if ($job === "LA") {
			header("Location: lihat-laundry.php");
			session_start();
		}
	}
?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8"/>
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/theme.css">
		<link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
	
	</head>
	
	<body style='background-image: url("burj.jpg") !important;'>	
	<nav class="navbar navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">SILUTEL</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="active"><a>LOGIN<span class="sr-only">(current)</span></a></li>
				</ul>
			</div>
		</div>
	</nav>
		
		<form method="POST" action="login.php">
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
					<div class="form-group">
						<label for="respon3" style="padding:15px; color:red;"><?php echo $resp; ?></label>
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
</html>