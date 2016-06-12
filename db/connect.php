<?php
	function queryDB($query) {
		$conn = pg_connect("host=dbpg.cs.ui.ac.id port=5432 user=d207 dbname=d207 pass=bdd0722015");

		if (!$conn) {
		  echo "An error occurred.\n";
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
