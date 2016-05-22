<?php
    //check for login
    
    if(isset($_GET["nomornota"])) {
        require 'db/connect.php';
        
        $query = sprintf("SELECT * FROM SILUTEL.PEMBELIAN, SILUTEL.USER WHERE nomornota = '%s' AND emailstaf = email",$_GET["nomornota"]);
        
        $details = queryDB($query);
        
        $detail_entry = pg_fetch_assoc($details);
        
        $query = sprintf("SELECT nama, merk, hargasatuan, jumlah, hargasatuan*jumlah AS total FROM SILUTEL.PEMBELIAN_INVENTORI WHERE nomornota = '%s'",$_GET["nomornota"]);
        
        $entries = queryDB($query);
        
        $table_entries = "";
        $grand_total = 0;
        while ($row = pg_fetch_row($entries)) {
            $table_entries .= "<tr>";
            $grand_total += $row[4];
            foreach ($row as &$item) {
                $table_entries .= "<td>$item</td>";
            }
            $table_entries .= "</tr>";
        }
    }
    else {
        $detail_entry = array();
        $detail_entry["nomornota"] = "N/A";
        $detail_entry["namasupplier"] = "N/A";
        $detail_entry["waktu"] = "N/A";
        $detail_entry["nama"] = "N/A";
        $grand_total = 0;
        $table_entries = "";
    }
?>

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
				<a class="navbar-brand" href="index.php">SILUTEL</a>
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
	    <div class="col-md-1 text-right"><?php echo $detail_entry["nomornota"];?></div>
	    <div class="col-md-1"></div>
	    <div class="col-md-1">Total:</div>
	    <div class="col-md-2 text-right"><?php echo $grand_total;?></div>
	    </div>
	    <div class="row">
	    <div class="col-md-1">Waktu:</div>
	    <div class="col-md-2 text-right"><?php echo $detail_entry["waktu"];?></div>
	    <div class="col-md-1"></div>
	    <div class="col-md-1">Staf:</div>
	    <div class="col-md-2 text-right"><?php echo $detail_entry["nama"];?></div>
	    </div>
	    <div class="row">
	    <div class="col-md-1">Supplier:</div>
	    <div class="col-md-2 text-right"><?php echo $detail_entry["namasupplier"];?></div>
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
            <?php
                echo $table_entries;
            ?>
		</table>
		</div>
	</div>
</body>
