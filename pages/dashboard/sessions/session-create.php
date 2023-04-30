<?php
include '../../connect_db.php';

$room_name = $_POST['room'];
$movie_name = $_POST['movie'];

$q = "SELECT id_room FROM ROOM WHERE room_name = '$room_name'";
$req = $bdd->query($q);
$room = $req->fetch(PDO::FETCH_ASSOC);

$q = "SELECT id_movie FROM MOVIE WHERE title = '$movie_name'";
$req = $bdd->query($q);
$movie = $req->fetch(PDO::FETCH_ASSOC);



$q = 'INSERT INTO SESSION (seance_date, start_time, language, price, id_room) 
      VALUES (:seance_date, :start_time, :language, :price, :id_room)';
$req = $bdd->prepare($q); 
$response = $req->execute([
    'seance_date' => $_POST['date'],
    'start_time' => $_POST['start_time'], 
    'language' => $_POST['language'],
    'price' => $_POST['price'], 
    'id_room' => $room['id_room']
]); 

$id_session = (int)$bdd->lastInsertId();

$q = 'INSERT INTO TAKE_PLACE(id_session, id_movie) VALUES(:id_session, :id_movie)';
$req = $bdd->prepare($q);
$req->execute([
    'id_session' => $id_session,
    'id_movie' => (int)$movie['id_movie']
]);

header('location: sessions');