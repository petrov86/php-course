<?php
session_start();
$pageTitle='Upload';
include 'includes/header.php';
if (!checkSession()) navigate("index.php");
?>

<div id="container">
        <div id="header">   
            <h2>Изберете файл:</h2>
        </div>
        <div id="leftMenu">     
            <br/>
            <a href="files.php"><input type="button" class="btn" value="Back!" /></a><br/>   
        </div>
        <div id="page">
               
                     <form enctype="multipart/form-data" action="handle_upload.php" method="POST">	
                                 <input type="hidden" name="MAX_FILE_SIZE" value="16000000" />  <br/>                                        
                                 <input name="userfile" type="file" value="Choose a file" /> <br/>  
                                 <div><br/>
                                 <input class="btn" type="submit" value="Потвърдете" />
                                 </div>
                     </form>	    
  
        </div>
</div>

<?php
include 'includes/footer.php';



?>