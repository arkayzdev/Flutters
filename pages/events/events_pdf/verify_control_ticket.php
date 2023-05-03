<?php 
//Connect to db
include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");
setlocale(LC_TIME, 'fr_FR.utf8','fra'); 

// Get every informations we need 
    // ORDER
    $q = 'SELECT * FROM USERS WHERE email = :email;';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'email' => 'huangfrederic2002@gmail.com'
    ]);
    $result_ = $req -> fetch(PDO::FETCH_ASSOC);
    $pwd = $result_['password'];

    $q = 'SELECT * FROM ORDERS WHERE  order_id = :order_id;';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'order_id' => $_GET['order_id']
    ]);
    $result_ = $req -> fetch(PDO::FETCH_ASSOC);
    $state = $result_['validate'];



    if($state == 1){
        $msg = "TICKET ALREADY VALIDATED";
        header('location: control_ticket.php?id=' . $_GET['order_id'] . '&msg=' . $msg);
        exit;
    }elseif($pwd == hash('sha512', $_GET['code'])){
        $q = 'UPDATE ORDERS SET validate = 1 WHERE order_id = :order_id';
        $req = $bdd->prepare($q);
        $reponse = $req->execute([
            'order_id' => $_GET['order_id']
        ]);



        $msg = "TICKET SECCUESSFULLY VALIDATED.";
        header('location: control_ticket.php?id=' . $_GET['order_id'] . '&msg=' . $msg);
        exit;
    } else {
        $msg = "ERROR : SUPER ADMIN CODE ERRONED.";
        header('location: control_ticket.php?id=' . $_GET['order_id'] . '&msg=' . $msg);
        exit;
    }

?>