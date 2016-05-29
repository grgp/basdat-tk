<?php
	session_start();
	if(!isset($_SESSION["userlogin"]) || $_SESSION["role"] <> "IN") {
		header("Location: login.php");
	}	

	require "db/connect.php";
	
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
					<a class="navbar-brand" href="index.php">SILUTEL</a>
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

				<table class="table table-hover" id="confirmationTable">
					<tr class="warning">
						<td>Nama Inventori</td>
						<td>Merk</td>
						<td>Harga</td>
						<td>Jumlah</td>
						<td>Total</td>
					</tr>
					<td><div id="konfirmasiNama1"><?php $result1 = queryDB("SELECT * FROM silutel.Inventori"); $row = pg_fetch_row($result1); echo $row[0]; ?>"</div></td>
    				<td><div id="konfirmasiMerk1"><?php $result1 = queryDB("SELECT * FROM silutel.Inventori"); $row = pg_fetch_row($result1); echo $row[1]; ?>"</div></td>
    				<td><div id="konfirmasiHarga1">0</div></td>
    				<td><div id="konfirmasiJumlah1">0</div></td>
    				<td><div id="konfirmasiKeluaran1">0</div></td>
				</table>
		        </div>
		        <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="submitSubmit('konfirmasi')">Konfirmasi</button>
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
				<form id="konfirmasi" method="POST" action="beli-inventori.php">
					<table style="width:60%">
						<tr>
							<td>Nomor Nota</td>
							<td style="padding-left:2%; padding-right:1%"> : </td>
							<td style="padding-left:3.2%">
								<div <?php $temp = false;
									if($_SERVER["REQUEST_METHOD"] === "POST") {
										$counter = 1;
										$temp = false;
										$result = queryDB("SELECT * FROM silutel.PEMBELIAN");
										$nomorNota = $_POST['nomorNota'];
										while(!$temp && ($row = pg_fetch_row($result))) {
											if($row[0] === $nomorNota) {
												$temp = true;
											}
										}

										if(!$temp) {
											$waktu = date("Y/m/d h:i:n");
											$sup = $_POST['supplier'];
											$emailstaf = $_SESSION['userlogin'];
											$result = queryDB("INSERT INTO silutel.PEMBELIAN VALUES('$nomorNota', '$waktu', '$sup', '$emailstaf')");

											while(isset($_POST['nomorNota']) && isset($_POST['harga'.$counter.'']) && isset($_POST['jumlah'.$counter.''])) {
												$nama = $_POST['nama'.$counter.''];
												$merk = $_POST['merk'.$counter.''.$counter.''];
												$harga = $_POST['harga'.$counter.''];
												$jumlah = $_POST['jumlah'.$counter.''];
												$result = queryDB("INSERT INTO silutel.PEMBELIAN_INVENTORI VALUES('$nomorNota', '$nama', '$merk', '$jumlah', '$harga')");
												$counter = $counter + 1;	
											}
										} else {
											echo 'class="form-group has-error has-feedback"';
										}
									}?> >
									<input style="border:0px;box-shadow : 0px 0px 0px;border-bottom : 1px solid <?php if($temp){echo 'red';} else {echo '#a6a6a6';} ?>;" type="text" class="form-control" id="nomorNota" name="nomorNota" pattern=".{6,6}" placeholder="6 Character" onchange="updateNomorNota('nomorNota','nomorNotaResult')"	>
									<?php 
									if($temp) {
											echo '<span class="glyphicon glyphicon-remove form-control-feedback"></span>';
									}?>
								</div>
							</td>
						</tr>
						<tr>
							<td>Supplier</td>
							<td style="padding-left:2%; padding-right:1%"> : </td>
							<td style="padding-left:3.2%">
								<select class="form-control" style="border : 0px;box-shadow : 0px 0px 0px;border-bottom : 1px solid #a6a6a6;border-radius : 0px;" name="supplier" onChange="updateSupplier('sel1','supplier')">
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
					<br>
					<table class="table tab	le-hover" style="border : 1px solid #a6a6a6" method ="POST" id="tableData" action="beli-inventori.php">
						<tr class="warning">
							<td>Nama Inventori</td>
							<td>Merk</td>
							<td>Harga</td>
							<td>Jumlah</td>
							<td>Total</td>
						</tr>
						<tr>
							<td>
								<select class="form-control" style="border : 0px;box-shadow : 0px 0px 0px;border-bottom : 1px solid #a6a6a6;border-radius : 0px;" id="nama1" name="nama1" onChange="updateNama('nama1','konfirmasiNama1','merk1','konfirmasiMerk1','merk11')">
									<?php
										$result1 = queryDB("SELECT * FROM silutel.Inventori");

										while ($row = pg_fetch_row($result1)) {
											echo "<option>".$row[0]."</option>";
										}
									?>
								</select>
							</td>
							<td>
								<input type='text' style="background-color:white;border: 0px; padding-top:4%;" name="merk1" id="merk1" value="<?php $result1 = queryDB('SELECT * FROM silutel.Inventori'); $row = pg_fetch_row($result1); echo $row[1]; ?>" disabled>
								<input type='hidden' style="background-color:white;border: 0px; padding-top:4%;" name="merk11" id="merk11" value="<?php $result1 = queryDB('SELECT * FROM silutel.Inventori'); $row = pg_fetch_row($result1); echo $row[1]; ?>">
							</td>
							<td>
								  <div class="form-group">
								    <input style="border : 0px;box-shadow : 0px 0px 0px;border-bottom : 1px solid #a6a6a6;border-radius : 0px;"
								    		type="number" class="form-control" id="harga1" name="harga1" min="1" value="0" onChange="calculation('keluaran1','harga1','jumlah1','konfirmasiHarga1','konfirmasiJumlah1','konfirmasiKeluaran1')" placeholder="Harga">
								  </div>
							</td>
							<td>
								  <div class="form-group">
								    <input style="border : 0px;box-shadow : 0px 0px 0px;border-bottom : 1px solid #a6a6a6;border-radius : 0px;"
								    		type="number" class="form-control" id="jumlah1" name="jumlah1" min="1" value="0" onChange="calculation('keluaran1','harga1','jumlah1','konfirmasiHarga1','konfirmasiJumlah1','konfirmasiKeluaran1')" placeholder="Jumlah">
								  </div>
							</td>
							<td>
								<input style="background-color:white;border: 0px; padding-top:4%;" name='keluaran1' id="keluaran1" disabled>
							</td>
						</tr>
					</table>
				</form>
				<button style="float:left" class="btn btn-default" onclick="tambah()">Tambah Inventori</button>
				<button type="button" data-toggle="modal" data-target="#konfirmasiPembelian" style="float:right" class="btn btn-default" data-toggle="modal" onclick="total()">Check</button>
				
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
    		cell1.innerHTML = '<select class="form-control" style="border : 0px;box-shadow : 0px 0px 0px;border-bottom : 1px solid #a6a6a6;border-radius : 0px;" id="nama'+counter+'" name="nama'+counter+'" onChange="updateNama(\'nama'+counter+'\',\'konfirmasiNama'+counter+'\',\'merk'+counter+'\',\'konfirmasiMerk'+counter+'\',\'merk'+counter+''+counter+'\')"><?php $result1 = queryDB("SELECT * FROM silutel.Inventori"); while ($row = pg_fetch_row($result1)) { echo "<option>".$row[0]."</option>";} ?></select>';
    		cell2.innerHTML = '<input type="text" style="background-color:white;border: 0px; padding-top:4%;" id="merk'+counter+'" name="merk'+counter+'" value="<?php $result1 = queryDB('SELECT * FROM silutel.Inventori'); $row = pg_fetch_row($result1); echo $row[1]; ?>" disabled> <input type="hidden" style="background-color:white;border: 0px; padding-top:4%;" name="merk'+counter+''+counter+'" id="merk'+counter+''+counter+'" value="<?php $result1 = queryDB('SELECT * FROM silutel.Inventori'); $row = pg_fetch_row($result1); echo $row[1]; ?>">';
    		cell3.innerHTML = '<div class="form-group"><input style="border : 0px;box-shadow : 0px 0px 0px;border-bottom : 1px solid #a6a6a6;border-radius : 0px;"type="number" value="0" class="form-control" id="harga'+counter+'" name="harga'+counter+'" onChange="calculation(\'keluaran'+counter+'\',\'harga'+counter+'\',\'jumlah'+counter+'\',\'konfirmasiHarga'+counter+'\',\'konfirmasiJumlah'+counter+'\',\'konfirmasiKeluaran'+counter+'\')" placeholder="Harga"></div>';
    		cell4.innerHTML = '<div class="form-group"><input style="border : 0px;box-shadow : 0px 0px 0px;border-bottom : 1px solid #a6a6a6;border-radius : 0px;"type="number" value="0" class="form-control" id="jumlah'+counter+'" name="jumlah'+counter+'" onChange="calculation(\'keluaran'+counter+'\',\'harga'+counter+'\',\'jumlah'+counter+'\',\'konfirmasiHarga'+counter+'\',\'konfirmasiJumlah'+counter+'\',\'konfirmasiKeluaran'+counter+'\')" placeholder="Harga"></div>';
    		cell5.innerHTML = '<input style="background-color:white;border: 0px; padding-top:4%;" id="keluaran'+counter+'" name="keluaran'+counter+'" disabled>';

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
		var num_of_data = 0;
		function updateNama(rowNama,output,merkMerk,konfirmasiMerkMerk,merkMerk2){
			$.ajax({
				url: "getData.php",
				method: "POST",
				dataType: "json",
				success: function(result){
					num_of_data = updateNamaHelper(result, rowNama, output, merkMerk, konfirmasiMerkMerk, merkMerk2);
				},
				error: function(xhr){
					alert(xhr.status);
				}
			});
		}
		function updateNamaHelper(data, rowNamaResult, outputResult, merkMerkResult, konfirmasiMerkMerkResult, merkMerk2Result){
			var nama = document.getElementById(rowNamaResult).value;
			for(var i = 0;i<data.post.length; i++){
				if(nama === data.post[i].nama){
					document.getElementById(merkMerkResult).value = data.post[i].merk;
					document.getElementById(merkMerk2Result).value = data.post[i].merk;
					document.getElementById(konfirmasiMerkMerkResult).innerHTML = data.post[i].merk;
				}
			}
			document.getElementById(outputResult).innerHTML = nama;

			return data.number;
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
	<script>
		function submitSubmit(output){
			document.getElementById(output).submit();
		}
	</script>
	<script src="bootstrap/js/jquery-1.11.3.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</html>