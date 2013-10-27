<?php
$pageTitle='Books';
include 'includes/header.php';
session_start();
?>


<div class="row">
    <div class="span3 offset1">
      <br/>
         <?php   if (checkSession()) 
             echo '<a href="logout.php"><input type="button" class="btn" value="Изход" /></a><br/>';
         ?>     <br/>
  
         <a href="AddBook.php"><input type="button" class="btn" value="Нова Книга" /></a><br/><br/>
         <a href="AddAuthor.php"><input type="button" class="btn" value="Нов Автор" /></a> <br/><br/>
    </div>
   
   
     
    <div class="span8 offset1">
        </br>
        </br>
        </br>
         <table class="table">
                <tr>
                    <th>Книга</th>
                    <th>Автори</th>   
                </tr>
            <?php
               
                $sql = "SELECT * FROM books
                LEFT JOIN books_authors as ba ON books.book_id = ba.book_id
                LEFT JOIN authors as a ON a.author_id = ba.author_id
                ORDER BY  `books`.`book_id` DESC ";
                $result = mysqli_query($link, $sql);
                if (!$result)
                    {
                        die( mysqli_error($link));    
                    }
				$row_count = mysqli_num_rows($result);
                if(!$row_count) echo "<tr><td colspan = '2'>Няма намерени записи</td></tr>";
                
				$arr = array();    
                while ( $row=mysqli_fetch_assoc($result) )
                    {
                        $arr[$row['book_title']][] = $row['author_name'];
                        $arrBooks[$row['book_title']] = $row['book_id'];
                        $arrAuthors[$row['author_name']] = $row['author_id'];
                    }
                foreach($arr as $key => $value)
                    {
                        echo "<tr><td><a href='books.php?book_id=" . $arrBooks[$key] . "'>" . $key . "</a></td>"; 
                        if (is_array($arr[$key]))
                            {   
                                $authors = "<td>";
                                foreach($arr[$key] as $val)
                                    {
                                       $authors .=  "<a href='Author.php?author_id=".$arrAuthors[$val]."'>". $val . "</a>  "; 
                                    }
                                $authors .="</td></tr>";
                                echo $authors;
                            }
                        else echo "<td><a href='Author.php?author_id=".$arrAuthors[$value]."'>" . $value . "</a></td></tr>";
                    }  
              
            ?>
                </table>
    </div>
</div>

<?php
include 'includes/footer.php';

?>