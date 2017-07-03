<?php

$licenseplate = $_POST['kenteken'];
if($licenseplate == null || !preg_match('/^[A-Z0-9]{6}$/',$licenseplate)) {
    header('Location: LicensePlateForm.php?invalid'); 
}

if($licenseplate != null){
$json = file_get_contents(
    'https://opendata.rdw.nl/resource/qyrd-w56j.json?kenteken=' . $licenseplate
);
    
$decode = json_decode($json);
    
echo 'Kenteken: '.$decode[0]->kenteken.'<br>'.PHP_EOL.
'Voertuigsoort: '.$decode[0]->voertuigsoort.'<br>'.PHP_EOL.
'Merk: '.$decode[0]->merk.'<br>'.PHP_EOL.
'Handelsbenaming: '.$decode[0]->handelsbenaming.'<br>'.PHP_EOL.
'Bruto BPM: '.$decode[0]->bruto_bpm.'<br>'.PHP_EOL.
'Cilinderinhoud: '.$decode[0]->cilinderinhoud.'<br>'.PHP_EOL.
'Datum eerste afgifte Nederland: '.$decode[0]->datum_eerste_afgifte_nederland.
'<br>'.PHP_EOL.
'Datum eerste toelating: '.$decode[0]->datum_eerste_toelating.'<br>'.PHP_EOL.
'Datum tenaamstelling: '.$decode[0]->datum_tenaamstelling.'<br>'.PHP_EOL.
'Massa ledig voertuig: '.$decode[0]->massa_ledig_voertuig.'<br>'.PHP_EOL.
'Toegestane maximum massa voertuig: '.
$decode[0]->toegestane_maximum_massa_voertuig.'<br>'.PHP_EOL.
'WAM verzekerd: '.$decode[0]->wam_verzekerd.'<br>'.PHP_EOL;
}

?>