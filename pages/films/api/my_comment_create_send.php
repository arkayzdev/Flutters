<?php
include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");

$email = $_GET['email'];
$id = $_GET['id'];
$stars = $_GET['stars'];
$description = $_GET['description'];

$q = 'SELECT id_client FROM USERS WHERE email = :email';
$req = $bdd->prepare($q);
$reponse = $req->execute([
    'email' => $email
]);
$id_client = $req -> fetch(PDO::FETCH_ASSOC);
$id_client = $id_client['id_client'];


$q = 'INSERT INTO REVIEW(description,score,id_movie,id_client,publication_date) VALUES(:description,:score,:id_movie,:id_client,:publication_date)';
$req = $bdd->prepare($q);
$reponse = $req->execute([
    'id_client' => $id_client,
    'id_movie' => $id,
    'description' => $description,
    'score' => $stars,
    'publication_date' => date('Y-m-d')
]);
$result = $req -> fetchAll(PDO::FETCH_ASSOC);
