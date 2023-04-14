<?php
$id_movie = $_POST['id'];

include '../../connect_db.php';

$q = "UPDATE USERS SET first_name = :first_name, last_name = :last_name, email = :email WHERE id_client = $id_client";                   
$req = $bdd->prepare($q);
$reponse = $req->execute([
    'first_name' => $_POST['first_name'],
    'last_name' =>$_POST['last_name'],
    'email' => $_POST['email']
]); // Request setled up.

header('location: users.php');