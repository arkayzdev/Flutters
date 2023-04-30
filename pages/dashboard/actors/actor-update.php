<?php
$id = $_POST['id'];
$first_name = trim($_POST['first_name']);
$last_name = trim($_POST['last_name']);

include '../../connect_db.php';

if (!preg_match("/^[a-zA-Zéèà -]+$/", $first_name) || !preg_match("/^[a-zA-Zéèà -]+$/", $last_name)) {
    $alert = "Veuillez entrer des noms valides, contenant seulement des caractères (et tirets pour les prénoms composés).";
    header('location: actors?type=modify&id=' . $id . '&alert=' . $alert);
    exit();
}

$q = "SELECT COUNT(id_actor) as COUNT FROM ACTOR WHERE first_name = '$first_name' AND last_name = '$last_name'";
$req = $bdd->query($q);
$result = $req->fetch(PDO::FETCH_ASSOC);
if ($result['COUNT'] != "0") {
    $alert = "L'acteur existe déjà.";
    header('location: actors?type=modify&id=' . $id . '&alert=' . $alert);
    exit();
}


$q = "UPDATE ACTOR SET first_name = :first_name, last_name = :last_name WHERE id_actor = $id";                   
$req = $bdd->prepare($q);
$reponse = $req->execute([
    'first_name' => $_POST['first_name'],
    'last_name' => $_POST['last_name'],
]); 

$alert = "alter_success";
header('location: actors?alert=' . $alert);
exit();