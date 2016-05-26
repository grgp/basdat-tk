<html>
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="Database Final Task - SILUTEL">
		<meta name="keywords" content="HTML">
		<meta name="author" content="Muhammad Sabiq Danurrohman">
		<title>Lihat Laundry</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/theme.css">
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>	
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
						<li class="active"><a>Lihat Laundry<span class="sr-only">(current)</span></a></li>
					</ul>
					
					<ul class="nav navbar-nav navbar-right">
						<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li><span class="sr-only">(current)</span></a></li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container pushdown">
			<div class="col-md-10 col-md-offset-1">
				<table class="table table-hover">
					<h1 style="text-align:center">LAUNDRY</h1>
					<form method="GET" action="lihat-laundry.php">
			<div class="row">
				<div class="btn-group" role="group" aria-label="..." style="margin-left: 10px;">
					<?php
						$fillDate = 'data-value="' . date("Y-m-d") . '"';
						if(isset($_GET["date"])) {
							$fillDate = 'data-value="' . $_GET["date"] . '"';
						}
					?>
					<input type="date" class="datepicker" name="date" <?php echo $fillDate; ?>><br><br>
					<div class="col-md-11">
					    <div class="btn-group" role="group">
				            <h4> Urutkan Berdasarkan :</h4>
				        </div>
				        <div class="btn-group" role="group">
				        	<?php
							$fillByNama = '';
							$fillByStaf = '';
							$fillByMerk = '';
							$fillByWaktu = '';
							$fillByJumlah = '';
							$fillByHarga = '';
							$fillByTotal = '';
							$fillByTanggalAmbil = '';

							if(isset($_GET["by"])) {
								switch($_GET["by"]) {
									case "nama":
										$fillByNama = 'selected';
										break;
									case "staf":
										$fillByStaf = 'selected';
										break;
									case "waktu":
										$fillByWaktu = 'selected';
										break;
									case "jumlah":
										$fillByJumlah = 'selected';
										break;
									case "hargasatuan":
										$fillByHarga = 'selected';
										break;
									case "total":
										$fillByTotal = 'selected';
										break;
									case "anggaran":
										$fillByAnggaran = 'selected';
										break;
									case "tanggalambil":
										$fillByTanggalAmbil = 'selected';
										break;
								}
							}
							?>
					        <select name="by" class="form-control" id="sel1">
						        <option value="nama" <?php echo $fillByNama; ?>>Nama</option>
						        <option value="merk" <?php echo $fillByMerk; ?>>Merk</option>
						        <option value="staf" <?php echo $fillByStaf; ?>>Staf</option>
						        <option value="waktu" <?php echo $fillByWaktu; ?>>Waktu</option>
						        <option value="jumlah" <?php echo $fillByJumlah; ?>>Jumlah</option>
						        <option value="hargasatuan" <?php echo $fillByHarga; ?>>Harga</option>
						        <option value="total" <?php echo $fillByTotal; ?>>Total</option>
						        <option value="tanggalambil" <?php echo $fillByTanggalAmbil; ?>>Tanggal Ambil</option>
					    	</select>
				    	</div>
				    	<div class="btn-group" role="group">
				    		<?php
								$fillAscdscAsc = '';
								$fillAscdscDsc = '';
								if(isset($_GET["ascdsc"])) {
									$_GET["ascdsc"] == 'asc' ? $fillAscdscAsc = 'selected' : $fillAscdscDsc = 'selected';
								}
							?>
					        <select name="ascdsc" class="form-control" id="sel1">
						        <option value="asc" <?php echo $fillAscdscAsc ?>>Asc</option>
						        <option value="dsc" <?php echo $fillAscdscDsc ?>>Desc</option>
					        </select>
				    	</div>
					</div>
					    <div class="col-md-1">
					    	<div class="btn-group" role="group">
					    		<button class="btn btn-default" type="submit">Urutkan</button>
					    	</div>
				   		</div>
				</div>
	    	</div>
    	</form>
		
		    </div>
    </div>
					<tr class="active pushabit" >
					  <th>Nama</th>
					  <th>Merk</th>
					  <th>Staf</th>
					  <th>Waktu</th>
					  <th>Jumlah</th>
					  <th>Harga</th>
					  <th>Total</th>
					  <th>Tanggal Ambil</th>
					</tr>
					<tbody>
					<?php
						require 'db/connect.php';

						$Date = '';
						if(isset($_GET["date"])) {
							if($_GET["date"]) {
								$Date = "AND DATE(waktu) = '" . DATE($_GET["date"] . "' ");
								$Date2 = DATE($_GET["date"]);
							}
						} else {
							$Date = " ";
						}


						$By = 'ORDER BY A.nama';
						$By2 = 'A.nama';
						if(isset($_GET["by"])) {
							switch($_GET["by"]) {
								case "nama":
									$By = 'ORDER BY A.nama';
									$By2 = 'nama';
									break;
								case "merk":
									$By = 'ORDER BY merk';
									$By2 = 'merk';
									break;
								case "staf":
									$By = 'ORDER BY B.nama';
									$By2 = 'staf';
									break;
								case "waktu":
									$By = 'ORDER BY waktu';
									$By2 = 'waktu';
									break;
								case "jumlah":
									$By = 'ORDER BY jumlah';
									$By2 = 'jumlah';
									break;
								case "hargasatuan":
									$By = 'ORDER BY hargasatuan';
									$By2 = 'hargasatuan';
									break;
								case "total":
									$By = 'ORDER BY jumlah*hargasatuan';
									$By2 = 'total';
									break;
								case "tanggalambil":
									$By = 'ORDER BY tanggalambil';
									$By2 = 'tanggalambil';
									break;
							}
						}


						$Ascdsc = '';
						if(isset($_GET["ascdsc"])) {
							$_GET["ascdsc"] === 'asc' ? $Ascdsc = 'asc' : $Ascdsc = 'desc';
						}
						
						if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
						  $startrow = 0;
						} else {
						  $startrow = (int)$_GET['startrow'];
						}
						$result = queryDB("SELECT A.nama, merk, B.nama, waktu, jumlah, hargasatuan, jumlah*hargasatuan, tanggalambil FROM silutel.laundry_inventori A, 
							silutel.user B WHERE emailstaf = email ".$Date.$By." ".$Ascdsc." "."LIMIT 15 OFFSET $startrow");
						$result2 = queryDB("SELECT * FROM silutel.laundry_inventori");

						$length = pg_num_rows($result2);

						while ($row = pg_fetch_row($result)) {
							echo "<tr>";
						  foreach ($row as &$item) {
						  	echo "<td>$item</td>";
							}
						  echo "</tr>";
						}
								
						$prev = $startrow - 15;
					?>

					</tbody>
				</table>
				<?php 
					echo '<div class="row">';
					if ($prev >= 0 && !isset($_GET["ascdsc"]) && !isset($_GET["by"])) {
						echo '<div class="col-md-11">';
   						echo '<a class="btn btn-default" href="'.$_SERVER['PHP_SELF'].'?startrow='.$prev.'">Previous</a>';
   						echo '</div>';
   					}
   					else if ($startrow < $length-15 && !isset($_GET["ascdsc"]) && !isset($_GET["by"])){
   						echo '<div class="col-md-1">';
   						echo '<a class="btn btn-default" href="'.$_SERVER['PHP_SELF'].'?startrow='.($startrow+15).'">Next</a>';
   						echo '</div>';
   					}
   					else if ($prev >= 0 && isset($_GET["ascdsc"]) && isset($_GET["by"])){
						echo '<div class="col-md-11">';
   						echo '<a class="btn btn-default" href="'.$_SERVER['PHP_SELF'].'?by='.$By2.'&ascdsc='.$Ascdsc.'&startrow='.$prev.'">Previous</a>';
   						echo '</div>';
   					}
   					else if ($startrow < $length-15 && isset($_GET["ascdsc"]) && isset($_GET["by"])){
   						echo '<div class="col-md-1">';
   						echo '<a class="btn btn-default" href="'.$_SERVER['PHP_SELF'].'?by='.$By2.'&ascdsc='.$Ascdsc.'&startrow='.($startrow+15).'">Next</a>';
   						echo '</div>';
   					}
   					else if ($prev >= 0 && isset($_GET["ascdsc"]) && isset($_GET["by"]) && isset($_GET["date"])){
						echo '<div class="col-md-11">';
   						echo '<a class="btn btn-default" href="'.$_SERVER['PHP_SELF'].'?date='.$Date2.'&by='.$By2.'&ascdsc='.$Ascdsc.'&startrow='.$prev.'">Previous</a>';
   						echo '</div>';
   					}
   					else if ($startrow < $length-15 && isset($_GET["ascdsc"]) && isset($_GET["by"]) && isset($_GET["date"])){
   						echo '<div class="col-md-1">';
   						echo '<a class="btn btn-default" href="'.$_SERVER['PHP_SELF'].'?date='.$Date2.'&by='.$By2.'&ascdsc='.$Ascdsc.'&startrow='.($startrow+15).'">Next</a>';
   						echo '</div>';
   					}
					echo '</div>';
				?>
			</div>
		</div>
	</body>
</html>