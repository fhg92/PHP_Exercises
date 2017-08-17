<style>
    
    table {
        border-collapse: collapse;
    }
    
    table, td, tr, th {
        border: 1px solid black;
    }
    
    th {
        text-align: left;
    }

</style>

<?php

$xml = simplexml_load_file('Books.xml');

echo '<table><th>Author</th><th>ID</th>';
foreach($xml->book as $book) {
    echo '<tr><td>'.$book->author.'</td> <td>'.$book->attributes().'</td><tr>';
}
echo '</table>';

?>