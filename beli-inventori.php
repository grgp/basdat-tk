<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8"/>
		<title>Beli Inventori</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/theme.css">
		<link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
		<style>
			#sel1,#sel2,#sel3 {
				border : 0px;
				box-shadow : 0px 0px 0px;
				border-bottom : 1px solid #a6a6a6;
				border-radius : 0px;
			
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
					<a class="navbar-brand" href="#">SILUTEL</a>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="active"><a>BELI INVENTORI<span class="sr-only">(current)</span></a></li>
					</ul>
					
					<ul class="nav navbar-nav navbar-right">
						<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li><span class="sr-only">(current)</span></a></li>
					</ul>
				</div>
			</div>
		</nav>
	 
		<div class="container" style="margin-top:50px" >
			<div class="col-md-10 col-md-offset-1">
				<h2 style="text-align:center">SILUTEL - BELI INVENTORI</h2>
				<br>
				<table style="width:60%">
					<tr>
						<td>Nomor Nota</td>
						<td style="padding-left:2%; padding-right:1%"> : </td>
						<td style="padding-left:3.2%">ABC111</td>
					</tr>
					<tr>
						<td>Supplier</td>
						<td style="padding-left:2%; padding-right:1%"> : </td>
						<td>
							<select class="form-control" id="sel1">
								<option>GoodLife</option>
								<option>GoodProduct</option>
								<option>GoodTime</option>
								<option>GoodCompany</option>
								<option>GoodMarket</option>
							</select>
						</td>
						<td>
							
						</td>
					</tr>
				</table>
	
				<table class="table" style="margin-bottom: 0%; margin-top:0%;">
					<tr>
						<td style="border:0px"></td>
						<td style="border:0px"></td>
						<td style="border:0px"></td>
						<td style="border:0px"></td>
						<td style="border:0px">
							<button style="float:right" class="btn btn-default" type="submit">Tambah Inventori</button>
						</td>
					</tr>
				</table>
				<table class="table table-hover">
					<tr class="warning">
						<td>Nama Inventori</td>
						<td>Merk</td>
						<td>Harga</td>
						<td>Jumlah</td>
						<td>Total</td>
					</tr>
					<tbody>
					<tr>
						<td>
							<select class="form-control" id="sel2">
								<option>Pilih</option>
								<option>Pasta Gigi</option>
								<option>Shampoo</option>
								<option>Odol</option>
								<option>Bantal</option>
							</select>
						</td>
						<td>
							<select class="form-control" id="sel3">
								<option>Pilih</option>
								<option>ABC</option>
								<option>DEF</option>
								<option>GHI</option>
								<option>IJK</option>
							</select>
						</td>
						<td>
							<h5>10,000</h5>
						</td>
						<td>
							<h5>50</h5>
						</td>
						<td>
							<h5>500,000</h5>
						</td>
					</tr>
					<tr>
						<td>
							<select class="form-control" id="sel2">
								<option>Pilih</option>
								<option>Pasta Gigi</option>
								<option>Shampoo</option>
								<option>Odol</option>
								<option>Bantal</option>
							</select>
						</td>
						<td>
							<select class="form-control" id="sel3">
								<option>Pilih</option>
								<option>ABC</option>
								<option>DEF</option>
								<option>GHI</option>
								<option>IJK</option>
							</select>
						</td>
						<td>
							<h5>20,000</h5>
						</td>
						<td>
							<h5>100</h5>
						</td>
						<td>
							<h5>1000,000</h5>
						</td>
					</tr>
				</table>
				<table class="table" style="margin-bottom: 0%; margin-top:0%;">
					<tr>
						<td style="border:0px"></td>
						<td style="border:0px"></td>
						<td style="border:0px"></td>
						<td style="border:0px"></td>
						<td style="border:0px">
							<button style="float:right" class="btn btn-default" type="submit">Simpan</button>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</body>
	
	<script src="bootstrap/js/jquery-1.11.3.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</html>