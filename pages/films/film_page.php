<?php session_start();
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
    $category = join(' - ', $category);
    
    // Note
    $note = '*';
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
</head>
<body id="film_page">
  <!-- Include Header -->
  <?php include("/var/www/flutters.ovh/pages/nav/nav.php"); ?> 

  <main>
    
    <!-- Section : film_presentation -->
    <section id="film_presentation">
      <!-- poster  -->
      <img src="../dashboard/movies/<?php echo $poster ?>">
      <!-- informations -->
      <div>
          <p><?php echo $release_date?></p>
          <h2><?php echo $title?></h2>
          <p><?php echo $category?></p>
          <p><?php echo $description?></p>

        <div>
          <p><?php echo $duration?></p>
          <p><?php echo $origin_language?></p>
        </div>

        <div>
          <a href="<?php echo $trailer?>">Bande d'annonce</a>
          <p><?php echo $note?>/5</p>
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