<?php
include '../../connect_db.php';

$q = 'INSERT INTO USERS (first_name, last_name, email, password, user_type) VALUES (:first_name, :last_name, :email, :password, :user_type)';
$req = $bdd->prepare($q); 
$response = $req->execute([
    'first_name' => $_POST['first_name'],
    'last_name' => $_POST['last_name'],
    'email' => $_POST['email'],
    'password' => hash('sha512', $_POST['password']),
    'user_type' => 'Admin' 
]); 

header('location: users.php');