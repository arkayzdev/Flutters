<?php session_start();
    include("../connect_db.php");

    if (!isset($_POST['actual_password']) || !isset($_POST['new_password'])){
        $msg = 'Veuillez remplir les deux champs';
        header('location:profile.php?message=' . $msg);
        exit;
    }

        // Verify if password match with the db one
        $query = $bdd->prepare('SELECT password FROM USERS WHERE email= :email');
        $query->execute([
            'email' => htmlspecialchars($_SESSION['email']),
        ]);
        $result_password = $query->fetch(PDO::FETCH_COLUMN);

        if ($result_password != hash('sha512', $_POST['actual_password'])) {
            $msg = 'Le mot de passe ne correspond pas';
            header('location:profile.php?message=' . $msg);
            exit;
        }

        // Password requirement met
        if (strlen($_POST["password"]) <= 8 || !preg_match("/[A-Z]/", $_POST["password"]) || !preg_match("/[a-z]/", $_POST["password"]) || !preg_match("/[0-9]/", $_POST["password"])) {

            $msg = 'Attention ! Mot de passe invalide. Le mot de passe doit être au minimum de 8 caractères et contenir au moins 1 majuscule, 1 minuscule et 1 chiffre !';
            header('location:profile.php?message=' . $msg);
            exit;
        }

        // Update users information
        $q = 'UPDATE USERS SET password=:password WHERE email=:email';
        $req = $bdd->prepare($q); // Renvoie une déclaration pdo (statement)
        $reponse = $req->execute([
            'password' => hash('sha512', $_POST['new_password']),
            'email' => $_SESSION['email']
        ]); // Exécution de la requête préparée (on lui passe les valeurs).

                // logs
        // type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated  | $page = actual url
        $log_type = 5; $log_page = 'https://flutters.ovh/pages/profile/profile';
        include($_SERVER['DOCUMENT_ROOT']."/log.php");

        $msg = 'informations d\'utilisateurs modifiés avec succès';
        header('location:profile.php?message=' . $msg);
        exit;
