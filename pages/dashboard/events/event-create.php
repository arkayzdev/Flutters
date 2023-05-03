<?php
include '../../connect_db.php';

if(isset($_FILES['image']) && $_FILES['image']['error'] != 4){
    $acceptable = [
                    'image/jpeg',
                    'image/png',
                    'image/gif',
                ];

    if(!in_array($_FILES['image']['type'], $acceptable)){
        $alert = 'Le fichier doit être du format JPEG, GIF ou PNG.';
        header('location: events?type=create&alert=' . $alert);
        exit();
    }

    $maxSize = 2 * 1024 * 1024; 
    if($_FILES['image']['size'] > $maxSize){
        $alert = 'Le fichier doit faire moins de 2 Mo.';
        header('location: events?type=create&alert=' . $alert);
        exit();
    }

    if(!file_exists('events-img')){
        mkdir('events-img'); 
    }
    
    $from = $_FILES['image']['tmp_name'];

    $timestamp = time(); 
    $array = explode('.', $_FILES['image']['name']);
    $extension = end($array); 
    $filename = 'event-poster-' . $timestamp . '.' . $extension;
    $destination = 'events-img/' . $filename;
    $saveResult = move_uploaded_file($from, $destination);

    if(!$saveResult){
        $alert= 'Le fichier n\'a pas pu être enregistré.';
        header('location: events?type=create&alert=' . $alert);
        exit();
    }
} else {
    $alert= 'Veuillez mettre une image.';
    header('location: events?type=create&alert=' . $alert);
}

$q = 'INSERT INTO EVENT (name, description, capacity, price, image, start_time, date_event) 
      VALUES (:name, :description, :capacity, :price, :image, :start_time, :date_event)';
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

$alert = "create_success";
header('location: events?alert=' . $alert);
exit();
