<?php
$id = $_POST['id'];

include '../../connect_db.php';

$q = "UPDATE ACTOR SET first_name = :first_name, last_name = :last_name WHERE id_actor = $id";                   
$req = $bdd->prepare($q);
$reponse = $req->execute([
    'first_name' => $_POST['first_name'],
    'last_name' => $_POST['last_name'],
]); 

header('location: actors');