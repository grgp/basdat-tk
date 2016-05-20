<html>
<head>
	<title>Rincian Pembelian Inventori</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/theme.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>
</head>
<body style="margin:10;">
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
					<li class="active"><a>Rincian Pembelian Inventori<span class="sr-only">(current)</span></a></li>
				</ul>
				
				<ul class="nav navbar-nav navbar-right">
					<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li><span class="sr-only">(current)</span></a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="row pushdown">

		<div class="col-md-10 col-md-offset-1">
		<h1 class="text-center">SILUTEL - RINCIAN PEMBELIAN INVENTORI</h3>
			<div class="row">
	    <div class="col-md-2">Nomor Nota:</div>
	    <div class="col-md-1 text-right">XYZ999</div>
	    <div class="col-md-1"></div>
	    <div class="col-md-1">Total:</div>
	    <div class="col-md-2 text-right">2,650,000</div>
	    </div>
	    <div class="row">
	    <div class="col-md-1">Waktu:</div>
	    <div class="col-md-2 text-right">05/05/2016 08:05</div>
	    <div class="col-md-1"></div>
	    <div class="col-md-1">Staf:</div>
	    <div class="col-md-2 text-right">Po</div>
	    </div>
	    <div class="row">
	    <div class="col-md-1">Supplier:</div>
	    <div class="col-md-2 text-right">Good Life</div>
	    </div>
		<br/>
		<table id="datatable" border=1 class="table">
			<tr>
				<th>Nama Inventori</th>
				<th>Merk</th>
				<th>Harga</th>
				<th>Jumlah</th>
				<th>Total</th>
			</tr>
			<tr>
				<td>Pasta Gigi</td>
				<td>ABC</td>
				<td>10,000</td>
				<td>50</td>
				<td>500,000</td>
			</tr>
			<tr>
				<td>Pasta Gigi</td>
				<td>DEF</td>
				<td>8,000</td>
				<td>50</td>
				<td>400,000</td>
			</tr>
			<tr>
				<td>Shampoo</td>
				<td>GHI</td>
				<td>20,000</td>
				<td>50</td>
				<td>1,000,000</td>
			</tr>
			<tr>
				<td>Shampoo</td>
				<td>IJK</td>
				<td>15,000</td>
				<td>50</td>
				<td>750,000</td>
			</tr>
		</table>
		</div>
	</div>
</body>