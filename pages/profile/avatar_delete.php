<?php session_start();
    include("../connect_db.php");

    // Get every informations of the user
    $q = 'SELECT avatar FROM USERS WHERE email = :email';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'email' => htmlspecialchars($_SESSION['email']),
    ]);
    $result= $req -> fetch();
    $avatar = $result['avatar'];

    // Delete the previous image
    if($avatar!=""){
    unlink('users_avatars/' . $avatar);
    }
    
    // Integrate the new avatar in the db
    $q = 'UPDATE USERS SET avatar="" WHERE email=:email';
    $req = $bdd->prepare($q); // Renvoie une déclaration pdo (statement)
    $reponse = $req->execute([
        'email' => $_SESSION['email']
    ]); // Exécution de la requête préparée (on lui passe les valeurs).

                // logs
        // type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated  | $page = actual url
        $log_type = 5; $log_page = 'https://flutters.ovh/pages/profile/profile';
        include($_SERVER['DOCUMENT_ROOT']."/log.php");

    $msg = 'Photo de profil mise à jour : deleted';
    header('location:profile.php?message=' . $msg);
    exit;
