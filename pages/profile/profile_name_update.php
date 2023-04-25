<?php session_start();
    include("../connect_db.php");

     // logs
    // type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated  | $page = actual url
    $log_type = 5; $log_page = 'https://flutters.ovh/pages/profile/profile';
    include($_SERVER['DOCUMENT_ROOT']."/log.php");

    if (!isset($_POST['firstname']) || !isset($_POST['lastname'])){
        $msg = 'Veuillez remplir les deux champs';
        header('location:profile.php?message=' . $msg);
        exit;
    }

        // Update users information
        $q = 'UPDATE USERS SET first_name=:first_name WHERE email=:email';
        $req = $bdd->prepare($q); // Renvoie une déclaration pdo (statement)
        $reponse = $req->execute([
            'first_name' => $_POST['firstname'],
            'email' => $_SESSION['email']
        ]); // Exécution de la requête préparée (on lui passe les valeurs).

        // Update users information
        $q = 'UPDATE USERS SET last_name=:last_name WHERE email=:email';
        $req = $bdd->prepare($q); // Renvoie une déclaration pdo (statement)
        $reponse = $req->execute([
            'last_name' => $_POST['lastname'],
            'email' => $_SESSION['email']
        ]); // Exécution de la requête préparée (on lui passe les valeurs).

        $msg = 'informations d\'utilisateurs modifiés avec succès';
        header('location:profile.php?message=' . $msg);
        exit;

