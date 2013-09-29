<?php

function checkSession() {
        return isset($_SESSION["loggedIn"]) && ($_SESSION["loggedIn"] == true);
}

function hasData($arrayOfKeys) {
        foreach($arrayOfKeys as $currentKey)
                {
                        if (!isset($_POST[$currentKey]))
                                {
                                        return false;
                                }
                }
                return true;
}  

function checkLogin($user, $pass) 
	{	
		//filter input data
		$user=mysql_real_escape_string($user);
		$pass=mysql_real_escape_string($pass);
                $res = file('users.txt');
                foreach ($res as $line_num => $value)
                     {
                         $row[$line_num] =  explode('!', $value);
                         echo $row[$line_num][0]. " =>". $row[$line_num][1];
                         if ($row[$line_num][0] == $user && $row[$line_num][1] == $pass)
                             {
                                   return $user; 
                             }
                     }
                return false;
                
	}
        
function printAlert($alert, $where=false){
    if ($where)
        {
            echo "<script>
              alert('" .$alert. "');
              window.location.href='".$where."';
            </script>"; 
        }
    
    else
        {
             echo "<script>
              alert('" .$alert. "');
            </script>"; 
        
        }
     
}

function SuccessLogin($user) {
		$_SESSION["loggedIn"] = true;
		$_SESSION["username"] = $user;
		header("Location: files.php");
	}

function navigate($where)
	{
		header("Location: $where");
	}

        
        
function getFileExtension($filename)
		{
			$ext="";
			$a=strrev($filename);
			for($i=0; $i<strlen($a); $i++)
				{
					if($a[$i]==".")
						{
							break;
						}
					$ext.=$a[$i];
				}
		return strrev($ext);
		}
                
function listFilesInDirectory($dir)
        {
            $files = scandir($dir);
            return $files;
        }                

        
        
function put_contents_in_table($filesArray, $dir)
        {
            $totalSum = 0.00;
            echo "<table class='table table-hover' >
                <tr>
                    <th></th>
                    <th>Файл</th> 
                    <th>Размер</th>
                </tr>";
		if (empty($filesArray))
                        {	
				$EmptyMessage = "Нямате качени файлове!!!";
				$EmptyRow = '<tr>
                                                <td colspan="3">'.$EmptyMessage.'</td>
                                            </tr>';
                                echo  $EmptyRow;
			}
			
                else
                        {                                
                                foreach ($filesArray as $file_num => $file)
                                        {  
                                            $filePath = $dir.'/'.$file; 
                                            $fileSize = filesize($filePath) . ' bytes';
                                            echo '<tr>
                                                 <td>'.++$file_num.'</td>
                                                 <td><a href="'.$filePath.'">'.$file.'</a></td> 
                                                 <td>'.$fileSize.'</td>
                                                 </tr>';
                                        }        
                        }
                echo "</table>";
        }
?>
