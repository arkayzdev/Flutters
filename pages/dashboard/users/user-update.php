<?php
include '../../connect_db.php';

$id_client = $_POST['id'];
$first_name = trim($_POST['first_name']);
$last_name = trim($_POST['last_name']);
$email = trim($_POST['email']);

if (!preg_match("/^[a-zA-Zéèà-]+$/", $first_name) || !preg_match("/^[a-zA-Zéèà-]+$/", $last_name)) {
    $alert = "Veuillez entrer des noms valides, contenant seulement des caractères.";
    header('location: users?type=modify&id=' . $id_client . '&alert=' . $alert);
    exit();
}

$q = "SELECT COUNT(id_client) as COUNT FROM USERS WHERE email = '$email' AND id_client != $id_client" ;
$req = $bdd->query($q);
$result = $req->fetch(PDO::FETCH_ASSOC);
if ($result['COUNT'] != "0") {
    $alert = "Le mail est déjà utilisé, veuillez réessayer.";
    header('location: users?type=modify&id=' . $id . '&alert=' . $alert);
    exit();
}


$q = "UPDATE USERS SET first_name = :first_name, last_name = :last_name, email = :email, user_type = :user_type WHERE id_client = $id_client";                   
$req = $bdd->prepare($q);
$reponse = $req->execute([
    'first_name' => $first_name,
    'last_name' => $last_name,
    'email' => $email,
    'user_type' => $_POST['user_type']
]); 

$alert = "alter_success";
header('location: users?alert=' . $alert);
exit();