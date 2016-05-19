<?php
	function queryDB($query) {
		$conn = pg_connect("user=postgres dbname=postgres");

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