<?php
include '../../connect_db.php';

$first_name = trim($_POST['first_name']);
$last_name = trim($_POST['last_name']);
$email = trim($_POST['email']);


if (!preg_match("/^[a-zA-Zéèà-]+$/", $first_name) || !preg_match("/^[a-zA-Zéèà-]+$/", $last_name)) {
    $alert = "Veuillez entrer des noms valides, contenant seulement des caractères.";
    header('location: users?type=create&alert=' . $alert);
    exit();
}

$q = "SELECT COUNT(id_client) as COUNT FROM USERS WHERE email = '$email'";
$req = $bdd->query($q);
$result = $req->fetch(PDO::FETCH_ASSOC);
if ($result['COUNT'] != "0") {
    $alert = "Le mail est déjà utilisé, veuillez réessayer.";
    header('location: users?type=create&alert=' . $alert);
    exit();
}

$q = 'INSERT INTO USERS (first_name, last_name, email, password, user_type, email_verification) VALUES (:first_name, :last_name, :email, :password, :user_type, :email_verification)';
$req = $bdd->prepare($q); 
$response = $req->execute([
    'first_name' => $first_name,
    'last_name' => $last_name,
    'email' => $email,
    'password' => hash('sha512', $_POST['password']),
    'user_type' => 'Admin',
    'email_verification' => 1
]); 

$alert = "create_success";
header('location: users?alert=' . $alert);
exit();