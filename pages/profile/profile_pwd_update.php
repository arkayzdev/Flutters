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

        // Update users information
        $q = 'UPDATE USERS SET password=:password WHERE email=:email';
        $req = $bdd->prepare($q); // Renvoie une déclaration pdo (statement)
        $reponse = $req->execute([
            'password' => hash('sha512', $_POST['new_password']),
            'email' => $_SESSION['email']
        ]); // Exécution de la requête préparée (on lui passe les valeurs).

        $msg = 'informations d\'utilisateurs modifiés avec succès';
        header('location:profile.php?message=' . $msg);
        exit;

