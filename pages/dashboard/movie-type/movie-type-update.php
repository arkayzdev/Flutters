<?php
$id = $_POST['id'];

include '../../connect_db.php';

$q = "UPDATE TYPE SET name = :name WHERE id_type = $id";                   
$req = $bdd->prepare($q);
$reponse = $req->execute([
    'name' => $_POST['name'],
]); 

header('location: movie-type');