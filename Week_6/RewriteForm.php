<html>
    <body>
        <form action='RewriteScript.php' method='post'>
            <input type='text' name='input'/>
            <input type='submit' name='submit'/>
        </form>
    </body>
</html>

<?php

if(isset($_COOKIE['output']))
echo $_COOKIE['output'];

?>