<?php
	session_start();
	if(!isset($_SESSION["userlogin"]) || $_SESSION["role"] <> "IN") {
		header("Location: login.php");
	}	

	require "db/connect.php";

	if(isset($_POST["transactionDate"])){
		$date = $_POST["transactionDate"];
	}
	$counter = 1;

	
	while(isset($_POST['nomorNota']) && isset($_POST['harga'+$counter+'']) && isset($_POST['jumlah'+$counter+''])) {
		$nomorNota = $_POST['nomorNota'];
		$nama = $_POST['nama'+$counter+''];
		$merk = $_POST['merk'+$counter+''];
		$harga = $_POST['harga'+$counter+''];
		$jumlah = $_POST['jumlah'+$counter+''];
		$result = queryDB("INSERT INTO silutel.PEMBELLIAN_INVENTORI VALUES('$nomorNota', '$nama', '$merk', '$jumlah', '$harga')");

		$counter = $counter + 1;

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
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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
		<!--################################################################## -->
		<!--################################################################## -->
		<!--################################################################## -->
	 	<div class="modal fade" id="konfirmasiPembelian" role="dialog" >
		    <div class="modal-dialog"  style="width:70%">
		    
		  
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h3 style="text-align:center">SILUTEL - RINCIAN PEMBELIAN INVENTORI</h3>
		        </div>
		        <div class="modal-body">
		          <table style="width : 80%">
					<tr>
						<td>Nomor Nota</td>
						<td> : </td>
						<td id="nomorNotaResult"></td>
						<td>Total</td>
						<td> : </td>
						<td id="totalOfTotal"></td>
					</tr>
					<tr style="padding-top:5%">
						<td>Waktu</td>
						<td> : </td>
						<td id="transactionDate"><?php echo date("Y/m/d h:i:n");?></td>
						<td>Staf</td>
						<td> : </td>
						<td><?php $user = $_SESSION['userlogin']; $result = queryDB("SELECT nama FROM silutel.user WHERE Email = '$user'"); $row = pg_fetch_row($result); echo "<option>".$row[0]."</option>"; ?></td>
					</tr>
					<tr>
						<td>Supplier</td>
						<td> : </td>
						<td id="supplier">
							<?php
								
								$result = queryDB("SELECT nama FROM silutel.supplier");

								$row = pg_fetch_row($result);
								
								echo "<option>".$row[0]."</option>";	
							?>
						</td>
					</tr>
				</table>
				<br>
				<table class="table table-hover" id="confirmationTable" method="POST">
					<tr class="warning">
						<td>Nama Inventori</td>
						<td>Merk</td>
						<td>Harga</td>
						<td>Jumlah</td>
						<td>Total</td>
					</tr>
					<tbody>
					<td><div id="konfirmasiNama1"><?php $result1 = queryDB("SELECT * FROM silutel.Inventori"); $row = pg_fetch_row($result1); echo "<option>".$row[0]."</option>"; ?></div></td>
    				<td><div id="konfirmasiMerk1"><?php $result1 = queryDB("SELECT * FROM silutel.Inventori"); $row = pg_fetch_row($result1); echo "<option>".$row[1]."</option>"; ?></div></td>
    				<td><div id="konfirmasiHarga1">0</div></td>
    				<td><div id="konfirmasiJumlah1">0</div></td>
    				<td><div id="konfirmasiKeluaran1">0</div></td>
				</table>
		        </div>
		        <div class="modal-footer">
		          <input type="submit" id="buttonKonfirmasi" class="btn btn-default" style="margin-top: 15px;" value="Konfirmasi" data-dismiss="modal">
		        </div>
		      </div>
		      
		    </div>
		</div>
		<!--################################################################## -->
		<!--################################################################## -->
		<!--################################################################## -->
		<div class="container" style="margin-top:50px">
			<div class="col-md-10 col-md-offset-1">
				<h2 style="text-align:center">SILUTEL - BELI INVENTORI</h2>
				<br>
				<table style="width:60%">
					<tr>
						<td>Nomor Nota</td>
						<td style="padding-left:2%; padding-right:1%"> : </td>
						<td style="padding-left:3.2%"><input style="border : 0px;box-shadow : 0px 0px 0px;border-bottom : 1px solid #a6a6a6;border-radius : 0px;" type="text" class="form-control" id="nomorNota" onchange="updateNomorNota('nomorNota','nomorNotaResult')"></td>
					</tr>
					<tr>
						<td>Supplier</td>
						<td style="padding-left:2%; padding-right:1%"> : </td>
						<td style="padding-left:3.2%">
							<select class="form-control" style="border : 0px;box-shadow : 0px 0px 0px;border-bottom : 1px solid #a6a6a6;border-radius : 0px;" id="sel1" onChange="updateSupplier('sel1','supplier')">
								<?php
									
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
				<table class="table table-hover" style="border : 1px solid #a6a6a6" method ="POST" id="tableData" action="beli-inventori.php">
					<tr class="warning">
						<td>Nama Inventori</td>
						<td>Merk</td>
						<td>Harga</td>
						<td>Jumlah</td>
						<td>Total</td>
					</tr>
					<tr>
						<td>
							<select class="form-control" style="border : 0px;box-shadow : 0px 0px 0px;border-bottom : 1px solid #a6a6a6;border-radius : 0px;" id="nama1" onChange="updateNama('nama1','konfirmasiNama1')">
								<?php
									$result1 = queryDB("SELECT * FROM silutel.Inventori");

									while ($row = pg_fetch_row($result1)) {
										echo "<option>".$row[0]."</option>";
									}
								?>
							</select>
						</td>
						<td>
							<select class="form-control" style="border : 0px;box-shadow : 0px 0px 0px;border-bottom : 1px solid #a6a6a6;border-radius : 0px;" id="merk1" onchange="updateMerk('merk1','konfirmasiMerk1')">
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
							    		type="number" class="form-control" id="harga1" onChange="calculation('keluaran1','harga1','jumlah1','konfirmasiHarga1','konfirmasiJumlah1','konfirmasiKeluaran1')" placeholder="Harga">
							  </div>
							</form>
						</td>
						<td>
							<form> 
							  <div class="form-group">
							    <input style="border : 0px;box-shadow : 0px 0px 0px;border-bottom : 1px solid #a6a6a6;border-radius : 0px;"
							    		type="number" class="form-control" id="jumlah1" onChange="calculation('keluaran1','harga1','jumlah1','konfirmasiHarga1','konfirmasiJumlah1','konfirmasiKeluaran1')" placeholder="Jumlah">
							  </div>
							</form>
						</td>
						<td>
							<input id='keluaran1' disabled>
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
							<button style="float:right" class="btn btn-default" data-toggle="modal" data-target="#konfirmasiPembelian" onClick="total()">Simpan</button>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</body>
	<script>
		var counter = 1;
		var counterTotal = 1;
		function tambah() {
			counter += 1;
			var table = document.getElementById("tableData");
			var row = table.insertRow();
			var cell1 = row.insertCell(0);
    		var cell2 = row.insertCell(1);
    		var cell3 = row.insertCell(2);
    		var cell4 = row.insertCell(3);
    		var cell5 = row.insertCell(4);
    		cell1.innerHTML = '<select class="form-control" style="border : 0px;box-shadow : 0px 0px 0px;border-bottom : 1px solid #a6a6a6;border-radius : 0px;" id="nama'+counter+'" onChange="updateNama(\'nama'+counter+'\',\'konfirmasiNama'+counter+'\')"><?php $result1 = queryDB("SELECT * FROM silutel.Inventori"); while ($row = pg_fetch_row($result1)) { echo "<option>".$row[0]."</option>";} ?></select>';
    		cell2.innerHTML = '<select class="form-control" style="border : 0px;box-shadow : 0px 0px 0px;border-bottom : 1px solid #a6a6a6;border-radius : 0px;" id="merk'+counter+'" onChange="updateMerk(\'nama'+counter+'\',\'konfirmasiNama'+counter+'\')"><?php $result1 = queryDB("SELECT * FROM silutel.Inventori"); while ($row = pg_fetch_row($result1)) { echo "<option>".$row[1]."</option>";} ?></select>';
    		cell3.innerHTML = '<form><div class="form-group"><input style="border : 0px;box-shadow : 0px 0px 0px;border-bottom : 1px solid #a6a6a6;border-radius : 0px;"type="number" class="form-control" id="harga'+counter+'" onChange="calculation(\'keluaran'+counter+'\',\'harga'+counter+'\',\'jumlah'+counter+'\',\'konfirmasiHarga'+counter+'\',\'konfirmasiJumlah'+counter+'\',\'konfirmasiKeluaran'+counter+'\')" placeholder="Harga"></div></form>';
    		cell4.innerHTML = '<form><div class="form-group"><input style="border : 0px;box-shadow : 0px 0px 0px;border-bottom : 1px solid #a6a6a6;border-radius : 0px;"type="number" class="form-control" id="jumlah'+counter+'" onChange="calculation(\'keluaran'+counter+'\',\'harga'+counter+'\',\'jumlah'+counter+'\',\'konfirmasiHarga'+counter+'\',\'konfirmasiJumlah'+counter+'\',\'konfirmasiKeluaran'+counter+'\')" placeholder="Harga"></div></form>';
    		cell5.innerHTML = '<input id="keluaran'+counter+'" disabled>';

    		var confirmTable = document.getElementById("confirmationTable");
			var confirmationRow = confirmTable.insertRow();
			var confirmationCell1 = confirmationRow.insertCell(0);
    		var confirmationCell2 = confirmationRow.insertCell(1);
    		var confirmationCell3 = confirmationRow.insertCell(2);
    		var confirmationCell4 = confirmationRow.insertCell(3);
    		var confirmationCell5 = confirmationRow.insertCell(4);
    		confirmationCell1.innerHTML = '<div id="konfirmasiNama'+counter+'"><?php $result1 = queryDB("SELECT * FROM silutel.Inventori"); $row = pg_fetch_row($result1); echo "<option>".$row[0]."</option>"; ?></div>';
    		confirmationCell2.innerHTML = '<div id="konfirmasiMerk'+counter+'"><?php $result1 = queryDB("SELECT * FROM silutel.Inventori"); $row = pg_fetch_row($result1); echo "<option>".$row[1]."</option>"; ?></div>';
    		confirmationCell3.innerHTML = '<div id="konfirmasiHarga'+counter+'">0</div>';
    		confirmationCell4.innerHTML = '<div id="konfirmasiJumlah'+counter+'">0</div>';
    		confirmationCell5.innerHTML = '<div id="konfirmasiKeluaran'+counter+'">0</div>';

    		counterTotal = counter;
		}

		function total(){
			var eachHarga = document.getElementById("harga"+counterTotal+"").value;
			var eachJumlah = document.getElementById("jumlah"+counterTotal+"").value;
			var total = eachHarga * eachJumlah;
			while(counterTotal > 1) {
				counterTotal -= 1;
				var eachHarga = document.getElementById("harga"+counterTotal+"").value;
				var eachJumlah = document.getElementById("jumlah"+counterTotal+"").value;
				total = total + (eachHarga * eachJumlah);
			}

			document.getElementById('totalOfTotal').innerHTML = total;
			counterTotal = counter;
		}
	</script>
	<script>
		function calculation(keluaran,input1,input2,output1,output2,output3){
			var jumlah = document.getElementById(input2).value; 
			var harga = document.getElementById(input1).value;
			var hasil = jumlah * harga;
			document.getElementById(keluaran).value = hasil;
			document.getElementById(output1).innerHTML = harga;
			document.getElementById(output2).innerHTML = jumlah;
			document.getElementById(output3).innerHTML = hasil;
		}
	</script>
	<script>
		function updateNama(rowNama,output){
			var nama = document.getElementById(rowNama).value;
			document.getElementById(output).innerHTML = nama;
		}

		function updateMerk(rawMerk,output){
			var merk = document.getElementById(rawMerk).value;
			document.getElementById(output).innerHTML = merk;
		}

		function updateSupplier(rawSupplier,output){
			var supplier = document.getElementById(rawSupplier).value;
			document.getElementById(output).innerHTML = supplier;
		}

		function updateNomorNota(rawNomorNota,output) {
			var nomorNota = document.getElementById(rawNomorNota).value;
			document.getElementById(output).innerHTML = nomorNota;
		}
	</script>

	<script src="bootstrap/js/jquery-1.11.3.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</html>