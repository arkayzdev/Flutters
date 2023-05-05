<?php 
  // LD MODE COOKIES PAS TOUCHER
  if (!isset($_COOKIE['ld_mode'])) {
    setcookie("ld_mode", 3, time()+3600, "/");
  }
  include ($_SERVER['DOCUMENT_ROOT'].'/ld_mode/ld_mode.php');

  session_start();
  include($_SERVER['DOCUMENT_ROOT'] . '/pages/ban-check.php');
  setlocale(LC_TIME, 'fr_FR.utf8','fra'); 

    // $_SESSION['email']='huangfrederic2002@gmail.com';
    // $_SESSION['email']='franck.zhuang@htm.fr';
    // $_SESSION['user_type']='Normal';

    // Connect to the db
    include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");


    // Get every informations of the movie
       $q = 'SELECT * FROM MOVIE WHERE id_movie = :id_movie';
      $req = $bdd->prepare($q);
      $reponse = $req->execute([
        'id_movie' => htmlspecialchars($_GET['id'])
      ]);
      $result = $req -> fetch(PDO::FETCH_ASSOC);
    
      $id = $result['id_movie'];
      $title = $result['title'];
      $poster = $result['poster_image'];
      $release_date = $result['release_date'];
      $description = $result['description'];
      $duration = $result['duration'];
      $trailer = $result['trailer'];

    // Language
      $q = 'SELECT name FROM LANGUAGE WHERE id_language = (SELECT id_language FROM IN_LANGUAGE WHERE id_movie = :id_movie)';
      $req = $bdd->prepare($q);
      $reponse = $req->execute([
        'id_movie' => htmlspecialchars($_GET['id'])
      ]);
      $origin_language = $req -> fetch(PDO::FETCH_ASSOC);
      $origin_language = $origin_language['name'];

    // Category
      $q = 'SELECT id_type from IS_TO WHERE id_movie = :id_movie';
      $req = $bdd->prepare($q);
      $reponse = $req->execute([
        'id_movie' => htmlspecialchars($_GET['id'])
      ]);
      $type = $req -> fetchAll(PDO::FETCH_ASSOC);

      $category = [];

      foreach($type as $type){
        $q = 'SELECT name from TYPE WHERE id_type = :id_type';
        $req = $bdd->prepare($q);
        $reponse = $req->execute([
          'id_type' => $type['id_type']
        ]);
        $type = $req -> fetch(PDO::FETCH_ASSOC);

        array_push($category, $type['name']);
      }
      $category = join('  -  ', $category);

    // Realisateur
      $q = 'SELECT id_director from REALIZED WHERE id_movie = :id_movie';
      $req = $bdd->prepare($q);
      $reponse = $req->execute([
        'id_movie' => htmlspecialchars($_GET['id'])
      ]);
      $realisator = $req -> fetchAll(PDO::FETCH_ASSOC);

      if(sizeof($realisator) != 0){
        $real = [];

        foreach($realisator as $realisator){
          $q = 'SELECT last_name,first_name from DIRECTOR WHERE id_director = :id_director';
          $req = $bdd->prepare($q);
          $reponse = $req->execute([
            'id_director' => $realisator['id_director']
          ]);
          $director = $req -> fetch(PDO::FETCH_ASSOC);

          $str = $director['first_name'] . ' '  . $director['last_name'];

          array_push($real, $str);
        }
        $realisator = join(' ,  ', $real);
      } else { 
        $realisator = 'Aucun';
      }

      // Acteur
      $q = 'SELECT id_actor from PLAYED WHERE id_movie = :id_movie';
      $req = $bdd->prepare($q);
      $reponse = $req->execute([
        'id_movie' => htmlspecialchars($_GET['id'])
      ]);
      $actor_film = $req -> fetchAll(PDO::FETCH_ASSOC);
  
      if(sizeof($actor_film) != 0){
      $real = [];
  
      foreach($actor_film as $actor_film){
        $q = 'SELECT last_name,first_name from ACTOR WHERE id_actor = :id_actor';
        $req = $bdd->prepare($q);
        $reponse = $req->execute([
          'id_actor' => $actor_film['id_actor']
        ]);
        $director = $req -> fetch(PDO::FETCH_ASSOC);
  
        $str = $director['first_name'] . ' ' . $director['last_name'];
  
        array_push($real, $str);
      }
      $actor = join(' ,  ', $real);
      } else {$actor = 'Aucun';}

    // Note
    $q = 'SELECT AVG(score) FROM Flutters.REVIEW WHERE id_movie = :id_movie;';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
      'id_movie' => htmlspecialchars($_GET['id'])
    ]);
    $note = $req -> fetch(PDO::FETCH_ASSOC);
    if($note['AVG(score)']==0){
      $note = '--';
    } else {
      $note = number_format($note['AVG(score)'],1);

    }

    // Today date
    $today = date('y-m-d'); 
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php echo '<title>Flutters : ' . $title . '</title>' ?>

  <!-- Import Bootstrap CSS Library -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <!-- Import css -->
  <link href="film_page.css?rs=<?= time() ?>" rel="stylesheet">
  <!-- ICONS -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/solid.css">
