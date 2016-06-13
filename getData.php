<?php
	header('Content-type: application/json');
	
	require "db/connect.php";
	
	$result = queryDB("SELECT * FROM silutel.Inventori");
	
	$data = '{"post":[';
	while($row = pg_fetch_row($result)){
		$data = $data.'{"nama":"'.$row[0].'","merk":"'.$row[1].'","stok":"'.$row[2].'"},';
	}

	$data = rtrim($data, ",");
	$data = $data.']}';
	
	echo $data;
?>