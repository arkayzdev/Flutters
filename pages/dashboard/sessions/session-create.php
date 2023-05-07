<?php
include '../../connect_db.php';

$room_name = $_POST['room'];
$movie_name = $_POST['movie'];
$session_date = $_POST['date'];
$start_time = $_POST['start_time'];
$str_session_date = strtotime($session_date . ' ' . $start_time);

$precedent_day_str = strtotime($session_date . "-1 day");
$precedent_day = date('Y-m-d', $precedent_day_str);

$q = "SELECT id_room FROM ROOM WHERE room_name = '$room_name'";
$req = $bdd->query($q);
$room = $req->fetch(PDO::FETCH_ASSOC);
$room_id = $room['id_room'];

$q = "SELECT s.seance_date, s.start_time, m.duration FROM SESSION s
    INNER JOIN TAKE_PLACE TP on s.id_session = TP.id_session
    INNER JOIN MOVIE m on TP.id_movie = m.id_movie
    WHERE (s.seance_date = '$session_date' OR s.seance_date = '$precedent_day')
    AND s.id_room = $room_id";
$req = $bdd->query($q);
$results = $req->fetchAll(PDO::FETCH_ASSOC);
    
foreach ($results as $session) {
    $session_str = $session['seance_date'] . ' ' . $session['start_time'];
    $min_time = strtotime($session_str);
    $max_time = strtotime($session_str . ' + ' . $session['duration'] . ' minutes');
    
    if ($str_session_date >= $min_time && $str_session_date <= $max_time) {
        $alert = 'Il existe déjà une séance durant cet horaire, dans la même salle.';
        header('location: sessions?type=create&alert=' . $alert);
        exit();
    }
}

if(strpos($movie_name, "'")) {
    $movie_name = str_replace("'","\'",$movie_name);
}

$q = "SELECT id_movie FROM MOVIE WHERE title = '$movie_name'";
$req = $bdd->query($q);
$movie = $req->fetch(PDO::FETCH_ASSOC);

$q = 'INSERT INTO SESSION (seance_date, start_time, language, price, id_room) 
      VALUES (:seance_date, :start_time, :language, :price, :id_room)';
$req = $bdd->prepare($q); 
$response = $req->execute([
    'seance_date' => $session_date,
    'start_time' => $start_time, 
    'language' => $_POST['language'],
    'price' => $_POST['price'], 
    'id_room' => $room_id
]); 

$id_session = (int)$bdd->lastInsertId();

$q = 'INSERT INTO TAKE_PLACE(id_session, id_movie) VALUES(:id_session, :id_movie)';
$req = $bdd->prepare($q);
$req->execute([
    'id_session' => $id_session,
    'id_movie' => (int)$movie['id_movie']
]);

$alert = 'create_success';
header('location: sessions?alert=' . $alert);
exit();