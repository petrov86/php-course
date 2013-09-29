<?php
session_start();
require_once "includes/functions.php";
$randomst=md5(crypt("devil"));
$username=$_SESSION["username"];

$d=date("Y-m-d H:i:s");

if (isset($_FILES))
{       
        $filesKeys=array($_FILES["userfile"]["userfile"], $_FILES["userfile"]["name"], $_FILES["userfile"]["type"], $_FILES["userfile"]["size"], $_FILES["userfile"]["tmp_name"]);
        if(!hasData($filesKeys)) navigate ("upload.php");
        $uploaddir = './users/' . $username;
        if (!file_exists($uploaddir)) mkdir($uploaddir, 0700);
        $uploadfile = $uploaddir ."/".$username.$randomst.".".getFileExtension($_FILES['userfile']['name']);
        
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
        $message = "Select a file first!";
        printAlert($message, "upload.php");
    
    }
?>