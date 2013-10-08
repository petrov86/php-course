<?php
    $pageTitle='Register Page';
    include 'includes/header.php';
    session_start();
    if (checkSession()) navigate("messages.php");
?>
  
        <div class="row">
                <br/>
                <div class="span3 offset3">
                 <a href="index.php"><input type="button" class="btn" value="Back" /></a>
                </div>
                <div class="span8 offset7">
                <h2>Create a New Account</h2>           
		<form class="form-signin" action="" method="POST">
		<label for="username">Username:</label>
		<input class="input-large" id="username" name="username" type="text" required="required" />
		<br />
		<label for="pass">Password:</label>
		<input class="input-large" id="pass" name="pass" type="password" required="required"/>
		<br />
		<label for="pass2">Re-type password:</label>
		<input class="input-large" id="pass2" name="pass2" type="password" required="required"/>
		<br />
		<input class="btn btn-large " type="submit" value="Register" name="submit" />
		</br>
		</br>
		
		</form>
	</div>
	</div>
<?php

if (isset($_POST["submit"]))
{   
                $username=$_POST["username"];
                $password=$_POST["pass"];
                $pass2=$_POST["pass2"]; 
                $username = trim($username);
                $username = mysqli_real_escape_string($link, $username);
                $password = trim($password);
                $password = mysqli_real_escape_string($link, $password);
                
                
                if(!isset($username, $password, $pass2 ))
                        {
                                navigate("register.php");
                                exit;
                        }
                        
                elseif(mb_strlen($username) <= 4)
                        {
                                $message = 'Името трябва да е с дължина поне 5 символа';
                                printAlert($message, "");     
                        } 
                              
                        
                elseif($password==$pass2)
                {	
                    
                        if (mb_strlen($password) <= 4)
                            {
                                $message = 'Паролата трябва да е с поне 5 символа';
                                printAlert($message, ""); 
                                exit;
                            }
                        
                        $getRowsBefore = mysqli_query($link, "SELECT id FROM users") or die(mysql_error());
                        $rowsBefore = mysqli_num_rows($getRowsBefore);
                        
                        $sql = "INSERT INTO users (id ,username, password)
                                SELECT * FROM (SELECT '', '$username', '$password') AS tmp
                                WHERE NOT EXISTS ( SELECT username FROM users WHERE username = '$username') 
                                LIMIT 1;";
                        
                        $result = mysqli_query($link, $sql);
                       
                        
                        if (!$result) 
                            {
                                 $message = "Има проблем с регистрацията ви! Моля опитайте отново!";
                                 printAlert ($message, "register.php");
                            }
                        else 
                            {   
                                
                                $getRowsAfter = mysqli_query($link, "SELECT id FROM users") or die(mysql_error());
                                $rowsAfter = mysqli_num_rows($getRowsAfter);
                                if ($rowsAfter == $rowsBefore) 
                                    { 
                                          $message = 'Името вече е заето!';
                                          printAlert($message, "register.php");     
                                    }
                                else
                                    {
                                        $message = 'Вие се регистрирахте успешно';
                                        printAlert ($message, "index.php");                                  
                                    }
                            }
                }
                else 
                {	
                        $message="Invalid data";
                        printAlert($message, "register.php");
                }
        }
?>

<?php
    include 'includes/footer.php';
?>