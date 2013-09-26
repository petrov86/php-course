<?php

function checkSession() {
        return isset($_SESSION["loggedIn"]) && ($_SESSION["loggedIn"] == true);
}
        
function printAlert($alert){
    echo "<script>alert('" .$alert. "');</script>";  
}

function SuccessLogin($user) {
		$_SESSION["loggedIn"] = true;
		$_SESSION["username"] = $user;
		header("Location: files.php");
	}


?>
