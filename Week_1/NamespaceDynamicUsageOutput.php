<?php
require 'NamespaceDynamicUsage.php';

$class = "\ThisIsANamespace\ThisIsAClass";

$string = new $class();

return $string->thisIsAFunction();

?>