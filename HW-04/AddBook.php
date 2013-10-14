<?php
$pageTitle='Add New Author';
include 'includes/header.php';

?>


<div class="row">
      <br/>
    <div class="span1 offset1">
        <a href="index.php"><input type="button" class="btn" value="Книги" /></a>
    <br/> 
    </div>
    <div class="span4 offset2">
   
               
                    <form class="form-signin" action="" method="POST">
                    <label>Книга</label>
                    <input class="input" name="book" type="text" required="required" />
                    <br />
                    <select  name="authors[]" size="6" multiple="yes" required="required" >
                        <?php
                                $sql = "SELECT author_name, author_id FROM authors";
                                $result = mysqli_query($link, $sql);
                                if (!$result)
                                    {
                                        die( mysqli_error($link));    
                                    }  
                                while ( $row=mysqli_fetch_assoc($result) )
                                    {
                                       echo "<option value='" . $row['author_id'] . "'>" . $row['author_name']. "</option>";
                                    }
                        ?>
                     </select>
                    <br/>
                    <input class="btn" type="submit" value="Добави" name="submit" />
                    
              
                </br>
    </div>
</div>

<?php
include 'includes/footer.php';
if (isset($_POST["submit"]))
{  
       
        $book = $_POST["book"];
        $book = trim($book);
        $book = mysqli_real_escape_string($link, $book);
        $authors = $_POST["authors"];
        
        
        if(!isset($book, $authors))
                {
                        navigate("AddBook.php");
                        exit;
                }

        if( mb_strlen($book, "UTF-8" ) < 3)
                {
                        $message = 'Името трябва да е с дължина поне 3 символа';
                        printAlert($message, "");     
                } 
        else
        {
                $checkForDuplicatedBook= mysqli_query($link, "SELECT book_title FROM books WHERE book_title = '$book' ");
                $row_count = mysqli_num_rows($checkForDuplicatedBook);

                if ($row_count)
                        {
                            $message = 'Има такава книга!';
                            printAlert($message, "AddBook.php");    
                        }

                else 
                        {
                                $sqlBook = "INSERT INTO books (book_id, book_title) VALUES ('', '$book')";
                                $result = mysqli_query($link, $sqlBook);
                                if (!$result) 
                                    {	  
                                             die( mysqli_error($link));
                                             $message = "Има проблем с добавянето на книгата! Моля опитайте отново!";
                                             printAlert ($message, "AddBook.php");
                                    }
                                $book_id = mysqli_insert_id($link);        
                                foreach ($authors as $author_id)
                                    {
                                        $sql = "INSERT INTO books_authors (book_id, author_id) VALUES ('$book_id', '$author_id')";
                                        $res = mysqli_query($link, $sql);
                                         if (!$res) 
                                            {	  
                                                     die( mysqli_error($link));
                                                     $message = "Има проблем с добавянето на книгата! Моля опитайте отново!";
                                                     printAlert ($message, "AddBook.php");
                                                     exit;
                                            }
                                    }
                                
                                    $message = 'Книгата беше добавена успешно';
                                    printAlert ($message, "index.php");
                                        

                        }

        }					                  
                      
 
    
    
}   
?>