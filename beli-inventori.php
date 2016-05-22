<?php
	session_start();
	if(!isset($_SESSION["userlogin"]) || $_SESSION["role"] <> "IN"){
		header("Location: login.php");
	}
?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8"/>
		<title>Beli Inventori</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/theme.css">
		<link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
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
							<select class="form-control" style="border : 0px;box-shadow : 0px 0px 0px;border-bottom : 1px solid #a6a6a6;border-radius : 0px;" id="sel1">
								<?php
									require "db/connect.php";
									$result = queryDB("SELECT nama FROM silutel.supplier");

									while ($row = pg_fetch_row($result)) {
										echo "<option>".$row[0]."</option>";
									}
								?>
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
							<button style="float:right" class="btn btn-default" onclick="tambah()">Tambah Inventori</button>
						</td>
					</tr>
				</table>
				<table class="table table-hover" style="border : 1px solid #a6a6a6" method ="POST" id="tableData">
					<tr class="warning">
						<td>Nama Inventori</td>
						<td>Merk</td>
						<td>Harga</td>
						<td>Jumlah</td>
						<td>Total</td>
					</tr>
					<tr>
						<td>
							<select class="form-control" style="border : 0px;box-shadow : 0px 0px 0px;border-bottom : 1px solid #a6a6a6;border-radius : 0px;" id="sel2" >
								<?php
									$result1 = queryDB("SELECT * FROM silutel.Inventori");

									while ($row = pg_fetch_row($result1)) {
										echo "<option>".$row[0]."</option>";
									}
								?>
							</select>
						</td>
						<td>
							<select class="form-control" style="border : 0px;box-shadow : 0px 0px 0px;border-bottom : 1px solid #a6a6a6;border-radius : 0px;" id="sel3">
								<?php
									$result2 = queryDB("SELECT * FROM silutel.Inventori");

									while ($row = pg_fetch_row($result2)) {
										echo "<option>".$row[1]."</option>";
									}
								?>
							</select>
						</td>
						<td>
							<form> 
							  <div class="form-group">
							    <input style="border : 0px;box-shadow : 0px 0px 0px;border-bottom : 1px solid #a6a6a6;border-radius : 0px;"
							    		type="number" class="form-control" id="harga1" onChange="calculation('keluaran1','harga1','jumlah1')" placeholder="Harga">
							  </div>
							</form>
						</td>
						<td>
							<form> 
							  <div class="form-group">
							    <input style="border : 0px;box-shadow : 0px 0px 0px;border-bottom : 1px solid #a6a6a6;border-radius : 0px;"
							    		type="number" class="form-control" id="jumlah1" onChange="calculation('keluaran1','harga1','jumlah1')" placeholder="Jumlah">
							  </div>
							</form>
						</td>
						<td>
						<h5 id = 'keluaran1'> </h5>
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
	<script>
		var counter = 1;
		var sel = 3;
		function tambah() {
			counter += 1;
			sel += 1;
			var table = document.getElementById("tableData");
			var row = table.insertRow();
			var cell1 = row.insertCell(0);
    		var cell2 = row.insertCell(1);
    		var cell3 = row.insertCell(2);
    		var cell4 = row.insertCell(3);
    		var cell5 = row.insertCell(4);
    		cell1.innerHTML = '<select class="form-control" style="border : 0px;box-shadow : 0px 0px 0px;border-bottom : 1px solid #a6a6a6;border-radius : 0px;" id="sel'+sel+'"><?php $result1 = queryDB("SELECT * FROM silutel.Inventori"); while ($row = pg_fetch_row($result1)) { echo "<option>".$row[0]."</option>";} ?></select>';
    		sel += 1;
    		cell2.innerHTML = '<select class="form-control" style="border : 0px;box-shadow : 0px 0px 0px;border-bottom : 1px solid #a6a6a6;border-radius : 0px;" id="sel'+sel+'"><?php $result1 = queryDB("SELECT * FROM silutel.Inventori"); while ($row = pg_fetch_row($result1)) { echo "<option>".$row[1]."</option>";} ?></select>';
    		cell3.innerHTML = '<form><div class="form-group"><input style="border : 0px;box-shadow : 0px 0px 0px;border-bottom : 1px solid #a6a6a6;border-radius : 0px;"type="number" class="form-control" id="harga'+counter+'" onChange="calculation(\'keluaran'+counter+'\',\'harga'+counter+'\',\'jumlah'+counter+'\')" placeholder="Harga"></div></form>';
    		cell4.innerHTML = '<form><div class="form-group"><input style="border : 0px;box-shadow : 0px 0px 0px;border-bottom : 1px solid #a6a6a6;border-radius : 0px;"type="number" class="form-control" id="jumlah'+counter+'" onChange="calculation(\'keluaran'+counter+'\',\'harga'+counter+'\',\'jumlah'+counter+'\')" placeholder="Harga"></div></form>';
    		cell5.innerHTML = '<h5 id = "keluaran'+counter+'"> </h5>';
		}
	</script>
	<script>
		function calculation(keluaran,input1,input2){
			var jumlah = document.getElementById(input2).value; 
			var harga = document.getElementById(input1).value;
			var hasil = jumlah * harga;
			document.getElementById(keluaran).innerHTML =  hasil;
		}
	</script>
	<script src="bootstrap/js/jquery-1.11.3.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</html>