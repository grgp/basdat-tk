<?php
	function queryDB($query) {
		$conn = pg_connect("host=dbpg.cs.ui.ac.id port=5432 dbname=d207 user=d207 password=bdd0722015");
		// $conn = pg_connect("user=postgres dbname=postgres");

		if (!$conn) {
		  echo "An error occurred. Connection cannot be established.\n";
		  exit;
		}

		$result = pg_query($conn, $query);
		if (!$result) {
		  echo "An error occurred.\n";
		  exit;
		}

		return $result;
	}
?>
