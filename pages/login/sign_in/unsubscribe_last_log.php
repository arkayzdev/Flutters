<?php
// email token
$email = $_GET['email'];
$token =  $_GET['token'];
include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");

$q = 'SELECT * FROM USERS WHERE email = :email';

$req = $bdd->prepare($q);
$reponse = $req->execute([
    'email' => $email
]);
$result = $req -> fetch(PDO::FETCH_ASSOC);

if($token == hash('sha512', $result['first_name']) && $result['last_login_active'] == 1){
    $q = 'UPDATE USERS SET last_login_active=0 WHERE email = :email';

    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'email' => $email
    ]);
    $message = "Vous vous êtes désinscrit avec succès.";
} else {
$message = "Vous vous êtes déjà désinscrit.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unsubscribe</title>

    <!-- Import Bootstrap CSS Library -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Import css -->
    <link href="stripe_success.css?rs=<?= time() ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>
<body class="d-flex justify-content-center align-items-center" style="height:100vh;">
    <main style="width:50%; height:50%;" class="d-flex justify-content-center align-items-center flex-column">
        <img class="mb-5" style="width:15em;" src="/img/homepage/Typo-Black.svg" >
        <p><?php echo $message ?></p>
        <p>Mais n'hésitez pas à venir nous voir de temps à autre !</p>
        <a href="/" style="color:red; ">Accueil</a>
    </main>



    <!-- Import Bootstrap JS Library -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/gsap.min.js"></script>
</body>
</html>
