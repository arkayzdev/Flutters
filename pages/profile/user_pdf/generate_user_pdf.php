<?php
session_start();
setlocale(LC_TIME, 'fr_FR.utf8','fra'); 

//Connect to db
include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");


// Verify is session exist
    if(!isset($_SESSION['email'])){
        $msg = "Connection expirée.";
        header('location: /pages/login/sign_up/sign_up.php?message=' . $msg);
        exit;
    }


// Get every informations we need 
    // User
    $q = 'SELECT * FROM USERS WHERE email = :email;';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'email' => $_SESSION['email'],
    ]);
    $user_ = $req -> fetch(PDO::FETCH_ASSOC);

    $id_client = $user_['id_client'];
    $email = $user_['email'];
    $last_name = $user_['last_name'];
    $first_name = $user_['first_name'];

    // Newsletter
    $q = 'SELECT email FROM NEWSLETTER WHERE email = :email;';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'email' => $_SESSION['email'],
    ]);
    $newsletter_ = $req -> fetch(PDO::FETCH_ASSOC);

    if(!isset($newsletter_['email'])){
        $newsletter = 'Non inscrit';
    } else {
        $newsletter = 'Inscrit';
    }

    // Order
    $q = 'SELECT * FROM ORDERS WHERE id_client = (SELECT id_client FROM USERS WHERE email = :email);';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'email' => $_SESSION['email'],
    ]);
    $order_ = $req -> fetchAll(PDO::FETCH_ASSOC);


// logs
// type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated 8-LogOut 9-FailedToSignUp 10-AccountCreated  
// 11-StripePaymentSent 12-StripePaymentSuccessfull 13-DownloadPDF | $page = actual url
// $log_type=6; $email=$_SESSION['email']; $log_page = "";
// include($_SERVER['DOCUMENT_ROOT']."/log.php");


require "../../order/vendor/autoload.php";
ob_start();
require 'create_user_pdf.php';
require($_SERVER['DOCUMENT_ROOT'].'/logs/'. $email . '.txt');
$content = ob_get_clean();


$pdf = new \mikehaertl\wkhtmlto\Pdf();
$pdf->addPage($content);

$pdf->send($email . '.pdf');