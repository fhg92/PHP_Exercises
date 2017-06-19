<?php

// Checks if same value (Equal). Outputs true.
if(0 == null){
    var_dump(true);
}else{
    var_dump(false);
}

// Checks if same value and type (Identical). Outputs false.
if(0 === null){
    var_dump(true);
}else{
    var_dump(false);
}

?>