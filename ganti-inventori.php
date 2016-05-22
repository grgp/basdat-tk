<?php
	require 'db/connect.php';
?>

<html>
	<head>
		<title>Ganti Inventori</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/theme.css">
		<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flat-ui/2.3.0/css/flat-ui.css"> -->

		<link href='https://fonts.googleapis.com/css?family=Lato:400,700,300,900' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

		<script>
		function showMerk(str) {
	    if (str == "") {
	    	document.getElementById("form-merk").innerHTML = "";
        return;
	    } else {
	        if (window.XMLHttpRequest) {
	            xmlhttp = new XMLHttpRequest();
	        }
	        xmlhttp.onreadystatechange = function() {
	            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	                document.getElementById("form-merk").innerHTML = xmlhttp.responseText;
	            }
	        };
	        xmlhttp.open("GET","db/ganti-inventori-merk.php?i=" + str,true);
	        xmlhttp.send();
		    }
			}
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
						<li class="active"><a>Ganti Inventori<span class="sr-only">(current)</span></a></li>
					</ul>
					
					<ul class="nav navbar-nav navbar-right">
						<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li><span class="sr-only">(current)</span></a></li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container pushdown">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="row">
						<h3 class="text-center">Ganti Inventori</h3>

						<form role="form">
						  <div class="form-group">
						    <label>Nama Inventori</label>
							  <select class="form-control" id="form-nama" onchange="showMerk(this.value)">
							  	<?php
										$result = queryDB("SELECT nama FROM silutel.inventori ORDER BY nama asc");

										while ($row = pg_fetch_row($result)) {
											echo '<option value="' . $row[0] . '">' . $row[0] . '</option>';
										}
									?>
								</select>
						  </div>
						  <div class="form-group">
						    <label>Merk</label>
							  <select class="form-control" id="form-merk">

								</select>
						  </div>
						  <div class="form-group">
						    <label>Jumlah</label>
						    <input type="text" class="form-control">
						  </div>
						  <div class="form-group">
							  <label for="comment">Comment:</label>
							  <textarea class="form-control" rows="5" id="comment"></textarea>
							</div>
						  <button type="submit" class="btn btn-default">Submit</button>
						</form>
					</div> <!-- end row -->
				</div> <!-- end col -->
			</div>
		</div> <!-- end container -->
	</body>

</html>