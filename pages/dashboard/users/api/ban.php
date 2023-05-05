<?php 
include '../../../connect_db.php';

$id = $_GET['id'];

$q = "UPDATE USERS SET status='ban' WHERE id_client=$id";
$req = $bdd->prepare($q);
$req->execute();

$alert = "Vous avez banni un utilisateur.";
header('location: ../users?alert=' . $alert);
exit();


?>