<html>
    <body>
        <legend>Voer hieronder uw kenteken in zonder koppeltekens.</legend>
        <form action='LicensePlateAPI.php' method='post'>
            <input type='text' name='licensePlate' placeholder='1ABC23'/>
            <input type='submit'/>
        </form>
    </body>
</html>

<?php

if(isset($_GET['invalid']))
{
echo '<span style="color:red;">Voer een geldig kenteken in. 
Het kenteken moet hoofdletters en cijfers bevatten.</span>';
}

if(isset($_GET['not_registered']))
{
echo '<span style="color:red;">Dit kenteken is niet geregistreerd.</span>';
}

?>