<?php
	$pageTitle='Add message';
        include 'includes/header.php';
        session_start();
        
	if(!checkSession()) 
            {
		navigate ("index.php");
		exit;
            }
	$userId = $_SESSION["userId"];
	if(isset($_POST["message"])) 
            {
		$message = mysqli_real_escape_string($link, $_POST["message"]);
		$summary = mysqli_real_escape_string($link, $_POST["summary"]);
		$messageTime = date( 'Y-m-d H:i:s');
		
		$sql = "INSERT INTO messages(message_id, summary, message, creation_date, user_id) VALUES('', '$summary', '$message', '$messageTime', '$userId')";
		$res = mysqli_query($link, $sql);
		if($res) 
                {
                    $alert = "Съобщението беше добавено успешно!"; 
                    printAlert($alert, $where="messages.php");
                    exit;
                }
                else
                {
                    die( mysqli_error($link));
                    $alert = "Съобщението не беше добавено!"; 
                    //printAlert($alert, $where="postmessage.php");
                }
            }
?>
<html>
<head>
	<title>Post a message!</title>
	<link rel="stylesheet" type="text/css" href="main.css">
	<style type="text/css">
		textarea {
			width: 500px;
			height: 250px;
		}
	</style>
</head>
<body>
	<div class="row">
            
            <div class="span3 offset12">
                <a href="logout.php"><input type="button" class="btn" value="Logout!" /></a>
            </div>
            <div class="span3 offset2">
                <a href="messages.php"><input type="button" class="btn" value="Back!" /> </a>
            </div>
            <div class="span8 offset5">
                  <form method="post" action="">
                          <input placeholder="Enter a title" type="text" name="summary" required></input><br />
                          <textarea placeholder="Enter your message" name="message" required></textarea>
                          <br />
                          <input type="submit" value="Send your message!" />
                  </form>   
           </div>
            
	</div>
</body>
</html>