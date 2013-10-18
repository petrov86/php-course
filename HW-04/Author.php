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
                $sql = "SELECT * FROM books_authors AS ba
                        LEFT JOIN books AS b ON b.book_id = ba.book_id
                        LEFT JOIN books_authors AS bba ON bba.book_id = ba.book_id
                        LEFT JOIN authors AS a ON a.author_id = bba.author_id
                        WHERE ba.author_id =  '$author_id'
                        ORDER BY  `ba`.`book_id` DESC";
                $result = mysqli_query($link, $sql);
                
                if (!$result)
                    {
                        die( mysqli_error($link));    
                    }
                $row_count = mysqli_num_rows($result);
                if(!$row_count) echo "<tr><td colspan = '2'>Няма намерени записи от този автор</td></tr>";
                
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