<?php
	session_start();
	require_once "includes/functions.php";
	unset($_SESSION["loggedIn"]);
	unset($_SESSION["username"]);
	session_destroy();
	
	navigate("index.php");

?>