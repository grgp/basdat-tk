<?php
	require 'db/connect.php';

	if (!isset($_GET["sort"]) || !isset($_GET["by"]) || !isset($_GET["p"])) {
		$sortby = "nomorinvoice";
		$ascdesc = "desc";
		$pagenum = 1;
	} else {
		$sortby = htmlspecialchars($_GET["sort"]);
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
	</head>

	<body>

	<script>
			var current = new Date();
			$( "#datepicker" ).datepicker({dateFormat:"yy/mm/dd"}).datepicker("setDate",new Date());
		</script>
		<nav class="navbar navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">SILUTEL</a>
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

						<div class = "row">
				        <div class = "col-md-1">Tanggal:</div>
				        <div class = "col-md-5"><input type="text" id="datepicker"></input></div>
						</div>
						<br>
						<div class="btn-group" role="group" aria-label="...">
						  <div class="btn-group" role="group">
						  	<a href="<?php echo "?sort=" . "nomorinvoice" . "&by=" . $ascdesc . "&p=" . $pagenum; ?>">
						    	<button type="button" class="btn btn-default">Invoice</button>
						    </a>
						  </div>
						  <div class="btn-group" role="group">
								<a href="<?php echo "?sort=" . "tanggaldatang" . "&by=" . $ascdesc . "&p=" . $pagenum; ?>">
						  	  <button type="button" class="btn btn-default">Tanggal Datang</button>
						  	</a>
						  </div>
						  <div class="btn-group" role="group">
						  	<a href="<?php echo "?sort=" . "tanggalpergi" . "&by=" . $ascdesc . "&p=" . $pagenum; ?>">
						    	<button type="button" class="btn btn-default">Tanggal Pergi</button>
						    </a>
						  </div>
						</div>

						<a href="<?php echo "?sort=" . $sortby . "&by=" . ($ascdesc == "asc" ? "desc" : "asc") . "&p=" . $pagenum; ?>">
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
							  <li class="active"><a href="#">1</a></li>
							  <li><a href="#">2</a></li>
							  <li><a href="#">3</a></li>
							  <li><a href="#">4</a></li>
							  <li><a href="#">5</a></li>
							</ul>
						</div>

					</div> <!-- end row -->
				</div> <!-- end col -->
			</div> <!-- end outer row -->
		</div> <!-- end container -->
	</body>

</html>