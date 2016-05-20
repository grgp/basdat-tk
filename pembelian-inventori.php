<html>
<head>
	<title>Pembelian Inventori</title>
	<script src="js/jquery-1.12.2.min.js"></script>
	<script src="js/script.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/theme.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>
</head>
<body style="margin:10">
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
					<li class="active"><a>PEMBELIAN INVENTORI<span class="sr-only">(current)</span></a></li>
				</ul>
				
				<ul class="nav navbar-nav navbar-right">
					<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li><span class="sr-only">(current)</span></a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="row">
		<div class="col-md-10 col-md-offset-1">
		<h1 class="text-center pushdown">SILUTEL - PEMBELIAN INVENTORI</h1>
    <div class = "row">
        <div class = "col-md-1">Tanggal:</div>
        <div class = "col-md-5"><input type="text" id="datepicker"></input></div>
		</div>
<!--
    <div class = "row">
        <div class = "col-md-3">URUTKAN BERDASARKAN:</div>
        <div class = "col-md-5">[<a id="sortwaktu">Waktu</a>,<a id="sortnomor">Nomor Nota</a>,<a id="sortsupplier">Supplier</a>,<a id="sortstaf">Staf</a>]</div>
        <div class = "col-md-2">[<a id="sortasc">Asc</a>,<a id="sortdesc">Desc</a>]</div>
	</div>
-->
    <div class="btn-group" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default">Waktu</button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default">Nomor Nota</button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default">Supplier</button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default">Staf</button>
        </div>
    </div>

    <button type="button" class="btn btn-default btn-ascdesc pull-right">Asc/Desc</button>
    
	<table id="datatable" border=1 class="table">
	<tr>
		<th>Nomor Nota</th>
		<th>Waktu</th>
		<th>Supplier</th>
		<th>Staf</th>
		<th></th>
	</tr>
	</table>
	<div id="tableselector"></div>
	</div>
	</div>
</body>
