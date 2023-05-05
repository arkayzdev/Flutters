<?php 
include '../../../connect_db.php';

$id = $_GET['id'];

$q = "UPDATE USERS SET status='none' WHERE id_client=$id";
$req = $bdd->prepare($q);
$req->execute();

header('location: ../users?alert=unban');
exit();

?>