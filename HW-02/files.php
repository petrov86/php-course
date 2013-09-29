<?php
    session_start();
    $pageTitle='Files';
    include 'includes/header.php';
    if(checkSession()) 
        {
            $username=$_SESSION["username"];
            $dir = './users/' . $username;
        } 
    else
        {   
            $postKeys=array("username", "password");
            if(!hasData($postKeys))
                {
                        navigate("index.php");
                        exit;
                }
                
            if($user = checkLogin($_POST["username"], $_POST["password"]))
                    {
                            SuccessLogin($user);
                    }

            else 
                    {                           
                            printAlert("Wrong username or password");
                    }   
           
        }

?>

<div id="container"> 
    
  
     <div id="header">   
        <h2>Списък на файловете:</h2>
     </div>
     <div id="leftMenu">
         <a href="logout.php"><input type="button" class="btn" value="Logout!" /></a>
     </div>
     <div id="rightMenu">
         <a href="upload.php"><input type="button" class="btn" value="Upload New File" /></a>
     </div>
        <div id="page">
                <?php 
                    put_contents_in_table(listFilesInDirectory($dir), $dir);
                ?>
        </div> 
   
 
</div>

<?php
    include 'includes/footer.php';
?>