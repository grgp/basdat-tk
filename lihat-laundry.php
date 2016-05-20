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
		<script> 
		$('.datepicker').pickadate()
		</script>	
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
					<h1 style="text-align:center">SILUTEL - LAUNDRY</h1>
					<form action="action_page.php">
  					<input type="date" name="bday" style="float: left";>
					</form>
	    <div class="btn-group" role="group" aria-label="..." style="margin-left: 10px;">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default">Nama</button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default">Merk</button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default">Staf</button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default">Waktu</button>
        </div>
    </div>

    <button type="button" class="btn btn-default btn-ascdesc pull-right">Asc/Desc</button>
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
					<tr>
					  <td>Handuk</td>
					  <td>ABC</td>
					  <td>Winnie</td>
					  <td>05/05/2016 11:32</td>
					  <td>15</td>
					  <td>5,000</td>
					  <td>75,000</td>
					  <td>06/05/2016 12:34</td>
					</tr>
					<tr>
					  <td>Handuk</td>
					  <td>BCD</td>
					  <td>Dipsy</td>
					  <td>05/05/2016 10:45</td>
					  <td>10</td>
					  <td>5,000</td>
					  <td>50,000</td>
					  <td>06/05/2016 12:22</td>
					</tr>
					<tr>
					  <td>Selimut</td>
					  <td>CDE</td>
					  <td>Lala</td>
					  <td>05/05/2016 11:03</td>
					  <td>15</td>
					  <td>10,000</td>
					  <td>150,000</td>
					  <td>06/05/2016 12:55</td>
					</tr>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>