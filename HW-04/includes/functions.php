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
      
     
?>
