<?php
$pageTitle='Comments';
include 'includes/header.php';
session_start();
if (!isset($_GET['book_id']))    printAlert("Несъществуваща книга");

?>

<div class="row">
    <div class="span3 offset1">
        <br/> 
         <?php   if (checkSession()) 
             echo '<a href="logout.php"><input type="button" class="btn" value="Изход" /></a><br/>';
         ?>         
         <br/>
        <a href="index.php"><input type="button" class="btn" value="Всички Книги" /></a>
         <br/> 
    </div>
   <br/>

    <div class="span6 offset0">

            <?php
                $book_id = $_GET['book_id'];    
                $sql = "SELECT * FROM books
                LEFT JOIN books_authors as ba ON books.book_id = ba.book_id
                LEFT JOIN authors as a ON a.author_id = ba.author_id
                LEFT JOIN comments as c ON c.book_id = books.book_id
                LEFT JOIN users as u ON u.user_id = c.user_id
                WHERE books.book_id =  '$book_id'
                ORDER BY  `c`.`comment_id` ASC  ";
                $result = mysqli_query($link, $sql);
                if (!$result)
                    {
                        die( mysqli_error($link));    
                    }

                $row_count = mysqli_num_rows($result);
                if(!$row_count) 
                    {
                        echo "Няма намерени записи";
                        exit;
                    }

  
                echo "<table class='table'><tr><th>Книга</th><th>Автори</th></tr>";
                $commentId_old = -1;
                while ( $row=mysqli_fetch_assoc($result) )
                    {   
                        $book = $row['book_title'];
                        $arrAuthors[$row['author_name']] = $row['author_id'];
                       
                        if ($commentId_old != $row['comment_id'] )
                        {
                            $arrComments[] = $row['comment'];
                            $arrUserName[] = $row['user_name'];
                            $arrCommentTime[] = $row['comment_time'];
                            $commentId_old = $row['comment_id'];
                        }
                    }
                  
                    
                echo "<tr><td>" . $book. "</td>"; 
                if (is_array($arrAuthors))
                    {
                        $authors = "<td>";
                        foreach($arrAuthors as $key => $value)
                            {
                                 $authors .=  "<a href='Author.php?author_id=".$value."'>". $key . "</a>  "; 
                            }
                        $authors .="</td></tr>";
                        echo $authors;
                    }
                 else echo "<td><a href='Author.php?author_id=".$arrAuthors[$value]."'>" . $value . "</a></td></tr>";
                 echo "</table></br>"; 
         
//                 echo "<pre>";
//                 print_r($arrComments);
//                 echo "</pre>";
                 
                 if (!empty($arrComments[0]))
                    {
                         for ($i = 0; $i < count($arrComments); $i++)
                            {
                                 echo "<h4>" . $arrComments[$i] . "</h4><br/> commented on: " . $arrCommentTime[$i] . ", By " . $arrUserName[$i] .  "<hr/>"; 
                            } 
                    }
                elseif (empty($arrComments[0])) {
                    echo "Няма добавени коментари";
                }
                
       
            ?>
        </table>
        </br>
    </div>
   <div class="span3 offset1"> 
       <?php 
            if (checkSession()) Comment_Form ();
            else echo '<label>За да добавите коментар трябва да сте логнат</label><a href="login.php"><input type="button" class="btn" value="Вход" /></a>';
        ?>
   </div>
</div>

<?php
include 'includes/footer.php';
if (isset($_POST["submit"]))
{
        $comment = $_POST["comment"];
        $comment = trim($comment);
        $comment = mysqli_real_escape_string($link, $comment);
        $userId = $_SESSION["userId"];
        $time = date("Y-m-d H:i:s");

        if( mb_strlen($comment, "UTF-8" ) < 3)
                {
                        $message = 'Коментара трябва да е с дължина поне 3 символа';
                        printAlert($message, "");     
                } 
        else
        {
       
               
                $sql = "INSERT INTO comments (comment_id, comment ,book_id, user_id, comment_time ) VALUES ('', '$comment', '$book_id' ,'$userId', '$time' )";
                $result = mysqli_query($link, $sql);
                if (!$result) 
                        {	  
                                 die( mysqli_error($link));
                                 $message = "Има проблем с добавянето на коментара! Моля опитайте отново!";
                                 printAlert ($message, "books.php");
                        }
                else  
                        {
                            $where = "books.php?book_id=".$book_id;
                            navigate ($where); 
                        }      

        }					                  
                      
    
    
    
}   

