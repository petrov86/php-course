<?php

      
function printAlert($alert, $where="index.php"){
        {   
            echo "<script>
            alert('" .$alert. "');
            window.location.href='".$where."';
            </script>"; 
        }
     
}

function navigate($where)
	{
		header("Location: $where");
	}
      
function checkSession() {
        return isset($_SESSION["loggedIn"]) && ($_SESSION["loggedIn"] == true);
}



function SuccessLogin($user, $userId) {
		$_SESSION["loggedIn"] = true;
		$_SESSION["username"] = $user;
                $_SESSION["userId"] = $userId;
	}

function Comment_Form(){
       echo '<br/>
        <br/>
        <br/>
        <form class="form-signin" action="" method="POST">
        <label>Коментар</label>
        <textarea class="input" name="comment" rows="4" cols="25" type="text" required="required"></textarea>
        <br />
        <input class="btn" type="submit" value="Добави" name="submit" />
        </br>';
    
    
} 
        
        
?>
