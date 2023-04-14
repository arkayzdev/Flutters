<?php session_start();
    include("../connect_db.php");

    if($_POST['newsletter']==1){
        // Verify if the user exist in the db
        $query = $bdd->prepare('SELECT count(email) FROM NEWSLETTER WHERE email = :email');
        $query->execute([
            'email' => htmlspecialchars($_SESSION['email']),
        ]);
        $result = $query->fetch(PDO::FETCH_COLUMN);

        echo $result;

        if ($result >= 1) {
            $msg = 'Vous êtes déjà inscrit dans la newsletter';
            header('location:profile.php?message=' . $msg);
            exit;
        } else {
            // Verify if the user exist in the db
            $query = $bdd->prepare('INSERT INTO NEWSLETTER(email, sub_date)VALUES(:email, :sub_date )');
            $query->execute([
                'email' => htmlspecialchars($_SESSION['email']),
                'sub_date' => date('Y-m-d')
            ]);
            $result = $query->fetch(PDO::FETCH_COLUMN);

            $msg = 'Vous êtes maintenant inscrit à la newsletter';
            header('location:profile.php?message=' . $msg);
            exit;
        }
    } else {
        // Verify if the user exist in the db
        $query = $bdd->prepare('SELECT count(email) FROM NEWSLETTER WHERE email = :email');
        $query->execute([
            'email' => htmlspecialchars($_SESSION['email']),
        ]);
        $result = $query->fetch(PDO::FETCH_COLUMN);

        echo $result;


        if ($result >= 1) {
            // Verify if the user exist in the db
            $query = $bdd->prepare('DELETE FROM NEWSLETTER WHERE email = :email;');
            $query->execute([
                'email' => htmlspecialchars($_SESSION['email']),
            ]);

            $msg = 'Vous vous êtes désinscrit de la newsletter';
            header('location:profile.php?message=' . $msg);
            exit;
        } else {
            $msg = 'Vous n\'êtes pas inscrit à la newsletter, erreure désinscription';
            header('location:profile.php?message=' . $msg);
            exit;
        }
    }