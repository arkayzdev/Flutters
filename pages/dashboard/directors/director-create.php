<?php
include '../../connect_db.php';

$first_name = trim($_POST['first_name']);
$last_name = trim($_POST['last_name']);

if (!preg_match("/^[a-zA-Zéèà-]+$/", $first_name) || !preg_match("/^[a-zA-Zéèà-]+$/", $last_name)) {
    $alert = "Veuillez entrer des noms valides, contenant seulement des caractères (et tirets pour les prénoms composés).";
    header('location: directors?type=create&alert=' . $alert);
    exit();
}

$q = "SELECT COUNT(id_director) as COUNT FROM DIRECTOR WHERE first_name = '$first_name' AND last_name = '$last_name'";
$req = $bdd->query($q);
$result = $req->fetch(PDO::FETCH_ASSOC);
if ($result['COUNT'] != "0") {
    $alert = "Le réalisateur existe déjà, veuillez réessayer.";
    header('location: directors?type=create&alert=' . $alert);
    exit();
}

$q = 'INSERT INTO DIRECTOR(first_name, last_name) VALUES (:first_name, :last_name)';
$req = $bdd->prepare($q); 
$response = $req->execute([
    'first_name' => $first_name,
    'last_name' => $last_name

]); 

$alert = "create_success";
header('location: directors?alert=' . $alert);
exit();
