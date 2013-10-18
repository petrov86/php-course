<?php
$pageTitle='Books';
include 'includes/header.php';

?>


<div class="row">
    <br/>
    <br/>
    <div class="span3 offset6">
         <a href="AddBook.php"><input type="button" class="btn" value="Нова Книга" /></a>
    </div>
    <div class="span3 offset0">
         <a href="AddAuthor.php"><input type="button" class="btn" value="Нов Автор" /></a>
    </div>
     
    <div class="span8 offset5">
        </br>
         <table class="table">
                <tr>
                    <th>Книга</th>
                    <th>Автори</th>   
                </tr>
            <?php
                /*$sql = "SELECT  books.book_id, books.book_title, authors.author_name, authors.author_id FROM books
                        LEFT JOIN books_authors ON books.book_id = books_authors.book_id
                        LEFT JOIN authors ON authors.author_id = books_authors.author_id
                        WHERE books.book_title IN 
                        (SELECT books.book_title FROM books LEFT JOIN books_authors ON books.book_id = books_authors.book_id 
                              LEFT JOIN authors ON authors.author_id = books_authors.author_id )
                        ORDER BY  `books`.`book_id` DESC ";*/
						
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
                        $arrAuthors[$row['author_name']] = $row['author_id'];
                    }
                foreach($arr as $key => $value)
                    {
                        echo "<tr><td>" . $key. "</td>"; 
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