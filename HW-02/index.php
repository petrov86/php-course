<?php
$pageTitle='Login Page';
include 'includes/header.php';
session_start();
?>

<div id="header">
    <h2>Please Sign In:</h2>
</div>

<div id="container"> 
    <div id="leftMenu">
            <a href="register.php"><input type="button" class="buttonBig" value="New Registration!" /></a>
    </div>   
    <div id="center">
        <form action="files.php" method="post">	
		<p>
                    <label  for="username">Username:</label>
                    <input type="text" name="username" type="text" />
                </p>

                <p>
                    <label  for="password">Password:</label>
                    <input type="password" name="password" type="password" />
                </p>
		<input class="buttonSmall" type="submit" value="Login!" />
		</form>
	</br>
		
	
    </div>
</div>

<?php
include 'includes/footer.php';
?>