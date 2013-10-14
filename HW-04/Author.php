<?php
$pageTitle='Books From Author';
include 'includes/header.php';

?>


<div class="row">
    <br/>
    <br/>
    <div class="span3 offset6">
         <a href="index.php"><input type="button" class="btn" value="Книги" /></a>
    </div>
    
    <div class="span8 offset5">
        </br>
         <table class="table">
                <tr>
                    <th>Книга</th>
                    <th>Автори</th>   
                </tr>
            <?php
            
            if ($_GET["author_id"])
            {
                $author_id = $_GET["author_id"];
                $sql = "SELECT  books.book_id, books.book_title, authors.author_name, authors.author_id FROM books
                        LEFT JOIN books_authors ON books.book_id = books_authors.book_id
                        LEFT JOIN authors ON authors.author_id = books_authors.author_id
                        WHERE books.book_title IN 
                        (
                              SELECT books.book_title FROM books 
                              LEFT JOIN books_authors ON books.book_id = books_authors.book_id 
                              LEFT JOIN authors ON authors.author_id = books_authors.author_id
                              WHERE books_authors.author_id = '$author_id' AND authors.author_id='$author_id'
                        )
                        ORDER BY  `books`.`book_id` DESC ";
                $result = mysqli_query($link, $sql);
                
                if (!$result)
                    {
                        die( mysqli_error($link));    
                    }
                $row_count = mysqli_num_rows($result);
                if(!$row_count) printAlert("Несъществуващ автор", "index.php");
                
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
            }
            
            else 
                {
                    navigate("index.php");  
                }
            ?>
                </table>
    </div>
</div>

<?php
include 'includes/footer.php';

?>