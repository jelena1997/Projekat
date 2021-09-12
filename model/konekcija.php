<?php

  $server="localhost";
  $user="root";
  $pass="";
  $db="agencija";


  error_reporting(E_ALL | E_STRICT);
	ini_set("display_errors", 0);
	ini_set("log_errors", 1);
	ini_set("error_log", "logs.log");

  $mysqli = mysqli_connect($server, $user, $pass, $db);

  session_start();

  if(!isset($_SESSION['korisnik'])){
    $_SESSION['korisnik'] = array();
  }
  if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
  }

?>