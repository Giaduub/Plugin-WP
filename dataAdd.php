<?php
function addDB(){
$curl = curl_init();
$url = "https://coronavirusapi-france.now.sh/AllLiveData";

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);

if($e = curl_error($curl)){
echo $e;
}else{

try {
$db = new PDO('mysql:host=localhost;dbname=mysql;port=3306;charset=utf8', 'root', '');
}
catch (PDOException $e) {
print "Erreur !: " . $e->getMessage() . "<br>";
die();
}
$decoded = json_decode($resp);
$count = count($decoded->allLiveFranceData);
$nb = 0;
for($i = 0; $i < $count; $i++){
$nom = $decoded->allLiveFranceData[$i]->nom;
$code = $decoded->allLiveFranceData[$i]->code;
$hospitalises = $decoded->allLiveFranceData[$i]->hospitalises;
$reanimation = $decoded->allLiveFranceData[$i]->reanimation;
$nouvellesHospitalisations = $decoded->allLiveFranceData[$i]->nouvellesHospitalisations;
$nouvellesReanimations = $decoded->allLiveFranceData[$i]->nouvellesReanimations;
$deces = $decoded->allLiveFranceData[$i]->deces;
$gueris = $decoded->allLiveFranceData[$i]->gueris;
$nb++;

$add = $db->prepare('INSERT INTO wp_dbp_tb_ct (
id,
code,
nom,
hospitalises,
gueris,
deces,
nouvellesHospitalisations,
nouvellesReanimations,
reanimation
)
VALUES(:id,:code,:nom,:hospitalises,:gueris,:deces,:nouvellesHospitalisations,:nouvellesReanimations,:reanimation)');
$add->bindParam(':id', $nb, PDO::PARAM_STR);
$add->bindParam(':code', $code, PDO::PARAM_STR);
$add->bindParam(':nom', $nom, PDO::PARAM_STR);
$add->bindParam(':hospitalises', $hospitalises, PDO::PARAM_STR);
$add->bindParam(':gueris', $gueris, PDO::PARAM_STR);
$add->bindParam(':deces', $deces, PDO::PARAM_STR);
$add->bindParam(':nouvellesHospitalisations', $nouvellesHospitalisations, PDO::PARAM_STR);
$add->bindParam(':nouvellesReanimations', $nouvellesReanimations, PDO::PARAM_STR);
$add->bindParam(':reanimation', $reanimation, PDO::PARAM_STR);

$add = $add->execute();
}

}

curl_close($curl);
}