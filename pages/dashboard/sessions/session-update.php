<?php 
include '../../connect_db.php';

$id_movie = $_POST['id'];
$room = $_POST['room'];

include '../../connect_db.php';

$q = "SELECT id_room FROM ROOM WHERE room_name = $room";
$req = $bdd->query($q);
$req->execute();
$results = $req->fetch(PDO::FETCH_ASSOC);
$id_room = $results['id_room'];
 
$q = "UPDATE SESSION SET seance_date=:seance_date, start_time=:start_time, price=:price, id_room:id_room WHERE id_movie = $id_movie";
$req = $bdd->prepare($q); 
$response = $req->execute([
    'seance_date' => $_POST['date'],
    'start_time' => $_POST['start_time'],
    'price' => $_POST['price'],
    'id_room' => (int)$id_room
]); 




header('location: sessions');