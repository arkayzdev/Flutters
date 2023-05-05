<?php 
    // LD MODE COOKIES PAS TOUCHER
    if (!isset($_COOKIE['ld_mode'])) {
      setcookie("ld_mode", 3, time()+3600, "/");
    }
    include ($_SERVER['DOCUMENT_ROOT'].'/ld_mode/ld_mode.php');

    session_start();
    // include($_SERVER['DOCUMENT_ROOT'] . '/pages/ban-check.php');
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
  <title>Page d'accueil</title>

  <!-- Import Bootstrap CSS Library -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
</head>


<body>
  <!-- Import Header -->
  <?php 
    include 'pages/nav/nav.php';  ?>

  </div>

  <!-- Featured Movies -->
    <section class="ld_item" style="padding-top:3em;">
      <h1 class="alaffiche ld_itema" style="margin-top:0;">À l'affiche</h1>
      <br />
      <br />
    </section>
    <section>
    <div id="a_l_affiche" class="ld_item" style="margin:0; padding-bottom:3em;">

      <?php
          $q = 'SELECT AVG(score),id_movie FROM REVIEW GROUP BY id_movie ORDER BY score DESC, count(id_movie) DESC, id_movie LIMIT 5;';

          $req = $bdd->prepare($q);
          $reponse = $req->execute();
          $result = $req -> fetchAll(PDO::FETCH_ASSOC);

          foreach($result as $r){
            $q = 'SELECT * FROM MOVIE WHERE id_movie = :id_movie';

            $req = $bdd->prepare($q);
            $reponse = $req->execute([
                'id_movie' => $r['id_movie']
            ]);
            $one = $req -> fetchAll(PDO::FETCH_ASSOC);

            foreach($one as $film) { 
              echo '<a class="film_a" href="pages/films/film_page.php?id=' . htmlspecialchars($film['id_movie']) . '">';
                      echo '<img id="film_img" src="pages/dashboard/movies/' . htmlspecialchars($film['poster_image']) . '">
                      <p class="titlesaff ld_itema"> ' . htmlspecialchars($film['title']) . '</p> 
                      </a>
                  ';?>
            <?php 
            }
          }
        ?>
        
    </div>
    


  <!-- Import Bootstrap JS Library -->
  <script src="https://flutters.ovh/ld_mode/main.js"></script>
  <script src="homepage.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/gsap.min.js"></script>
</body>


</html>