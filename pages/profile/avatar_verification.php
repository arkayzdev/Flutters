<?php session_start();
    include("../connect_db.php");


    //si une image est postée ($_FILES['image']) :
    if(isset($_FILES['image']) && $_FILES['image']['error'] != 4){

        //vérifier que le fichier est de type jpg, png ou gif (utiliser le type du fichier), si non : redirection
        // tableau des types acceptés
        $acceptable = [
                        'image/jpeg',
                        'image/png',
                        'image/gif',
                    ];

        if(!in_array($_FILES['image']['type'], $acceptable)){
            $msg = 'Le fichier doit être du type jpeg, gif ou png.';
            header('location: profile.php?message=' . $msg);
            exit;
        }

        //vérifier que le fichier moins de 2Mo  (utiliser la size du fichier), si non : redirection
        $maxSize = 2 * 1024 * 1024; // 2Mo exprimée en octets
        if($_FILES['image']['size'] > $maxSize){
            $msg = 'Le fichier doit faire moins de 2 Mo.';
            header('location: profile.php?message=' . $msg);
            exit;
        }

        //créer un dossier dossier s'il n'existe pas (fonctions file_exists et mkdir)
        if(!file_exists('users_avatars')){
            mkdir('users_avatars'); // chmod 0777 par défaut
        }

        //y enregistrer le fichier (le déplacer de son emplacement temp vers le dossier uploads)
        $from = $_FILES['image']['tmp_name'];

        // Renommage du fichier : risque de doublon si 2 fichiers avec la meme ext. sont envoyés ds la même seconde
        $timestamp = time(); // Nb de secondes écoulées depuis le 01/01/1970
        // récupération de l'extension originale
        //$_FILES['image']['name'] // image.jpeg / profile.gif / doc.min.png
        $array = explode('.', $_FILES['image']['name']); //['doc', 'min', 'png']
        $extension = end($array); // On récupère le dernier élément du tableau

        $filename = 'image-' . $timestamp . '.' . $extension;
        $destination = 'users_avatars/' . $filename;

        $saveResult = move_uploaded_file($from, $destination);

        if(!$saveResult){
            $msg = 'Le fichier n\'a pas pu être enregistré.';
            header('location:profile.php?message=' . $msg);
            exit;
        }

        // Get avatar informations from the user
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
        $q = 'UPDATE USERS SET avatar=:avatar WHERE email=:email';
        $req = $bdd->prepare($q); // Renvoie une déclaration pdo (statement)
        $reponse = $req->execute([
            'avatar' =>  isset($filename) ? $filename : '',
            'email' => $_SESSION['email']
        ]); // Exécution de la requête préparée (on lui passe les valeurs).

        $msg = 'Modifié';
        header('location:profile.php?message=' . $msg);
        exit;
    }
?>