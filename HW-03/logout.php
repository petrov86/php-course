<?php
	session_start();
	require_once "includes/functions.php";
	unset($_SESSION["loggedIn"]);
	unset($_SESSION["username"]);
        unset ($_SESSION["loggedIn"]);
	session_destroy();
	
	navigate("index.php");

?>