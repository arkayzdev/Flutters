<?php 
include '../../connect_db.php';

$id_session = $_POST['id'];
$room = $_POST['room'];
$movie_title = $_POST['movie'];

include '../../connect_db.php';

$q = "SELECT id_room FROM ROOM WHERE room_name = '$room'";
$req = $bdd->query($q);
$req->execute();
$result = $req->fetch(PDO::FETCH_ASSOC);
$id_room = $result['id_room'];
 
$q = "UPDATE SESSION SET seance_date=:seance_date, start_time=:start_time, language=:language, price=:price, id_room=:id_room WHERE id_session = $id_session";
$req = $bdd->prepare($q); 
$response = $req->execute([
    'seance_date' => $_POST['date'],
    'start_time' => $_POST['start_time'],
    'language' => $_POST['language'],
    'price' => $_POST['price'],
    'id_room' => (int)$id_room
]); 

$q = "SELECT id_movie FROM MOVIE WHERE title = '$movie_title'";
$req = $bdd->query($q);
$req->execute();
$movie_result = $req->fetch(PDO::FETCH_ASSOC);
$id_movie = $movie_result['id_movie'];

$q = "UPDATE TAKE_PLACE SET id_movie=:id_movie WHERE id_session = $id_session";
$req = $bdd->prepare($q); 
$response = $req->execute([
    'id_movie' => $id_movie
]); 


header('location: sessions');