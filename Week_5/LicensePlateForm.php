<html>
    <body>
        <legend>Personenauto basisdata.</legend>
        <form action='LicensePlateAPI.php' method='post'>
            <input type='text' name='kenteken' placeholder='Kenteken'/>
            <input type='submit'/>
        </form>
    </body>
</html>

<?php

if(isset($_GET['invalid']))
{
echo '<span style="color:red;">Voer een geldig kenteken in.</span>';
}

?>