<?php
include '../../connect_db.php';
$name = trim($_POST['name']);

if (!preg_match("/^[a-zA-Zéèà-]+$/", $name)) {
    $alert = "Veuillez entrer un nom valide, contenant seulement des caractères.";
    header('location: movie-type?type=create&alert=' . $alert);
    exit();
}

$q = "SELECT COUNT(id_type) as COUNT FROM TYPE WHERE name = '$name'";
$req = $bdd->query($q);
$result = $req->fetch(PDO::FETCH_ASSOC);
if ($result['COUNT'] != "0") {
    $alert = "Le genre existe déjà, veuillez réessayer.";
    header('location: movie-type?type=create&alert=' . $alert);
    exit();
}

$q = 'INSERT INTO TYPE(name) VALUES (:name)';
$req = $bdd->prepare($q); 
$response = $req->execute([
    'name' => $name,
]); 

$alert = "create_success";
header('location: movie-type?alert=' . $alert);
exit();
