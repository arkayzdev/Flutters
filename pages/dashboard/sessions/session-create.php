<?php
include '../../connect_db.php';

$room_name = $_POST['room'];

$q = "SELECT id_room FROM ROOM WHERE room_name = $room_name";
$req = $bdd->query($q);
$req->execute();

$room = $req->fetch(PDO::FETCH_ASSOC);


$q = 'INSERT INTO SESSION (seance_date, start_time, language, price, id_room) 
      VALUES (:seance_date, :start_time, :language, :price, :id_room)';
$req = $bdd->prepare($q); 
$response = $req->execute([
    'seance_date' => $_POST['date'],
    'start_time' => $_POST['start_time'], 
    'language'=> $_POST['language'],
    'price' => $_POST['price'], 
    'id_room' => $room['id_room']
]); 




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