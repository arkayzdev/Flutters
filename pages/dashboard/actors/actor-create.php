<?php
include '../../connect_db.php';

$first_name = trim($_POST['first_name']);
$last_name = trim($_POST['last_name']);

if (!preg_match("/^[a-zA-Zéèà-]+$/", $first_name) || !preg_match("/^[a-zA-Zéèà-]+$/", $last_name)) {
    $alert = "Veuillez entrer des noms valides, contenant seulement des caractères (et tirets pour les prénoms composés).";
    header('location: actors?type=create&alert=' . $alert);
    exit();
}

$q = "SELECT COUNT(id_actor) as COUNT FROM ACTOR WHERE first_name = '$first_name' AND last_name = '$last_name'";
$req = $bdd->query($q);
$result = $req->fetch(PDO::FETCH_ASSOC);
if ($result['COUNT'] != "0") {
    $alert = "L'acteur existe déjà, veuillez réessayer.";
    header('location: actors?type=create&alert=' . $alert);
    exit();
}

$q = 'INSERT INTO ACTOR(first_name, last_name) VALUES (:first_name, :last_name)';
$req = $bdd->prepare($q); 
$response = $req->execute([
    'first_name' => $first_name,
    'last_name' => $last_name,

]); 

$alert = "create_success";
header('location: actors?alert=' . $alert);
exit();