<?php
  session_start();
  
  if(!isset($_SESSION["userlogin"])){
      header("Location: login.php");
  }
  else {
      if($_SESSION["role"] != "MG" && $_SESSION["role"] != "IN") {
          header("Location: lihat-laundry.php"); //anggap ke home
      }
  }
  
	require 'db/connect.php';

	if (!isset($_GET["s"]) || !isset($_GET["by"]) || !isset($_GET["p"])) {
		//$dtime = queryDB("SELECT current_date;");
		$sortby = "nomorinvoice";
		$ascdesc = "desc";
		$pagenum = 1;
	} else {
		// $dtime = htmlspecialchars($_GET["d"]);
		$sortby = htmlspecialchars($_GET["s"]);
		$ascdesc = htmlspecialchars($_GET["by"]);
		$pagenum = htmlspecialchars($_GET["p"]);
	}

	$offset = ($pagenum - 1) * 15;
?>

<html>
	<head>
		<title>Lihat Booking</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/theme.css">

		<link href='https://fonts.googleapis.com/css?family=Lato:400,700,300,900' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

		<script src="js/jquery-1.12.2.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>
		<script src="js/script-pembelianinventori.js"></script>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css">
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
					<a class="navbar-brand" href="index.php">SILUTEL</a>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="active"><a>Lihat Booking<span class="sr-only">(current)</span></a></li>
					</ul>
					
					<ul class="nav navbar-nav navbar-right">
						<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li><span class="sr-only">(current)</span></a></li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container pushdown">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
				<div class="">
					<div class="row">
						<h3 class="text-center">Lihat Booking</h3>

						<div class="row">
			        <div class="col-md-1">Tanggal:</div>
			        <div class="col-md-5">
			        	<form method="get" name="form" action="">
				        	<input type="text" name="datepicker" id="datepicker"></input>
				        	<a href="<?php 
				        		$cdateval = htmlspecialchars($_GET["datepicker"]);
				        		echo "?d=" . $cdate .	"?s=" . "nomorinvoice" . "&by=" . $ascdesc . "&p=" . $pagenum;
				        	?>">
						    		<input type="submit">
						    			<button type="button" class="btn btn-default">Goto</button>
						    		</input>
						    	</a>
					    	</form>
			        </div>
						</div>
						<br>
						<div class="btn-group" role="group" aria-label="...">
						  <div class="btn-group" role="group">
						  	<a href="<?php echo "?s=" . "nomorinvoice" . "&by=" . $ascdesc . "&p=" . $pagenum; ?>">
						    	<button type="button" class="btn btn-default">Invoice</button>
						    </a>
						  </div>
						  <div class="btn-group" role="group">
								<a href="<?php echo "?s=" . "tanggaldatang" . "&by=" . $ascdesc . "&p=" . $pagenum; ?>">
						  	  <button type="button" class="btn btn-default">Tanggal Datang</button>
						  	</a>
						  </div>
						  <div class="btn-group" role="group">
						  	<a href="<?php echo "?s=" . "tanggalpergi" . "&by=" . $ascdesc . "&p=" . $pagenum; ?>">
						    	<button type="button" class="btn btn-default">Tanggal Pergi</button>
						    </a>
						  </div>
						</div>

						<a href="<?php echo "?s=" . $sortby . "&by=" . ($ascdesc == "asc" ? "desc" : "asc") . "&p=" . $pagenum; ?>">
							<button type="button" class="btn btn-default btn-ascdesc pull-right">Asc/Desc</button>
						</a>
					</div>
					<div class="row pushabit">
						<table class="table">
							<tr>
								<th>Invoice</th>
								<th>Tanggal Datang</th>
								<th>Tanggal Pergi</th>
								<th>Jumlah</th>
								<th>Discount</th>
								<th>Total</th>
								<th>Nama Tamu</th>
							</tr>
							<?php
								$result = queryDB("SELECT * FROM silutel.invoice ORDER BY $sortby $ascdesc LIMIT 15 OFFSET $offset");

								while ($row = pg_fetch_row($result)) {
									echo "<tr>";
								  for ($i = 0; $i < 4; $i++) {
								  	echo "<td>$row[$i]</td>";
									}
										echo "<td>$row[5]</td>";
										echo "<td>$row[6]</td>";
										echo "<td>$row[4]</td>";
								  echo "</tr>";
								}
							?>
<!-- 					<tr>
								<td>ABC789</td>
								<td>05/05/2016 20:14</td>
								<td>08/05/2016 10:00</td>sud
								<td>2</td>
								<td>0</td>
								<td>4,500,000</td>
								<td>Anto</td>
							</tr> -->
						</table>

						<div class="text-center">
							<ul class="pagination">
								<?php
									$count = (pg_fetch_row(queryDB("SELECT COUNT(*) FROM silutel.invoice"))[0]) / 15;

									for ($j = 0; $j < $count; $j++) {
										if ($pagenum-1 == $j) {
											echo '<li class="active"><a href="' . 
														"?s=" . $sortby . "&by=" . $ascdesc . "&p=" . ($j+1) .
														'">' . ($j+1) . '</a></li>';
										} else {
											echo '<li><a href="' . 
														"?s=" . $sortby . "&by=" . $ascdesc . "&p=" . ($j+1) .
														'">' . ($j+1) . '</a></li>';
										}
									}
								?>
							</ul>
						</div>

					</div> <!-- end row -->
				</div> <!-- end col -->
			</div> <!-- end outer row -->
		</div> <!-- end container -->
	</body>

</html>