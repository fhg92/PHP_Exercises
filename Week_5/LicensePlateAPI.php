<?php

$licensePlate = $_POST['licensePlate'];

// If input type is not filled in or doesn't meet preg_match() requirements.
// Redirect and show message.
if($licensePlate == null || !preg_match('/^[A-Z0-9]{6}$/',$licensePlate)) {
    header('Location: LicensePlateForm.php?invalid'); 
}

// If input type is filled in and meets preg_match() requirements.
if($licensePlate != null && preg_match('/^[A-Z0-9]{6}$/',$licensePlate)) {
    
//preg_match('/(?=.*[A-Z])(?=.*[0-9]){6}/',$licensePlate)
$json = file_get_contents(
    'https://opendata.rdw.nl/resource/qyrd-w56j.json?kenteken=' . $licensePlate
);

$decode = json_decode($json);

// If license plate doesn't exist. Redirect and show message.
if(!isset($decode[0]->kenteken)) {
    header('Location: LicensePlateForm.php?not_registered'); 
} 
// If license plate exists. Show car info.    
else {
echo 'Kenteken: '.$decode[0]->kenteken.'<br>'.PHP_EOL.
'Voertuigsoort: '.$decode[0]->voertuigsoort.'<br>'.PHP_EOL.
'Merk: '.$decode[0]->merk.'<br>'.PHP_EOL.
'Handelsbenaming: '.$decode[0]->handelsbenaming.'<br>'.PHP_EOL;
if(isset($decode[0]->bruto_bpm)) {
echo 'Bruto BPM: '.$decode[0]->bruto_bpm.'<br>'.PHP_EOL;
} else {
echo 'Bruto BPM: Geen informatie beschikbaar<br>'.PHP_EOL;
}
echo 'Cilinderinhoud: '.$decode[0]->cilinderinhoud.'<br>'.PHP_EOL.
'Datum eerste afgifte Nederland: '.$decode[0]->datum_eerste_afgifte_nederland.
'<br>'.PHP_EOL.
'Datum eerste toelating: '.$decode[0]->datum_eerste_toelating.'<br>'.PHP_EOL.
'Datum tenaamstelling: '.$decode[0]->datum_tenaamstelling.'<br>'.PHP_EOL.
'Massa ledig voertuig: '.$decode[0]->massa_ledig_voertuig.'<br>'.PHP_EOL.
'Toegestane maximum massa voertuig: '.
$decode[0]->toegestane_maximum_massa_voertuig.'<br>'.PHP_EOL.
'WAM verzekerd: '.$decode[0]->wam_verzekerd.'<br>'.PHP_EOL;
}
}
?>