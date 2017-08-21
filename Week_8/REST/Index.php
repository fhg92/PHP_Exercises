<!-- UNDER CONSTRUCTION -->

<?php if(!isset($_GET['json'])) { ?>
<html>
    <body>
        <form method='post'>
            <div>
                <input type='text' name='id' placeholder='Enter ID'/>
            </div>
            <br>
            <input type='submit'/>
        </form>
    </body>
</html>
<?php 

} 

require_once('DbConnect.php');

$sql = 'SELECT * FROM user_personal u INNER JOIN gender g ON u.gender_id = 
g.gender_id';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$details = $stmt->fetchAll(PDO::FETCH_OBJ);
$json = json_encode($details);

$decode = json_decode($json, true);

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'GET') {
    if(isset($_GET['json'])) {
            
        $i = -1;

        foreach($decode as $d) {

            $i++;

            if(strcasecmp($d['user_id'], $_GET['json']) == 0) {
                $shortjson = json_encode($decode[$i], true);
                echo $shortjson;
                break;
            }
        }
    }
}

if($method == 'POST') {
    
    $newjson = file_get_contents(
        'http://localhost/~Frank/PHP_Exercises/Week_8/REST/json/'
        .$_POST['id'].'');
    
    $dec = json_decode($newjson);
    
    if(isset($dec->user_id)) {
    
    echo '<table><tr><td><b>ID:</b></td><td>'.$dec->user_id.'</td></tr>
    <tr><td><b>First Name:</b></td><td>'.$dec->first_name.'</td></tr>
    <tr><td><b>Last Name:</b></td><td>'.$dec->last_name.'</td></tr>
    <tr><td><b>City:</b></td><td>'.$dec->city.'</td></tr>
    <tr><td><b>Date of Birth:</b></td><td>'.$dec->date_of_birth.'</td></tr>
    <tr><td><b>Gender:</b></td><td>'.$dec->label.'</td></tr>
    <tr><td><b>Date Registered:</b></td><td>'.$dec->date_registered.'</td>
    </tr><tr><td><b>Last Login:</b></td><td>'.$dec->last_login.'</td></tr>
    <table>';
    
    } else {
        echo '<span style="color:red">No user found.</span>';
    }
    
}

?>