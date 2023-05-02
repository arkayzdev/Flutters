<?php
session_start();
setlocale(LC_TIME, 'fr_FR.utf8','fra'); 

//Connect to db
include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");

// Verify is session exist
if(!isset($_SESSION['email'])){
    $msg = "Connection expirée.";
    header('location:/pages/login/sign_in/sign_in.php?message=' . $msg);
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

            for($i=0;$i!=$price_unit;$i++){
                $q = 'INSERT INTO TICKET(qr_code, id_session, order_id) VALUES (:qr_code, :id_session, :order_id)';
                $req = $bdd->prepare($q);
                $reponse = $req->execute([
                    'order_id' => $payment_['id'],
                    'qr_code' => 'NULL',
                    'id_session' => $session_['id_session'],
                ]);
            }
    }

    // Get order and ticket infos
    $q = 'SELECT * FROM ORDERS WHERE order_id = :order_id';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'order_id' => $payment_['id'],
    ]);
    $order_ = $req -> fetch(PDO::FETCH_ASSOC);

    $q = 'SELECT * FROM TICKET WHERE order_id = :order_id';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'order_id' => $payment_['id'],
    ]);
    $ticket_ = $req -> fetch(PDO::FETCH_ASSOC);

    $q = 'SELECT count(id_ticket) FROM TICKET WHERE order_id = :order_id';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'order_id' => $payment_['id'],
    ]);
    $nb_ticket_ = $req -> fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Success</title>

    <!-- Import Bootstrap CSS Library -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Import css -->
    <link href="stripe_success.css?rs=<?= time() ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>

<body style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.6) 50%,rgba(0, 0, 0, 0.9) ), url('../dashboard/movies/<?php echo $movie_['poster_image'] ?>');">
    <!-- Include Header -->
    <?php include("/var/www/flutters.ovh/pages/nav/nav.php"); 
    ?>

    <!-- Main content -->
    <main class="d-flex flex-column justify-content-center align-items-center">
        <h1>Merci pour votre commande !</h1>
        <p>Commande  #<?php echo str_replace("cs_test_", "", $order_['order_id'])?></p>
        <!-- Recap -->
        <div id="recap">
            <p style="align-self:center; margin-bottom:1em; "><strong>Réservé le <?php echo ucwords(strftime('%A %e %B %Y',strtotime($order_['purchase_date'])))?></strong></p>
            <p><strong>Email de facturation :</strong> <?php echo $payment_['email']?></p>

            <p><strong>Film :</strong> <?php echo $movie_['title']?></p>
            <p><strong>Séance: </strong><?php echo ucwords(strftime('%A %e %B %Y',strtotime($session_['seance_date'])))?> à <?php echo $session_['start_time']?> en salle <?php echo $room_['room_name']?> </p>

            <p><strong>Nombre de billets :</strong> <?php echo $nb_ticket_['count(id_ticket)']?> billets</p>
            <p><strong>Prix total :</strong> <?php echo number_format($payment_['price']/100, 2)?> € (<?php echo number_format($session_['price'],2) ?>€ par billet)</p>
        </div>
        <button onclick="download_ticket('<?php echo $_GET['session_id']?>')">Télécharger vos billets</button>
    </main>

    <!-- Footer -->
    <?php include '/var/www/flutters.ovh/pages/footer/footer.php' ?>

    <!-- Import Bootstrap JS Library -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/gsap.min.js"></script>
    <script src="main.js"></script>
</body>
</html>

<?php 
            // logs
    // type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated 8-LogOut 9-FailedToSignUp 10-AccountCreated  
    // 11-StripePaymentSent 12-StripePaymentSuccessfull 13-DownloadPDF | $page = actual url
    $log_type=12;   $log_page = 'HH';
    require_once($_SERVER['DOCUMENT_ROOT']."/log.php");
    ?>