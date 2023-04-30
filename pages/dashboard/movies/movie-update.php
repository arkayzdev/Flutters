<?php 
include '../../connect_db.php';

$id_movie = $_POST['id'];

include '../../connect_db.php';

// Image check
//si une image est postée ($_FILES['image']) :




//y enregistrer le fichier (le déplacer de son emplacement temp vers le dossier uploads)
$from = $_FILES['image']['tmp_name'];

$q = "SELECT poster_image FROM MOVIE WHERE id_movie=$id_movie";
$req = $bdd->query($q);
$result = $req->fetch(PDO::FETCH_ASSOC);
$destination = $result['poster_image'];

$saveResult = move_uploaded_file($from, $destination);



 
$q = "UPDATE MOVIE SET title=:title, description=:description, release_date=:release_date, duration=:duration, poster_image=:poster_image, trailer=:trailer WHERE id_movie = $id_movie";
$req = $bdd->prepare($q); 
$response = $req->execute([
    'title' => $_POST['title'],
    'description' => $_POST['description'],
    'release_date' => $_POST['release_date'],
    'duration' => (int)$_POST['duration'],
    'poster_image' => $destination,
    'trailer' => $_POST['trailer'],
]); 




$types = $_POST['types'];
$id_types = [];
var_dump($types);

$q = "DELETE FROM IS_TO WHERE id_movie = $id_movie";
$req = $bdd->prepare($q);
$req->execute(); 

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

$q = "DELETE FROM IN_LANGUAGE WHERE id_movie = $id_movie";
$req = $bdd->prepare($q);
$req->execute(); 

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

$q = "DELETE FROM PLAYED WHERE id_movie = $id_movie";
$req = $bdd->prepare($q);
$req->execute(); 

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

$q = "DELETE FROM REALIZED WHERE id_movie = $id_movie";
$req = $bdd->prepare($q);
$req->execute(); 

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

header('location: movies');