<?php
include '../../connect_db.php';

$q = 'INSERT INTO ACTOR(first_name, last_name) VALUES (:first_name, :last_name)';
$req = $bdd->prepare($q); 
$response = $req->execute([
    'first_name' => $_POST['first_name'],
    'last_name' => $_POST['last_name'],

]); 

header('location: actors');