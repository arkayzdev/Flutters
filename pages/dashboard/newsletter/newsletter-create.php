<?php
include '../../connect_db.php';

$email = trim($_POST['email']);
$sub_date = trim($_POST['sub_date']);

$q = "SELECT COUNT(email) as COUNT FROM NEWSLETTER WHERE email = '$email'";
$req = $bdd->query($q);
$result = $req->fetch(PDO::FETCH_ASSOC);
if ($result['COUNT'] != "0") {
    $alert = "L'utilisateur existe déjà, veuillez réessayer.";
    header('location: newsletter?type=create&alert=' . $alert);
    exit();
}

$q = 'INSERT INTO NEWSLETTER(email, sub_date) VALUES (:email, :sub_date)';
$req = $bdd->prepare($q); 
$response = $req->execute([
    'email' => $email,
    'sub_date' => $sub_date,

]); 

$alert = "create_success";
header('location: newsletter?alert=' . $alert);
exit();