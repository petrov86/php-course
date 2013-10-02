<?php
session_start();
require_once "includes/functions.php";
$username=$_SESSION["username"];
$postMax = ini_get('post_max_size'); 
$postMax = (int)$postMax*1024*1024;


if ($_SERVER["CONTENT_LENGTH"] > $postMax) 
{
    $message = "File is bigger than " .$postMax;
	echo $_SERVER["CONTENT_LENGTH"] ."--->".$postMax;
	echo "<br/>";
    printAlert($message, "upload.php");
}
 

if ($_FILES["userfile"]["error"] == 0)
{			
			if (strlen($_FILES["userfile"]["name"])== 0)  navigate("upload.php");
			$uploaddir = './users/' . $username;
			if (!file_exists($uploaddir)) mkdir($uploaddir, 0700);
			$fileName = $_FILES["userfile"]["name"];
			$uploadfile = $uploaddir ."/".$fileName;

			if (file_exists($uploadfile)) 
					{
							$message="The file already exists!!!";								
							printAlert($message, "files.php");
							exit;

					} 
			elseif (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) 
					{
							$message="File is valid, and was successfully uploaded.";
							printAlert($message, "files.php");
							exit;
					} 
			else 
					{
							$message = "Possible file upload attack!\n";
							printAlert($message, "files.php");
							exit;
					}

}

else
{
		$message = file_upload_error_message($_FILES['userfile']['error']); 
		printAlert($message, "upload.php");
		exit;
}


?>