</head>
<body id="film_page">
  <!-- Include Header -->
  <?php include("/var/www/flutters.ovh/pages/nav/nav.php"); ?> 

         <!-- Button trigger message modal -->
    <button type="button" style="display:none" id="btn_message_modal" data-bs-toggle="modal" data-bs-target="#message_modal">
    </button>

          <!-- activate the message -->
    <?php 
    if(isset($_GET['msg'])){ 
      ?>
      <script>
        window.addEventListener("load", myInitFunction)

        function myInitFunction() {
          // window.onload = document.getElementById("btn_message_modal").click();
          window.addEventListener("load", document.getElementById("btn_message_modal").click());      }
      </script>
        <?php
     }?>
    <!-- message modal -->
    <div class="modal fade" id="message_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color:white;">
                <div class="modal-header" style="border:none;">
                    <h1 class="modal-title fs-5 mt-4" id="exampleModalLabel" style="font-weight:700;">Notification Flutters</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0 pb-0" style="border:none">
                    <?php echo '<p class="mb-0" style="font-weight:600;">' . $_GET['msg'] .'</p>';?>
                </div>
                <div class="modal-footer" style="border:none">
                    <button class="btn film_comment_button" type="button" data-bs-dismiss="modal">D'accord</button>
                </div>
            </div>
        </div>
    </div>

  <main>
    
    <!-- Section : film_presentation -->
    <section id="film_presentation" class="r_background" style="background: linear-gradient(to left, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.8) 50%,rgba(0, 0, 0, 0.9) ), url('../dashboard/movies/<?php echo htmlspecialchars($poster) ?>');">
      <div id="film_presentation_firstdiv" class="d-flex ">
        <!-- poster  -->
        <div class=" d-flex justify-content-center align-items-center" >
          <img src="../dashboard/movies/<?php echo htmlspecialchars($poster) ?>">
        </div>
        <!-- informations -->
        <div>
          <p class="fs-5 fw-bold mb-0" style="color:darkgrey;"><?php echo strtoupper(strftime("%d %B %G", strtotime($release_date)))?></p>
          <h2><?php echo htmlspecialchars($title)?></h2>
          <p class="fw-bolder"><?php echo htmlspecialchars($category)?></p>
          <p style="width:95%;"><?php echo htmlspecialchars($description)?></p>
          <div class="d-flex mb-3">
            <i class="uil uil-clock-eight col-4 col-sm-2">  <?php echo htmlspecialchars($duration)?> min</i>
            <i class="uil uil-film col-4 col-sm-2">   <?php echo htmlspecialchars($origin_language)?></i>
            <i class="uil uil-star ms-3 col-4 col-sm-2"> <?php echo $note?>/5</i>
          </div>
          <p style="padding-bottom:0!important;" class="mb-1">Réalisateurs principaux :  <?php echo htmlspecialchars($realisator)?></p>
          <p style="padding:0!important;" class="mb-4">Acteurs principaux :  <?php echo htmlspecialchars($actor)?></p>
          <a class="btn d-flex align-items-center justify-content-center" href="<?php echo htmlspecialchars($trailer)?>"><i class="uil uil-play">  Bande d'annonce</i></a>
        </div>
      </div>
    </section>

    <!-- Section : film_calendar -->
    <section id="film_calendar" class="pt-3 ld_item">

      <div id="film_calendar_div">
        <?php include('api/create_calendar.php'); ?>
      </div>
      
      <div class="d-none d-sm-block" style="height: 4em;border: 1px solid grey; margin: 0.6em 0.5em 0 0.5em;"></div>
      <?php echo '<input onchange="calendar_button_date(this.value, ' . $_GET['id'] . ')" class="calendar_button calendar_button_act" id="calendar_button_input" style=" visibility: hidden; width: 0; height:6em; margin:0; padding:0;" type="date" min="' . date('Y-m-d') . '">'?>

      <div style="display:flex">
        <!-- Bouton switching for mobile x other devices -->
        <button onclick="open_calendar()" id="switch_btn_pc" class="calendar_button calendar_button_act ld_itema  ld_itemz"><i class="uil uil-schedule"></i><p>Calendrier</p></button>

        <?php 
        echo '<div id="switch_btn_mobile_div"><input id="switch_btn_mobile" style="display:none;" onchange="calendar_button_date(this.value, ' . htmlspecialchars($_GET['id']) . ')" value="' . date('Y-m-d') . '" type="date" min="' . date('Y-m-d') . '"></div>';
        echo '<button value="' . strftime("%Y-%m-%d", strtotime($today)) . '" onclick="calendar_reload(this.value, ' . htmlspecialchars($_GET['id']) . ')" class="calendar_button calendar_button_act ld_itema ld_itemz"><i class="uil uil-redo"></i><p>Today</p></button>';
        ?>
      </div> 

    </section>

    <!-- Section : film_session -->
    <section class="ld_item" id="film_session">
        <div id="film_session_div">
          <h3 class="ld_itema">Flutters La Misère</h3>
          <p class="ld_itema" style="margin-bottom:1em">28 Boulevard de la Misère, Paris 15ème</p>
          <div id="film_session_sub_div">

            <?php include('api/create_film_session.php') ?>

          </div>
        </div>
    </section>

    <!-- Section : background-divider -->
    <section id="background-divider" style="background: linear-gradient(to left, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.8) 50%,rgba(0, 0, 0, 0.9) ), url('../dashboard/movies/<?php echo $poster ?>');">
      <img src="/img/homepage/Typo-White.svg">  
    </section>

    <!-- Section : film_comment -->
    <section id="film_comment" class="ld_item">
      <div id="film_comment_div">
        <div id="film_comment_title_div">
          <h2 class="ld_itema">Commentaires</h2>
          <div></div>
        </div>

        <div id="film_comment_sub_div">
          <?php include('api/create_commentaire.php'); ?>
        </div>

        <div id="film_comment_button_div">
        <?php if(isset($_SESSION['email'])){$comment_email = $_SESSION['email'];} else {$comment_email = '';}?>
        <?php $comment_id = htmlspecialchars($_GET['id'])?>
        <button id="film_comment_button" onclick="comment_show_more('<?php echo htmlspecialchars($comment_email)?>', '<?php echo htmlspecialchars($comment_id)?>')" class="btn film_comment_button">Voir plus</button>
        </div>

      </div>
    </section>

  </main>


  <!-- Footer -->
  <?php include '/var/www/flutters.ovh/pages/footer/footer.php' ?>

  <!-- Import Bootstrap JS Library -->
  <script src="https://flutters.ovh/ld_mode/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/gsap.min.js"></script>
  <script src="main.js"></script>
</body>
</html>