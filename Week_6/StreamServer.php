<?php

date_default_timezone_set('Europe/Amsterdam');

if(date('l') == 'Friday') {
    $day = 'Yes';
} else {
    $day = 'No';
}

$socket = stream_socket_server('tcp://0.0.0.0:1037');
while ($conn = stream_socket_accept($socket)) {
    fwrite($conn, "Is it Friday? $day".PHP_EOL);
    
    fclose($conn);
}
fclose($socket);

?>