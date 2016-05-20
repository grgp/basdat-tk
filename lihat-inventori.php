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
					<h1 style = "text-align:center"> SILUTEL - INVENTORI </h1>
					<h4> Urutkan Berdasarkan : </h4>
					<tr  class="active">
					  <th>Nama</th>
					  <th>Merk</th>
					  <th>Stok</th>
					</tr  class="active">
					<tbody>
					<tr>
					  <td>Handuk</td>
					  <td>Terry ABC</td>
					  <td>300</td>
					</tr>
					<tr>
					  <td>Pasta Gigi</td>
					  <td>Pepso ABC</td>
					  <td>250</td>
					</tr>
					<tr>
					  <td>Sikat Gigi</td>
					  <td>Oral ABC</td>
					  <td>400</td>
					</tr>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>