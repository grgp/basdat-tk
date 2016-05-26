<?php

  session_start();
  
  if(!isset($_SESSION["userlogin"])){
      header("Location: login.php");
  }

?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8"/>
		<title>Silutel</title>
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
					<li class="active"><a>HOME<span class="sr-only">(current)</span></a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li><span class="sr-only">(current)</span></a></li>
				</ul>
			</div>
		</div>
	</nav>
		
			<div class="panel" style="margin:auto;margin-top:150px;width:35%;opacity:.97">
				<div class="panel-heading" style="text-align:center"><h4>Home</h4></div>
                <div class="panel-heading" style="text-align:center">
                <?php
                    echo 'Hello, ';
                    echo $_SESSION["name"];
                ?>
                </div>
				<div class="panel-body">
					<ul class="" style="list-style-type: none; font-size: 16px; line-height: 28px;">
						<?php
                        if($_SESSION["role"] == "IN") echo '<li><a href="beli-inventori.php">Beli Inventori</a></li>';
						if($_SESSION["role"] == "IN") echo '<li><a href="ganti-inventori.php">Ganti Inventori</a></li>';
						if($_SESSION["role"] == "MG") echo '<li><a href="lihat-booking.php">Lihat Booking</a></li>';
						if($_SESSION["role"] == "MG" || $_SESSION["role"] == "LA") echo '<li><a href="lihat-laundry.php">Lihat Laundry</a></li>';
						if($_SESSION["role"] == "MG" || $_SESSION["role"] == "IN") echo '<li><a href="pembelian-inventori.php">Daftar Pembelian Inventori</a></li>';
						//<li><a href="rincian-inventori.php">Rincian Inventori</a></li>
                        ?>
					</ul>
				</div>
			</div>
		</form>
	</body>
</html>
