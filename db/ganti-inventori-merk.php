<?php
	require '../db/connect.php';
	$inventori = htmlspecialchars($_GET["i"]);
	$result = queryDB("SELECT merk FROM silutel.inventori WHERE nama='$inventori' ORDER BY merk asc");

	while ($row = pg_fetch_row($result)) {
		echo '<option value="' . $row[0] . '">' . $row[0] . '</option>';
	}
?>