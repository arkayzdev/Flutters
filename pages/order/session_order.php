<?php
session_start();
setlocale(LC_TIME, 'fr_FR.utf8','fra'); 

//Connect to db
    include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");

// Verify if session exists
    if(!isset($_SESSION['email'])){
        $msg = "Vous devez être connecté pour réserver.";
        header('location: /pages/films/film_page.php?id=' . $_GET['id_movie'] . '&msg=' . $msg);
        exit;
    }

// Get every information i need
    // From session
        $q = 'SELECT * FROM SESSION WHERE id_session = :id_session;';

        $req = $bdd->prepare($q);
        $reponse = $req->execute([
            'id_session' => $_GET['id_session'],
        ]);
        $session = $req -> fetchAll(PDO::FETCH_ASSOC);

        $session_id = $session[0]['id_session'];        
        $session_date = ucwords(strftime('%A %e %B %Y',strtotime($session[0]['seance_date'])));
        $session_start_time = date("H:i", strtotime($session[0]['start_time']));
        $session_language = $session[0]['language'];
        $session_room = $session[0]['id_room'];
        $session_price = number_format($session[0]['price'],2);

    // From movie
        $q = 'SELECT * FROM MOVIE WHERE id_movie = :id_movie;';
        $req = $bdd->prepare($q);
        $reponse = $req->execute([
            'id_movie' => $_GET['id_movie'],
        ]);
        $movie = $req -> fetchAll(PDO::FETCH_ASSOC);

        $movie_title = $movie[0]['title'];
        $movie_duration = $movie[0]['duration'];
        $movie_poster = $movie[0]['poster_image'];

    // From Room
        $q = 'SELECT * FROM ROOM WHERE id_room = :id_room;';
        $req = $bdd->prepare($q);
        $reponse = $req->execute([
            'id_room' => $session_room,
        ]);
        $room = $req -> fetchAll(PDO::FETCH_ASSOC);

        $room_capacity = $room[0]['capacity_seat'];
        $room_name = $room[0]['room_name'];

    // Room Remaining seats
        $q = 'SELECT count(id_ticket) FROM TICKET WHERE id_session = :id_session;';
        $req = $bdd->prepare($q);
        $reponse = $req->execute([
            'id_session' => $session_id,
        ]);
        $seat= $req -> fetchAll(PDO::FETCH_ASSOC);

        $room_remaining_seats = $room_capacity - $seat[0]['count(id_ticket)'];


    // End time
        $timestamp = strtotime($session_start_time."+".$movie_duration." minutes");
        $session_end_time = date("H:i", $timestamp);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo '<title>Flutters : '. $movie_title . '</title>'; ?>

      <!-- Import Bootstrap CSS Library -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Import css -->
    <link href="session_order.css?rs=<?= time() ?>" rel="stylesheet">
    <!-- ICONS -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/solid.css">
</head>
<body class="d-flex">
    <!-- order  -->
    <main class="col-5 d-flex flex-column align-items-center ">
        <!-- Menu -->
        <div id="order_menu" class="d-flex justify-content-between">
            <a href="/pages/films/film_page.php?id=<?php echo $_GET['id_movie'] ?>" class="back_button"><i class="uis uis-arrow-circle-left"></i></a>
        </div>

        <h3><?php echo $movie_title?></h3>
        <p style="font-weight:600; font-size:1.3em">Cinéma Flutters La Misère</p>
        <p>28 Boulevard de la Misère, Paris 15ème</p>

        <!-- Content -->
        <div id="order_content">
            <p>Date</p>
            <p class="order_divider"><?php echo $session_date?></p>

            <p>Seance</p>
            <p><?php echo $session_start_time . ' ∘ ' . $session_language?></p>
            <p class="order_divider" style="font-weight:500;">Fin prévue à <?php echo $session_end_time?></p>

            <p>Salle <?php echo $room_name?> (<?php echo $room_capacity?> places)</p>
            <p class="order_divider" style="font-weight:500;"> <?php echo $room_remaining_seats?> places restantes</p>
        </div>

        <!-- tickets -->
        <div id="ticket" class="d-flex flex-column align-items-center">

            <!-- select_ticket quantity -->
            <div id="select_ticket">
                <button disabled id="select_ticket_minus" onclick="select_ticket('minus', '<?php echo $session_price ?>')" ><i class="uil uil-minus-circle"></i></button>
                <input id="select_ticket_value" style="display:none;" value=0>
                <p id="select_ticket_quantity"> 0 Billet(s)</p>
                <button id="select_ticket_plus" onclick="select_ticket('plus', '<?php echo $session_price ?>')" ><i class="uil uil-plus-circle"></i></button>
            </div>

            <p>Prix unitaire : <?php echo $session_price?>€ TTC</p>
            <p>8 billets maximum autorisé par commande</p>
                <button id="select_ticket_total">Prix Total : 0.00€ TTC</button>
                <button disabled onclick="redirect_payment(<?php echo $session_id?>)" style="display:none" id="order_validate_mobile"><i id="order_validate_mobile_i" class="uis uis-arrow-circle-right"></i></button>
        </div>
    </main>

    <!-- poster  -->
    <div class="col-7 d-flex justify-content-center flex-column align-items-center r_background" style="background: linear-gradient(to left, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.8) 50%,rgba(0, 0, 0, 0.9) ), url('../dashboard/movies/<?php echo $movie_poster ?>');">
        <img src="../dashboard/movies/<?php echo $movie_poster ?>">
        <button disabled onclick="redirect_payment(<?php echo $session_id?>)" id="order_validate_pc">Continuer vers le paiement<i class="uis uis-arrow-circle-right"></i></button>
    </div>


    <!-- Import Bootstrap JS Library -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/gsap.min.js"></script>
    <script src="main.js"></script>
</body>
</html>