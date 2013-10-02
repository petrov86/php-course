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

function hasValidFile($arrayOfKeys) {
        foreach($arrayOfKeys as $currentKey)
                {
                        if (!isset($_FILES["filename"][$currentKey]))
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
                         //echo $row[$line_num][0]. " =>". $row[$line_num][1];
                         if ($row[$line_num][0] == $user && $row[$line_num][1] == $pass)
                             {
                                   return $user; 
                             }
                     }
                return false;
                
	}
        
function printAlert($alert, $where="index.php"){
        {   
            echo "<script>
            alert('" .$alert. "');
            window.location.href='".$where."';
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
			if (!file_exists($dir)) mkdir($dir, 0700);
            $files = scandir($dir, 1);
            return $files; // return array 
        }                

function removeBadFiles ($files){
		$bad = array(".", "..");
		$files = array_diff($files, $bad);
		return $files; 
}
       
        
function put_contents_in_table($filesArray, $dir)
        {
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
                                                <td colspan="3" >'.$EmptyMessage.'</td>
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
                                                 <td><a download href="'.$filePath.'">'.$file.'</a></td> 
                                                 <td>'.$fileSize.'</td>
                                                 </tr>';
                                        }        
                        }
                echo "</table>";
        }
        
        
function file_upload_error_message($error_code) 
{
    switch ($error_code)
    { 
        case 0:
            return 'There is no error, the file uploaded with success.';
        case 1: 
            return 'The uploaded file exceeds the upload_max_filesize directive in php.ini'; 
        case 2: 
            return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form'; 
        case 3: 
            return 'The uploaded file was only partially uploaded'; 
        case 4: 
            return 'No file was uploaded'; 
        case 6: 
            return 'Missing a temporary folder'; 
        case 7: 
            return 'Failed to write file to disk'; 
        case 8: 
            return 'File upload stopped by extension'; 
        default: 
            return 'Unknown upload error';     
    } 
} 
?>
