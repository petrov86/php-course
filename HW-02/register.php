<?php
    $pageTitle='Register Page';
    include 'includes/header.php';
    session_start();
    if (checkSession()) navigate("files.php");
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
                $postKeys=array("username", "pass", "pass2");
                if(!hasData($postKeys))
                        {
                                navigate("register.php");
                                exit;
                        }
                        
                elseif(mb_strlen($username) < 4)
                        {
                                $message = 'Името трябва да е с дължина поне 4 символа';
                                printAlert($message, "");     
                        } 
                        
                elseif($password==$pass2)
                {	
                    
                        if (mb_strlen($password) < 4)
                            {
                                $message = 'Паролата трябва да е с поне 4 символа';
                                printAlert($message, "");  
                            }
                        $message = 'Вие се регистрирахте успешно';
                        $username = trim($username);
                        $username = str_replace('!', '', $username);
                        $password = trim($password);
                        $password = str_replace('!', '', $password);
                        $input = $username.'!'.$password.'!'."\n";
                        if (file_put_contents('users.txt', $input, FILE_APPEND)) printAlert ($message, "index.php");
                        else 
                            {
                                $message = "Има проблем с регистрацията ви! Моля опитайте отново!";
                                printAlert ($message, "register.php");
                            }
                }

                else 
                {	
                        $message="Invalid data";
                        $error=  printAlert($message, "register.php");
                }
        }
?>

<?php
    include 'includes/footer.php';
?>