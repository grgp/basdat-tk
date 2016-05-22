<html>
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="Database Final Task - SILUTEL">
		<meta name="keywords" content="HTML">
		<meta name="author" content="Muhammad Sabiq Danurrohman">
		<title>Lihat Inventori</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/theme.css">
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
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
						<li class="active"><a>Lihat Inventori<span class="sr-only">(current)</span></a></li>
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
					<table class="table table-hover">
					<h1 style="text-align:center">INVENTORI</h1>
		<form method="GET" action="lihat-inventori.php">
			<div class="row">
				<div class="btn-group" role="group" aria-label="..." style="margin-left: 10px;">
					<div class="col-md-11">
					    <div class="btn-group" role="group">
				            <h4> Urutkan Berdasarkan :</h4>
				        </div>
				        <div class="btn-group" role="group">
				        	<?php
								$fillByNama = '';
								$fillByMerk = '';
								$fillByStok = '';
								if(isset($_GET["by"])) {
									switch($_GET["by"]) {
										case "nama":
											$fillByNama = 'selected';
											break;
										case "merk":
											$fillByMerk = 'selected';
											break;
										case "stok":
											$fillByStok = 'selected';
											break;
									}
								}
							?>
					        <select name="by" class="form-control" id="sel1">
						        <option value="nama" <?php echo $fillByNama; ?>>Nama</option>
						        <option value="merk" <?php echo $fillByMerk; ?>>Merk</option>
						        <option value="stok" <?php echo $fillByStok; ?>>Stok</option>
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
					
					<tr  class="active">
					  <th>Nama</th>
					  <th>Merk</th>
					  <th>Stok</th>
					</tr  class="active">
					<tbody>
					<?php
						require 'db/connect.php';


						$By = '';
						$By2 = '';
						if(isset($_GET["by"])) {
							switch($_GET["by"]) {
								case "nama":
									$By = 'ORDER BY nama';
									$By2 = 'nama';
									break;
								case "merk":
									$By = 'ORDER BY merk';
									$By2 = 'merk';
									break;
								case "stok":
									$By = 'ORDER BY stok';
									$By2 = 'stok';
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
						$result = queryDB("SELECT * FROM silutel.inventori"." ".$By." ".$Ascdsc." "."LIMIT 15 OFFSET $startrow");
						$result2 = queryDB("SELECT * FROM silutel.inventori");
						$length = pg_num_rows($result2);

						while ($row = pg_fetch_row($result)) {
							echo "<tr>";
						  foreach ($row as &$item) {
						  	echo "<td>$item</td>";
							}
						  echo "</tr>";
						}
								
						$prev = $startrow - 5;
						?>
					</tbody>
				</table>
					<?php 
					echo '<div class="row">';
					if ($prev >= 0 && !isset($_GET["ascdsc"]) && !isset($_GET["by"])){
						echo '<div class="col-md-11">';
   						echo '<a class="btn btn-default" href="'.$_SERVER['PHP_SELF'].'?startrow='.$prev.'">Previous</a>';
   						echo '</div>';
   					}
   					if ($startrow < $length-5 && !isset($_GET["ascdsc"]) && !isset($_GET["by"])){
   						echo '<div class="col-md-1">';
   						echo '<a class="btn btn-default" href="'.$_SERVER['PHP_SELF'].'?startrow='.($startrow+5).'">Next</a>';
   						echo '</div>';
   					}
   					if ($prev >= 0 && isset($_GET["ascdsc"]) && isset($_GET["by"])){
						echo '<div class="col-md-11">';
   						echo '<a class="btn btn-default" href="'.$_SERVER['PHP_SELF'].'?by='.$By2.'&ascdsc='.$Ascdsc.'&startrow='.$prev.'">Previous</a>';
   						echo '</div>';
   					}
   					if ($startrow < $length-5 && isset($_GET["ascdsc"]) && isset($_GET["by"])){
   						echo '<div class="col-md-1">';
   						echo '<a class="btn btn-default" href="'.$_SERVER['PHP_SELF'].'?by='.$By2.'&ascdsc='.$Ascdsc.'&startrow='.($startrow+5).'">Next</a>';
   						echo '</div>';
   					}
					echo '</div>';
					?>
			</div>
		</div>
	</body>
</html>