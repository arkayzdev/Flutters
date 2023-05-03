<?php
include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");

$email = $_GET['email'];
$id = $_GET['id'];
$stars = $_GET['stars'];
$description = $_GET['description'];
$stars = $_GET['stars'];

$q = 'UPDATE REVIEW SET description = :description, score = :score, publication_date = :publication_date WHERE id_client = (SELECT id_client FROM USERS WHERE email= :email) AND id_movie = :id_movie;
';
$req = $bdd->prepare($q);
$reponse = $req->execute([
    'email' => $email,
    'id_movie' => $id,
    'description' => $description,
    'score' => $stars,
    'publication_date' => date('Y-m-d')
]);
$result = $req -> fetchAll(PDO::FETCH_ASSOC);

