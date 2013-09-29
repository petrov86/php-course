<?php
$pageTitle='Login Page';
include 'includes/header.php';
session_start();
if (checkSession()) navigate("files.php");
?>


<div class="row">
    <br/>
    <div class="span3 offset12">
     <a href="register.php"><input type="button" class="btn" value="New Registration!" /></a>
    </div>
    <div class="span8 offset7">
         <h2>Please Sign In:</h2>
        <form action="files.php" method="post">	
		<p>
                    <label  for="username">Username:</label>
                    <input  type="text" name="username" type="text" />
                </p>

                <p>
                    <label  for="password">Password:</label>
                    <input type="password" name="password" type="password" />
                </p>
		<input class="btn-small" type="submit" value="Login!" />
		</form>
	</br>
		
	
    </div>
</div>

<?php
include 'includes/footer.php';
?>