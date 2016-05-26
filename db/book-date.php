<?php
	$redir = ".." . "?d=" . $cdateval .	"&s=" . $sortby . "&by=" . $ascdesc . "&p=" . $pagenum;
	$loc = $_GET["datepicker"];
	header("Location: $loc");
?>