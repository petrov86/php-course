<a href="authors.php">Автори</a>
<a href="add_book.php">Нова книга</a>

<table border="1"><tr><td>Книга</td><td>Автори</td></tr>
    
    
<?php

foreach ($data['result'] as $row) {
    echo '<tr><td>' . $row['book_title'] . '</td>
        <td>';
    $arr = array();
    foreach ($row['authors'] as $k => $va) {
        $arr[] = '<a href="index.php?author_id=' . $k . '">' . $va . '</a>';
    }
    echo implode(' , ', $arr) . '</td></tr>';
}
echo '</table>';
?>