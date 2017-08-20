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

echo '<table><th>Author</th><th>Title</th><th>ID</th><th>Rating</th>
<th>Cover</th>';
foreach($xml->book as $book) {
    $book->addChild('rating', rand(1,5));
    $input = ['Hardcover', 'Paperback'];
    $value = array_rand($input, 1);
    $book->addAttribute('cover', $input[$value]);
    echo '<tr><td>'.$book->author.'</td> <td>'.$book->title.'</td> <td>'.
        $book->attributes()['id'].'</td> <td>'.$book->rating.'</td> <td>'.
        $book->attributes()['cover'].'</td><tr>';
}
echo '</table><br>'.$xml->asXML();

?>