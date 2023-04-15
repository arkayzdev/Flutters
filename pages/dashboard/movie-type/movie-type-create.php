<?php
include '../../connect_db.php';

$q = 'INSERT INTO TYPE(name) VALUES (:name)';
$req = $bdd->prepare($q); 
$response = $req->execute([
    'name' => $_POST['name'],
]); 

header('location: movie-type');