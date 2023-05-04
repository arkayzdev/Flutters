<?php
session_start();
//Connect to db
include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");
setlocale(LC_TIME, 'fr_FR.utf8','fra'); 


// Get every informations we need 
    // ORDER
    $q = 'SELECT * FROM ORDERS WHERE order_id = :order_id;';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'order_id' => $_GET['id'],
    ]);
    $order_ = $req -> fetch(PDO::FETCH_ASSOC);

    if(!isset($order_['order_id'])){
        $msg = 'ERREUR FALSIFIED QR CODE';
        header('location:/pages/login/sign_in/sign_in.php?message=' . $msg);
        exit;
    }
    
    $order_id = $order_['order_id'];
    $purchase_date =  ucwords(strftime('%A %e %B %Y',strtotime($order_['purchase_date'])));

    // TICKET
    $q = 'SELECT *,count(id_ticket) FROM TICKET WHERE order_id = :order_id;';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'order_id' => $_GET['id'],
    ]);
    $ticket_ = $req -> fetch(PDO::FETCH_ASSOC);

    $nb_billet = $ticket_['count(id_ticket)'];
    
    // PAYMENT
    $q = 'SELECT * FROM PAYMENT WHERE id = :order_id;';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'order_id' => $_GET['id'],
    ]);
    $payment_ = $req -> fetch(PDO::FETCH_ASSOC);

    $final_price = number_format($payment_['price']/100,2);
    $email = $payment_['account_email'];

    // EVENT
    $q = 'SELECT * FROM EVENT WHERE id_event = (SELECT id_event FROM TICKET WHERE order_id = :order_id LIMIT 1)';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'order_id' => htmlspecialchars($_GET['id'])
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrôle des tickets</title>

    <!-- Import Bootstrap CSS Library -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Import css -->
    <link href="stripe_success.css?rs=<?= time() ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>
<body style="background-color:lightgrey;height:100vh;" class="d-flex justify-content-center align-items-center">
    <style>
        p{padding:0;margin:0;}
    </style>
    <!-- Include Header -->
    <?php include("/var/www/flutters.ovh/pages/nav/nav.php");?>
    
    <div style="background-color: rgba(227,41,40,0.9);width:90%;height:70%; border-radius:15px;" class="d-flex justify-content-around align-items-center flex-column">

        <div class="d-flex justify-content-around align-items-center flex-column">
            <p><strong>Numéro de réservation</strong></p>
            <p style="color:white; word-break:break-word; text-align:center"><?php echo htmlspecialchars(str_replace('cs_test_','',$order_id));?></p>
        </div>

        <h1 style="text-align:center;"><?php echo htmlspecialchars($name)?></h1>

        <div class="d-flex justify-content-around align-items-center flex-column">
            <p><strong><?php echo htmlspecialchars($date_event)?></strong></p>
            <p>Début de l'évènement : <?php echo $start_time?></p>
        </div>
        
        <p><strong><?php echo $nb_tickets = $payment_['price']/$price/100;?></strong> billet(s)</p>


        <input type="password" id="code" required placeholder="Code staff" style="text-align:center" class="form-control w-50">
        <button class="btn btn-success mb-3" onclick="control_ticket('<?php echo htmlspecialchars($order_id)?>')">Vérifier</button>
    </div>

    <?php
    if(isset($_GET['msg'])){ 
    ?>
        <script>
     window.addEventListener("load", alert('<?php echo htmlspecialchars($_GET['msg'])?>'))
     </script>
     <?php
    }
    ?>


    <!-- Import Bootstrap JS Library -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/gsap.min.js"></script>
    <script src="main.js"></script>
</body>
</html>