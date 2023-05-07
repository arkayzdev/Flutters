<?php 
include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");

$q = 'SELECT email FROM NEWSLETTER WHERE email = :email';
$req = $bdd->prepare($q);
$reponse = $req->execute([
    'email' => $_GET['email'],
]);
$result = $req -> fetch(PDO::FETCH_ASSOC);


if (preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $_GET['email'])) {

    if(!isset($result['email'])){
        $q = 'INSERT INTO NEWSLETTER(email,sub_date) VALUES (:email,:sub_date);';
        $req = $bdd->prepare($q);
        $reponse = $req->execute([
            'email' => $_GET['email'],
            'sub_date' => date('Y-m-d')
        ]);
        $result = $req -> fetchAll(PDO::FETCH_ASSOC);
    
        echo 'Souscription à la newsletter effectuée avec succès !';
    } else {
        echo 'Cet email est déjà inscrit';
    }
} else {
    echo 'La saisie ne correspond pas à un email';
}