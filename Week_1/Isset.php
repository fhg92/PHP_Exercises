<?php 

$hello = null;
if(isset($hello))
{
    echo 'Hello';
}
elseif(!isset($hello))
{
    echo 'Goodbye';
}

?>