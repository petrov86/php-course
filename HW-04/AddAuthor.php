<?php
$pageTitle='Add New Author';
include 'includes/header.php';

?>


<div class="row">
    <br/>
    <div class="span1 offset1">
        <a href="index.php"><input type="button" class="btn" value="Всички Книги" /></a>
    <br/> 
    </div>
    <div class="span4 offset2">
         
        <div class="span4 offset2">
            <a href="AddBook.php"><input type="button" class="btn" value="Добави Книга" /></a> 
        </div> 
                 <div> 
                    
                    <form class="form-signin" action="" method="POST">
                    <label>Автор</label>
                    <input class="input" name="author" type="text" required="required" />
                    <br />
                    <input class="btn" type="submit" value="Добави" name="submit" />
                    </br>
                </div>
        </br>

         <table class="table">

                <tr>
                    <th>Автори</th>   
                </tr>
            <?php
                $sql = "SELECT author_name, author_id FROM authors";
                $result = mysqli_query($link, $sql);
                if (!$result)
                    {
                        die( mysqli_error($link));    
                    }
				$row_count = mysqli_num_rows($result);
                if(!$row_count) echo "<tr><td>Няма намерени записи</td></tr>";
				
                $arr = array();    
                while ( $row=mysqli_fetch_assoc($result) )
                    {
                       echo "<tr><td><a href='Author.php?author_id=" . $row["author_id"] ."'>" . $row['author_name']. "</a></td>";            
                    }
                
            ?>
        </table>
    </div>
</div>

<?php
include 'includes/footer.php';
if (isset($_POST["submit"]))
{
        $author = $_POST["author"];
        $author = trim($author);
        $author = mysqli_real_escape_string($link, $author);
  
        if(!isset($author))
                {
                        navigate("AddAuthor.php");
                        exit;
                }

        if( mb_strlen($author, "UTF-8" ) < 3)
                {
                        $message = 'Името трябва да е с дължина поне 3 символа';
                        printAlert($message, "");     
                } 
        else
        {
                $checkForDuplicatedAuthor = mysqli_query($link, "SELECT author_name FROM authors WHERE author_name = '$author' ");
                $row_count = mysqli_num_rows($checkForDuplicatedAuthor);

                if ($row_count)
                        {
                            $message = 'Името вече е заето!';
                            printAlert($message, "AddAuthor.php");    
                        }

                else 
                        {
                                $sql = "INSERT INTO authors (author_id, author_name) VALUES ('', '$author')";
                                $result = mysqli_query($link, $sql);
                                if (!$result) 
                                        {	  
                                                 die( mysqli_error($link));
                                                 $message = "Има проблем с добавянето на автора! Моля опитайте отново!";
                                                 printAlert ($message, "AddAuthor.php");
                                        }
                                else
                                        {
                                                 $message = 'Автора беше добавен успешно';
                                                 printAlert ($message, "index.php");
                                        }

                        }

        }					                  
                      
    
    
    
}   
?>