<?php

function checkSession() {
        return isset($_SESSION["loggedIn"]) && ($_SESSION["loggedIn"] == true);
}

        
function printAlert($alert, $where="index.php"){
        {   
            echo "<script>
            alert('" .$alert. "');
            window.location.href='".$where."';
            </script>"; 
        }
     
}

function SuccessLogin($user, $userId) {
		$_SESSION["loggedIn"] = true;
		$_SESSION["username"] = $user;
                $_SESSION["userId"] = $userId;
	}

function navigate($where)
	{
		header("Location: $where");
	}
      
     

?>
