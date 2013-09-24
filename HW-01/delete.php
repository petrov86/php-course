<?php

if(isset($_POST["delete"]))
{   
    $arr = file('data.txt');
    //$arr[$_POST["delete"]] = array_pop($arr);
    unset($arr[$_POST["delete"]]);
    $arr_to_string = implode($arr);
    if(file_put_contents('data.txt', $arr_to_string))
    {
       header("Location: index.php");  
    }        
    
}
?>
