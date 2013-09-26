<?php
    $pageTitle='Files';
    include 'includes/header.php';
    session_start();
    if (!isset( $_POST["username"], $_POST["password"]) || empty( $_POST["username"]) || empty( $_POST["password"]))
        {
            header("Location: index.php");
        }
    else
        {
           $res = file('users.txt');
           foreach ($res as $line_num => $value)
                {
                        $columns =  explode('!', $value);
                        if ($columns[0] == $_POST["username"] && $columns[1] == $_POST["password"])
                            {
                                SuccessLogin($_POST["username"]);
                            }
                }
        }
var_dump($_POST);
?>

<div id="header">
    <h2>Uploaded files are:</h2>
</div>

<div id="container"> 
   
	
 
</div>

<?php
    include 'includes/footer.php';
?>