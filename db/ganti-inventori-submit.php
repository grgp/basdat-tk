<?php
	
  session_start();
  
  if(!isset($_SESSION["userlogin"])){
      header("Location: login.php");
  }
  else {
      if($_SESSION["role"] != "MG" && $_SESSION["role"] != "IN") {
          header("Location: lihat-laundry.php"); //anggap ke home
      }
  }

  require "connect.php";

	$gantinama = $_POST['gantinama'];
	$gantimerk = $_POST['gantimerk'];
	$gantiemail = $_SESSION["userlogin"];
	$gantijumlah = $_POST['gantijumlah'];
	$gantialasan = $_POST['gantialasan'];

	$result = queryDB("INSERT INTO SILUTEL.STAF_MENGGANTI_INVENTORI VALUES ('$gantinama', '$gantimerk', '$gantiemail', 'now()', '$gantijumlah', '$gantialasan')");

	header("Location: ../ganti-inventori.php");

/*
	insert into silutel.staf_mengganti_inventori values ('')
*/

?>