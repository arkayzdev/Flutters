<?php session_start();
    // $_SESSION['email']='huangfrederic2002@gmail.com';
    // $_SESSION['email']='franck.zhuang@htm.fr';
    // $_SESSION['user_type']='Normal';

    // Connect to the db
    include("../connect_db.php");

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Flutters Films</title>

        <!-- Import Bootstrap CSS Library -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <!-- Import css -->
        <link href="films.css?rs=<?= time() ?>" rel="stylesheet">
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    </head>
    <body id="film_body">
        <!-- Include Header -->
        <?php include("/var/www/flutters.ovh/pages/nav/nav.php"); ?>

        <h2 id="film_h2">Films</h2>
        <main id="film_main">
            <?php
                $q = 'SELECT * FROM MOVIE WHERE id_movie IN(SELECT id_movie FROM TAKE_PLACE WHERE id_session IN (SELECT id_session FROM Flutters.SESSION WHERE seance_date >=(SELECT DATE(SYSDATE()) FROM dual)) ORDER BY release_date DESC) ORDER BY release_date DESC;';

                    $req = $bdd->prepare($q);
                    $reponse = $req->execute();
                    $result = $req -> fetchAll(PDO::FETCH_ASSOC);

                    foreach($result as $film) { 
                        echo '<a class="film_a" href="film_page.php?id=' . $film['id_movie'] . '">'
                    ?>
                            <?php 
                                echo '<img id="film_img" src="../dashboard/movies/' . $film['poster_image'] . '">
                                <p class="titles"> ' . $film['title'] . '</p> 
                            ';?>
                        </a>
                <?php 
                }
                ?>
        </main>
    </body>
</html>