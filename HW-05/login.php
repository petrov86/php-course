<?php
$pageTitle='Login Page';
include 'includes/header.php';
session_start();
if (checkSession()) navigate("index.php");
?>


<div class="row">
    <br/>
    <div class="span3 offset12">
     <a href="register.php"><input type="button" class="btn" value="New Registration!" /></a>
    </div>
    <div class="span8 offset7">
         <h2>Please Sign In:</h2>
        <form action="" method="post">	
		<p>
                    <label  for="username">Username:</label>
                    <input  type="text" name="username" type="text" required="required" />
                </p>

                <p>
                    <label  for="password">Password:</label>
                    <input type="password" name="password" type="password" required="required"/>
                </p>
		<input class="btn" type="submit" value="Login!" />
		</form>
	</br>
		
	
    </div>
</div>

<?php
include 'includes/footer.php';
if(isset($_POST["username"], $_POST["password"]))
	{   
        
            $username=trim($_POST["username"]);
            $password=trim($_POST["password"]);
            $username = mysqli_real_escape_string($link, $_POST["username"]);
            $password = mysqli_real_escape_string($link, $_POST["password"]);
            $password=  md5($password);
			
            $sql="SELECT user_id, user_name, user_password FROM users WHERE user_name='$username' AND user_password='$password' LIMIT 1";
            $result = mysqli_query($link, $sql);
            if (!$result)
                {
                        die( mysqli_error($link));    
                }
            $row=mysqli_fetch_assoc($result);
            if ($row["user_name"]==$username && $row["user_password"]==$password)
                {       
                        SuccessLogin($row["user_name"], $row["user_id"] );
                        navigate("index.php");
                }
            else 
                {
                        $alert = "Грешно потребителско име или парола";
                        printAlert($alert);
                        exit;
                }    		
	}




?>