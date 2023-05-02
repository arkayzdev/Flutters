<?php
session_start();
setlocale(LC_TIME, 'fr_FR.utf8','fra'); 

//Connect to db
include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");


// Verify is session exist
    if(!isset($_SESSION['email'])){
        $msg = "Connection expirée.";
        header('location: /pages/login/sign_in/sign_in.php?message=' . $msg);
        exit;
    }

// Check if the session match the order account_email 
    $q = 'SELECT account_email FROM PAYMENT WHERE id = :id;';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'id' => $_GET['order_id'],
    ]);
    $result = $req -> fetch(PDO::FETCH_ASSOC);

    if($result['account_email']!=$_SESSION['email']){
        $msg = "ERROR: ORDER EMAIL AND SESSION DON'T MATCH";
        header('location: /pages/login/sign_in/sign_in.php?message=' . $msg);
        exit;
    }


// Get every informations we need 
    // ORDER
    $q = 'SELECT * FROM ORDERS WHERE order_id = :order_id;';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'order_id' => $_GET['order_id'],
    ]);
    $order_ = $req -> fetch(PDO::FETCH_ASSOC);
    
    $order_id = $order_['order_id'];
    $purchase_date =  ucwords(strftime('%A %e %B %Y',strtotime($order_['purchase_date'])));

    // TICKET
    $q = 'SELECT *,count(id_ticket) FROM TICKET WHERE order_id = :order_id;';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'order_id' => $_GET['order_id'],
    ]);
    $ticket_ = $req -> fetch(PDO::FETCH_ASSOC);

    $nb_billet = $ticket_['count(id_ticket)'];
    
    // PAYMENT
    $q = 'SELECT * FROM PAYMENT WHERE id = :order_id;';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'order_id' => $_GET['order_id'],
    ]);
    $payment_ = $req -> fetch(PDO::FETCH_ASSOC);

    $final_price = number_format($payment_['price']/100,2);
    $email = $payment_['account_email'];

    // MOVIE 
    $q = 'SELECT * FROM MOVIE WHERE id_movie = (SELECT id_movie FROM TAKE_PLACE WHERE id_session = :id_session);';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'id_session' => $payment_['id_session'],
    ]);
    $movie_ = $req -> fetch(PDO::FETCH_ASSOC);

    $title = $movie_['title'];
    $duration = $movie_['duration'];
    $poster= $movie_['poster_image'];

    // SESSION
    $q = 'SELECT * FROM SESSION WHERE id_session = (SELECT id_session FROM PAYMENT WHERE id = :id);';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'id' => $payment_['id'],
    ]);
    $session_ = $req -> fetch(PDO::FETCH_ASSOC);

    $seance_date =ucwords(strftime('%A %e %B %Y',strtotime($session_['seance_date'])));
    $start_time = date('H:i', strtotime($session_['start_time']));
    $audio= $session_['language'];

    // SESSION
    $q = 'SELECT * FROM ROOM WHERE id_room = (SELECT id_room FROM SESSION WHERE id_session = :id);';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'id' => $payment_['id_session'],
    ]);
    $room_ = $req -> fetch(PDO::FETCH_ASSOC);

    $room = $room_['room_name'];
    $capacity = $room_['capacity_seat'];

    // Other
    $timestamp = strtotime($start_time."+".$duration." minutes");
    $end_time = date("H:i", $timestamp);

    // logs
    // type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated 8-LogOut 9-FailedToSignUp 10-AccountCreated  
    // 11-StripePaymentSent 12-StripePaymentSuccessfull 13-DownloadPDF | $page = actual url
    $log_type=13; $email=$_SESSION['email'];  $log_page=$session_['id_session'];
    include($_SERVER['DOCUMENT_ROOT']."/log.php");


require "../vendor/autoload.php";
ob_start();
require 'create_pdf.php';
$content = ob_get_clean();


$pdf = new \mikehaertl\wkhtmlto\Pdf();
$pdf->setOptions(['user-style-sheet' => realpath('pdf.css')]);
$pdf->addPage($content);

$pdf->send( str_replace('cs_test_','', $order_id) . '.pdf');