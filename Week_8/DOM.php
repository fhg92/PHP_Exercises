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

$dom = new DOMDocument();
$dom->load('Books.xml');
$books = $dom->getElementsByTagName('book');

echo '<table><th>Author</th><th>Title</th><th>ID</th><th>Rating</th>
<th>Cover</th>';
foreach($books as $book) {
    $rating = $dom->createElement('rating', rand(1,5));
    $book->appendChild($rating);
    
    $input = ['Hardcover', 'Paperback'];
    $value = array_rand($input, 1);
    $cover = $dom->createAttribute('cover');
    $cover->value = $input[$value];
    $book->appendChild($cover);
    
    echo '<tr><td>'.$book->getElementsByTagName('author')->item(0)->nodeValue.
        '</td><td>'.$book->getElementsByTagName('title')->item(0)->nodeValue.
        '</td><td>'.$book->getAttribute('id').
        '</td><td>'.$book->getElementsByTagName('rating')->item(0)->nodeValue.
        '</td><td>'.$book->getAttribute('cover').
        '</td></tr>';
}
echo '</table><br>'.$dom->saveXML();

$dom->save('Save/Books2.xml');
    
?>