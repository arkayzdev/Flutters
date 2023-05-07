<?php
$id = $_POST['id'];
$email = $_POST['email'];
$sub_date = $_POST['sub_date'];

include '../../connect_db.php';

$q = "SELECT COUNT(email) as COUNT FROM NEWSLETTER WHERE email = '$email'";
$req = $bdd->query($q);
$result = $req->fetch(PDO::FETCH_ASSOC);
if ($result['COUNT'] != "0") {
    $alert = "L'utilisateur existe déjà, veuillez réessayer.";
    header('location: newsletter?type=modify&id=' . $id . '&alert=' . $alert);
    exit();
}

$q = "UPDATE NEWSLETTER SET email = :email, sub_date = :sub_date WHERE email = :emaiil";                   
$req = $bdd->prepare($q);
$reponse = $req->execute([
    'email' => $email,
    'sub_date' => date($sub_date),
    'emaiil' => $id,
]); 

$alert = "alter_success";
header('location: newsletter?alert=' . $alert);
exit();