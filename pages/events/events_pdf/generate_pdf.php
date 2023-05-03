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
    // EVENT
    $q = 'SELECT * FROM EVENT WHERE id_event = (SELECT id_event FROM TICKET WHERE order_id = :order_id LIMIT 1)';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'order_id' => htmlspecialchars($_GET['order_id'])
    ]);
    $result = $req -> fetch(PDO::FETCH_ASSOC);

    $id = $result['id_event'];
    $name= $result['name'];
    $description= $result['description'];
    $date_event= ucwords(strftime('%A %e %B %Y',strtotime($result['date_event'])));
    $capacity= $result['capacity'];
    $price=number_format($result['price'],2);
    $image=$result['image'];
    $start_time= date('G:i',strtotime($result['start_time']));

    // PAYMENT
    $q = 'SELECT * FROM PAYMENT WHERE id = :id';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'id' => htmlspecialchars($_GET['order_id'])
    ]);
    $payment_ = $req -> fetch(PDO::FETCH_ASSOC);

    // ORDERS
    $q = 'SELECT * FROM ORDERS WHERE order_id = :id';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'id' => htmlspecialchars($_GET['order_id'])
    ]);
    $order_ = $req -> fetch(PDO::FETCH_ASSOC);

    $email = $payment_['account_email'];
    $purchase_date = ucwords(strftime('%A %e %B %Y',strtotime($order_['purchase_date'])));
    $nb_tickets = $payment_['price']/$price;
    $final_price = $payment_['price']/100;

    // logs
    // type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated 8-LogOut 9-FailedToSignUp 10-AccountCreated  
    // 11-StripePaymentSent 12-StripePaymentSuccessfull 13-DownloadPDF | $page = actual url
    $log_type=13; $email=$_SESSION['email'];  $log_page=$id;
    include($_SERVER['DOCUMENT_ROOT']."/log.php");


require "../vendor/autoload.php";
ob_start();
require 'create_pdf.php';
$content = ob_get_clean();


$pdf = new \mikehaertl\wkhtmlto\Pdf();
$pdf->setOptions(['user-style-sheet' => realpath('pdf.css')]);
$pdf->addPage($content);

$pdf->send( str_replace('cs_test_','', $_GET['order_id']) . '.pdf');