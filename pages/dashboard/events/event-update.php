<?php 
include '../../connect_db.php';

$id_event = $_POST['id'];

include '../../connect_db.php';

if(isset($_FILES['image']) && $_FILES['image']['error'] != 4){
    $acceptable = [
        'image/jpeg',
        'image/png',
        'image/gif',
    ];


    if(!in_array($_FILES['image']['type'], $acceptable)){
        $alert = 'Le fichier doit être du format JPEG, GIF ou PNG.';
        header('location: events?type=modify&id=' . $id_movie . '&alert=' . $alert);
        exit();
    }

    $maxSize = 2 * 1024 * 1024; 

    if($_FILES['image']['size'] > $maxSize){
        $alert = 'Le fichier doit faire moins de 2 Mo.';
        header('location: events?type=modify&id="' . $id_movie . '&alert=' . $alert);
        exit();
    }
}

$from = $_FILES['image']['tmp_name'];

$q = "SELECT image FROM EVENT WHERE id_event = $id_event";
$req = $bdd->query($q);
$result = $req->fetch(PDO::FETCH_ASSOC);
$destination = $result['image'];
$saveResult = move_uploaded_file($from, $destination);

$q = "UPDATE EVENT SET name=:name, description=:description, date_event=:date_event, capacity=:capacity, price=:price, start_time=:start_time, image=:image WHERE id_event = $id_event";
$req = $bdd->prepare($q); 
$response = $req->execute([
    'name' => trim($_POST['name']),
    'description' => trim($_POST['description']),
    'date_event' => $_POST['date'],
    'capacity' => trim((int)$_POST['capacity']),
    'price' => trim((float)$_POST['price']),
    'start_time' => $_POST['time'],
    'image' => $destination
]); 

$alert = "alter_success";
header('location: events?alert=' . $alert);
exit();