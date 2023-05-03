<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="news.css?rs=<?= time()?>">
    <title>Document</title>
</head>
<body>


<?php

include("/var/www/flutters.ovh/pages/connect_db.php");

$result = $bdd->query('SELECT * FROM NEWSLETTER');

    if (isset($_GET['email']) && !empty($_GET['email'])) {
        $q = "DELETE FROM NEWSLETTER WHERE email = :email";
        $req = $bdd->prepare($q);
        $state = $req->execute([
            'email' => $_GET['email']
        ]);
    
        if ($state) {
            echo "Abonné(e) supprimé avec succès !";
        }
    }
?>
<br/>

<button id="btn789">
    <a href="recup_donnees.php">Retour</a>
</button>

</body>
</html>