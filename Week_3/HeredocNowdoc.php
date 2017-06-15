<?php

// Heredoc. Echos "Goodmorning sir."
$sir = "sir.";
echo  <<<MESSAGE
Goodmorning $sir</br>
MESSAGE;

// Nowdoc. Echos "Goodmorning $sir"

$sir = "sir.";
echo  <<<'MESSAGE'
Goodmorning $sir
MESSAGE;

?>