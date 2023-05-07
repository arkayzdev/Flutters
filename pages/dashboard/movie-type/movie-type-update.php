<?php
$id = $_POST['id'];
$name = trim($_POST['name']);

include '../../connect_db.php';

if (!preg_match("/^[a-zA-Zéèà-]+$/", $name)) {
    $alert = "Veuillez entrer un nom valide, contenant seulement des caractères (et séparé uniquement par un tiret).";
    header('location: movie-type?type=modify&id=' . $id . '&alert=' . $alert);
    exit();
}

$q = "SELECT COUNT(id_type) as COUNT FROM TYPE WHERE name = '$name' AND id_type != $id";
$req = $bdd->query($q);
$result = $req->fetch(PDO::FETCH_ASSOC);
if ($result['COUNT'] != "0") {
    $alert = "Le genre existe déjà, veuillez réessayer.";
    header('location: movie-type?type=modify&id=' . $id . '&alert=' . $alert);
    exit();
}

$q = "UPDATE TYPE SET name = :name WHERE id_type = $id";                   
$req = $bdd->prepare($q);
$reponse = $req->execute([
    'name' => $name,
]); 

$alert = "alter_success";
header('location: movie-type?alert=' . $alert);
exit();
