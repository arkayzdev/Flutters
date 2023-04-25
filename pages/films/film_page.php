<?php session_start();
  setlocale(LC_TIME, 'fr_FR.utf8','fra'); 
    // $_SESSION['email']='huangfrederic2002@gmail.com';
    // $_SESSION['email']='franck.zhuang@htm.fr';
    // $_SESSION['user_type']='Normal';

    // Connect to the db
    include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");


    // logs
    // type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated  | $page = actual url
    $log_type = 3; $log_page = 'https://flutters.ovh/pages/films/film_page/';
    include($_SERVER['DOCUMENT_ROOT']."/log.php");


    // Get every informations of the movie
    $q = 'SELECT * FROM MOVIE WHERE id_movie = :id_movie';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
      'id_movie' => htmlspecialchars($_GET['id'])
    ]);
    $result = $req -> fetch(PDO::FETCH_ASSOC);
   
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
    $note = '5';
    
    // Calendar Date
    $calendar = [];

    for($i=0; $i<6; $i++){
      array_push($calendar, date('Y-m-d', time()+$i*86400));
    }    
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
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
  <!-- ICONS -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>
<body id="film_page">
  <!-- Include Header -->
  <?php include("/var/www/flutters.ovh/pages/nav/nav.php"); ?> 

  <main>
    
    <!-- Section : film_presentation -->
    <section id="film_presentation" class="r_background" style="background: linear-gradient(to left, rgba(0, 0, 0, 0.95), rgba(0, 0, 0, 0.7) 50%,rgba(0, 0, 0, 0.95) ), url('../dashboard/movies/<?php echo $poster ?>');">
      <div id="film_presentation_firstdiv" class="d-flex ">
        <!-- poster  -->
        <div class="col-6 d-flex justify-content-center align-items-center" >
          <img src="../dashboard/movies/<?php echo $poster ?>">
        </div>
        <!-- informations -->
        <div class="col-6">
          <p class="fs-5 fw-bold mb-0" style="color:darkgrey;"><?php echo strtoupper(strftime("%d %B %G", strtotime($release_date)))?></p>
          <h2><?php echo $title?></h2>
          <p class="fw-bolder"><?php echo $category?></p>
          <p style="width:80%;"><?php echo $description?></p>
          <div class="d-flex mb-3">
            <i class="uil uil-clock-eight col-2">  <?php echo $duration?> min</i>
            <i class="uil uil-film col-2">   <?php echo $origin_language?></i>
            <i class="uil uil-star ms-3 col-2">    <?php echo $note?>/5</i>
          </div>
          <p class="mb-1">Réalisateur(s) :  <?php echo $realisator?></p>
          <p class="mb-4">Acteur(s) :  <?php echo $actor?></p>
          <a class="btn d-flex align-items-center justify-content-center" href="<?php echo $trailer?>"><i class="uil uil-play">  Bande d'annonce</i></a>
        </div>
      </div>
    </section>

    <!-- Section : film_calendar -->
    <section id="film_calendar" class="pt-3">
    <?php echo '<input class="d-none" id="calendar_selected_date" value=' . date('Y-m-d') . '>';?>
      <div id="film_calendar_div">

        <?php include('api/create_calendar.php'); ?>

      </div>
      
      <div style="height: 4em;border: 1px solid grey; margin: 0.6em 0.5em 0 0.5em;"></div>

      <div>
      <button onclick="" class="calendar_button calendar_button_act"><i class="uil uil-schedule"></i><p>Calendrier</p></button>
      <button onclick="" class="calendar_button calendar_button_act"><i class="uil uil-redo"></i><p>Today</p></button>
      </div>
    </section>

    <!-- Section : film_session -->
    <section style="width:100%; height:1000px;" id="film_session">
        <div id="film_session_div">
          <h3>Flutters La Misère</h3>
          <p>28 Boulevard de la Misère, Paris 15ème</p>
          <div id="film_session_sub_div">

            <?php include('api/create_film_session.php') ?>

          </div>
        </div>
    </section>



  </main>


  <!-- Footer -->
  <?php include '/var/www/flutters.ovh/pages/footer/footer.php' ?>

  <!-- Import Bootstrap JS Library -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/gsap.min.js"></script>
  <script src="main.js"></script>
</body>
</html>