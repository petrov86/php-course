<?php
    $pageTitle='Register Page';
    include 'includes/header.php';
    session_start();
    if (checkSession()) navigate("index.php");
?>
  
        <div class="row">
                <br/>
                <div class="span3 offset3">
                 <a href="login.php"><input type="button" class="btn" value="Back" /></a>
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
                        
                elseif(mb_strlen($username) < 3)
                        {
                                $message = 'Името трябва да е с дължина поне 3 символа';
                                printAlert($message, "");     
                        } 
                              
                        
                elseif($password==$pass2)
                {	
                    
                        if (mb_strlen($password) < 3)
                            {
                                $message = 'Паролата трябва да е с поне 3 символа';
                                printAlert($message, ""); 
                                exit;
                            }
                            $password = md5($password);

						$checkForDuplicatedUser = mysqli_query($link, "SELECT user_name FROM users WHERE user_name = '$username' ");
						$row_count = mysqli_num_rows($checkForDuplicatedUser);
					
						if ($row_count)
							{
								$message = 'Името вече е заето!';
							    printAlert($message, "register.php");    
							}
						
						else 
						{
							$sql = "INSERT INTO users (user_id ,user_name, user_password) VALUES ( '', '$username', '$password')";
							$result = mysqli_query($link, $sql);
							if (!$result) 
								{	  
									 die( mysqli_error($link));
									 $message = "Има проблем с регистрацията ви! Моля опитайте отново!";
									 printAlert ($message, "register.php");
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