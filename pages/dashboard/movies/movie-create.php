<?php
include '../../connect_db.php';

// Image check
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
        header('location: movie?message=' . $msg);
        exit;
    }

    //vérifier que le fichier moins de 2Mo  (utiliser la size du fichier), si non : redirection
    $maxSize = 2 * 1024 * 1024; // 2Mo exprimée en octets
    if($_FILES['image']['size'] > $maxSize){
        $msg = 'Le fichier doit faire moins de 2 Mo.';
        header('location: movie?message=' . $msg);
        exit;
    }

    //créer un dossier dossier s'il n'existe pas (fonctions file_exists et mkdir)
    if(!file_exists('movies-img')){
        mkdir('movies-img'); // chmod 0777 par défaut
    }

    //y enregistrer le fichier (le déplacer de son emplacement temp vers le dossier uploads)
    $from = $_FILES['image']['tmp_name'];

    // Renommage du fichier : risque de doublon si 2 fichiers avec la meme ext. sont envoyés ds la même seconde
    $timestamp = time(); // Nb de secondes écoulées depuis le 01/01/1970
    // récupération de l'extension originale
    //$_FILES['image']['name'] // image.jpeg / profile.gif / doc.min.png
    $array = explode('.', $_FILES['image']['name']); //['doc', 'min', 'png']
    $extension = end($array); // On récupère le dernier élément du tableau

    $filename = 'movie-poster-' . $timestamp . '.' . $extension;
    $destination = 'movies-img/' . $filename;

    $saveResult = move_uploaded_file($from, $destination);

    if(!$saveResult){
        $msg = 'Le fichier n\'a pas pu être enregistré.';
        header('location:profile.php?message=' . $msg);
        exit;
    }
} else {
    header('location: movies.php?message=Veuillez mettre une image.');
}


$q = 'INSERT INTO MOVIE (title, description, release_date, duration, poster_image) 
      VALUES (:title, :description, :release_date, :duration, :poster_image)';
$req = $bdd->prepare($q); 
$response = $req->execute([
    'title' => $_POST['title'],
    'description' => $_POST['description'],
    'release_date' => $_POST['release_date'],
    'duration' => (int)$_POST['duration'],
    'poster_image' => $destination
]); 

$id_movie = (int)$bdd->lastInsertId();


$types = $_POST['types'];
$id_types = [];

foreach($types as $type) {
    $q = "SELECT id_type FROM TYPE WHERE name = '$type'";
    $req = $bdd->query($q);
    $type_select = $req->fetch(PDO::FETCH_ASSOC);
    array_push($id_types, $type_select['id_type']);
}
   
$q = 'INSERT INTO IS_TO (id_movie, id_type) 
      VALUES (:id_movie, :id_type)';
$req = $bdd->prepare($q); 
foreach($id_types as $id) {
    $req->execute([
        'id_movie' => $id_movie,
        'id_type' => $id
    ]); 
}

$language = $_POST['language'];

$q ="SELECT id_language FROM LANGUAGE WHERE name = '$language'";
    $req = $bdd->query($q);
    $id_language = $req->fetch(PDO::FETCH_ASSOC);


$q = 'INSERT INTO IN_LANGUAGE (id_movie, id_language) 
      VALUES (:id_movie, :id_language)';
$req = $bdd->prepare($q); 
$req->execute([
    'id_movie' => $id_movie,
    'id_language' => $id_language['id_language']
]); 



$actors = $_POST['actors'];
$id_actors = [];


foreach($actors as $actor){
    $actor_names = explode(" ", $actor);
    $q = "SELECT id_actor FROM ACTOR WHERE first_name = '$actor_names[0]' AND last_name = '$actor_names[1]'";
    $req = $bdd->query($q);
    $actor_select = $req->fetch(PDO::FETCH_ASSOC);
    array_push($id_actors, $actor_select['id_actor']);
}

$q = 'INSERT INTO PLAYED (id_movie, id_actor) 
      VALUES (:id_movie, :id_actor)';
$req = $bdd->prepare($q); 
foreach($id_actors as $id) {
    $req->execute([
        'id_movie' => $id_movie,
        'id_actor' => $id
    ]); 
}


$directors= $_POST['directors'];
$id_directors = [];


foreach($directors as $director){
    $director_names = explode(" ", $director);
    $q = "SELECT id_director FROM DIRECTOR WHERE first_name = '$director_names[0]' AND last_name = '$director_names[1]'";
    $req = $bdd->query($q);
    $director_select = $req->fetch(PDO::FETCH_ASSOC);
    array_push($id_directors, $director_select['id_director']);
}

$q = 'INSERT INTO REALIZED (id_movie, id_director) 
      VALUES (:id_movie, :id_director)';
$req = $bdd->prepare($q); 
foreach($id_directors as $id) {
    $req->execute([
        'id_movie' => $id_movie,
        'id_director' => $id
    ]); 
}

header('location: movies?message=Film créé !');