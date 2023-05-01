<?php
session_start();

//Connect to db
include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");

// Verify is session exist
if(!isset($_SESSION['email'])){
    $msg = "Connection expirée.";
    header('location: /pages/order?id=' . $id_session . '&msg=' . $msg);
    exit;
}

// Verifications
    $q = 'SELECT * FROM PAYMENT WHERE id = :id;';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'id' => $_GET['session_id'],
    ]);
    $result = $req -> fetchAll(PDO::FETCH_ASSOC);

    if(!isset($result[0])){
        $msg = 'ERREUR STRIPE ID FALSIFIED';
        header('location:/pages/login/sign_in/sign_in.php?message=' . $msg);
        exit;
    } 
    if($result[0]['account_email']!=$_SESSION['email']){
        $msg = 'ERREUR STRIPE EMAIL FALSIFIED';
        header('location:/pages/login/sign_in/sign_in.php?message=' . $msg);
        exit;
    }

// Get all informations we need 
    // SESSION
    $q = 'SELECT * FROM SESSION WHERE id_session = (SELECT id_session FROM PAYMENT WHERE id = :id)';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'id' => $_GET['session_id'],
    ]);
    $session_ = $req -> fetch(PDO::FETCH_ASSOC);


    // PAYMENT
    $q = 'SELECT * FROM PAYMENT WHERE id = :id';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'id' => $_GET['session_id'],
    ]);
    $payment_ = $req -> fetch(PDO::FETCH_ASSOC);

    // ROOM
    $q = 'SELECT * FROM ROOM WHERE id_room = (SELECT id_room FROM SESSION WHERE id_session = :id_session)';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'id_session' => $session_['id_session'],
    ]);
    $room_ = $req -> fetch(PDO::FETCH_ASSOC);

    // MOVIE
    $q = 'SELECT * FROM MOVIE WHERE id_movie = (SELECT id_movie FROM TAKE_PLACE WHERE id_session = :id_session)';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'id_session' => $session_['id_session'],
    ]);
    $movie_ = $req -> fetch(PDO::FETCH_ASSOC);

    // User_id
    $q = 'SELECT id_client FROM USERS WHERE email = :email';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'email' => $payment_['account_email'],
    ]);
    $email_ = $req -> fetch(PDO::FETCH_ASSOC);


    //Verify if order already exist
    $q = 'SELECT order_id FROM ORDERS WHERE order_id = :order_id';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'order_id' => $payment_['id'],
    ]);
    $order_ = $req -> fetch(PDO::FETCH_ASSOC);

    // Create Order and Tickets
    if(!isset($order_['order_id'])){
        // Create Order
            $q = 'INSERT INTO ORDERS(order_id, purchase_date, final_price, id_client) VALUES (:order_id, :purchase_date, :final_price, :id_client)';
            $req = $bdd->prepare($q);
            $reponse = $req->execute([
                'order_id' => $payment_['id'],
                'purchase_date' => date('Y-m-d'),
                'final_price' => ($payment_['price']/100),
                'id_client' => $email_['id_client'],
            ]);

        // Create Ticket(s)
        $price_unit = ($payment_['price']/100)/$session_['price'];
        echo $price_unit;

            for($i=0;$i!=$price_unit;$i++){
                $q = 'INSERT INTO TICKET(qr_code, id_session, order_id) VALUES (:qr_code, :id_session, :order_id)';
                $req = $bdd->prepare($q);
                $reponse = $req->execute([
                    'order_id' => $payment_['id'],
                    'qr_code' => 'AAA',
                    'id_session' => $session_['id_session'],
                ]);
            }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Success</title>
</head>
<body>
    <h1>Page en maintenance, vous pouvez dès à présent voir votre billet dans votre profil</h1>
</body>
</html>