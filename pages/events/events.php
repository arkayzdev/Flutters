<?php session_start();
setlocale(LC_TIME, 'fr_FR.utf8','fra'); 

    // $_SESSION['email']='huangfrederic2002@gmail.com';
    // $_SESSION['email']='franck.zhuang@htm.fr';
    // $_SESSION['user_type']='Normal';

    // Connect to the db
    include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Flutters Evènements</title>

        <!-- Import Bootstrap CSS Library -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <!-- Import css -->
        <link href="events.css?rs=<?= time() ?>" rel="stylesheet">
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    </head>
    <body id="event_body">
        <!-- Include Header -->
        <?php include("/var/www/flutters.ovh/pages/nav/nav.php"); ?>

        <h2 id="event_h2">Evènements</h2>
        
        <main id="event_main">
        <!-- Search -->
        <div id="events_searchbar">
            <input  onchange="event_search()" id="event_search" type="text" placeholder="Chercher un event">
            <button id="b" onclick="event_search()" type="button">Rechercher</button>
        </div>

            <h3 class="event_h3"> Evènements à venir </h3>

            <div id="a_l_affiche">
                <?php include('api/create_event_a_venir.php'); ?>
            </div>

            <div id="event_divider"></div>
            <h3 class="event_h3 mt-5"> Evènements passés</h3>

            <div id="tous_les_events">
                <?php include('api/create_event_passe.php'); ?>
            </div>
        </main>

              <!-- Footer -->
  <?php include '/var/www/flutters.ovh/pages/footer/footer.php' ?>
        <!-- Import Bootstrap JS Library -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/gsap.min.js"></script>
        <script src="main.js"></script>
    </body>
</html>