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
  <!-- Import css -->
  <link href="homepage.css?rs=<?= time()?>" rel="stylesheet">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
</head>


<body>
  <!-- Import Header -->
  <?php 
    include 'pages/nav/nav.php';  ?>

  <!-- homepage-welcome_attach -->
  <div id="homepage-welcome_attach">

    <!-- homepage-welcome_attach_pitch -->
    <div id="homepage-welcome_attach_pitch">
      <h3>Revivez vos <span style="color: #E32828;">meilleurs</span> instants, aux meilleurs prix.</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. <br>
        Morbi bibendum ante lorem, ac fringilla purus feugiat eu. <br>
        Vivamus quis felis et metus fringilla sodales. <br>
        Suspendisse sit amet dolor arcu. </p>
      <a class="hover-effect" href="https://flutters.ovh/pages/films/films">Voir les films</a>
    </div>

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
    
    </section>
  <!-- homepage-event_carousel -->
  <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>


    <div class="carousel-inner">
    <?php
          $q = 'SELECT * FROM EVENT WHERE date_event >= CURRENT_DATE ORDER BY date_event ASC LIMIT 3;';
          $req = $bdd->prepare($q);
          $reponse = $req->execute();
          $result = $req -> fetchAll(PDO::FETCH_ASSOC);
          $i=0;
          
          foreach($result as $res){
          $i = $i+1;
          ?>
            <div class="carousel-item active c-item">
              <img src="/pages/dashboard/events/<?php echo $res['image']?>" class="d-block w-100 c-img" alt="<?php echo $i?>" />
              <div class="carousel-caption top-0 mt-4">
                <p style="font-weight:700" class="mt-5 fs-3 text-uppercase"><?php echo ucwords(strftime("%A %d %B %G", strtotime($res['date_event'])))?></p>
                <h1 class="display-1 fw-bolder text-capitalize"><?php echo htmlspecialchars($res['name'])?></h1>
                <a href="/pages/events/event_page.php?id=<?php echo $res['id_event']?>" class="btn btn-outline-light px-4 py-2 fs-5 mt-5">
                  VOIR PLUS
                </a>
              </div>
          </div>

    <?php
          }
    ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#hero-carousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#hero-carousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <!-- Actuality -->
  <section class="ld_item" style="padding-top: 5em;">
      <h1 style="margin-bottom:2em; margin-top:0;" class="actutitre ld_itema">Nos coups de coeur</h1>
      <div class="d-flex justify-content-around pt-5 " style="width:100%;padding-bottom:5em">

        <a href="/pages/films/film_page.php?id=86" class="col-3 d-flex flex-column align-items-center ourpref">
          <h3 class="ld_itema">Frédéric Huang</h3>
          <img src="/pages/dashboard/movies/movies-img/movie-poster-1683139154.jpg">
          <p class="ld_itema">"Pour combattre les monstres, nous avons créé nos propres monstres."</p>
        </a>

        <a href="/pages/films/film_page.php?id=88" class="col-3 d-flex flex-column align-items-center ourpref">
          <h3 class="ld_itema">Franck Zhuang</h3>
            <img src="/pages/dashboard/movies/movies-img/movie-poster-1683139976.jpg">
            <p class="ld_itema">"Quand on le veut, on peut. Tony Stark a réussi au fond d'une grotte."</p>
        </a>

        <a href="/pages/films/film_page.php?id=100" class="col-3 d-flex flex-column align-items-center ourpref">
        <h3 class="ld_itema">Jonathan Todorov</h3>
          <img src="/pages/dashboard/movies/movies-img/movie-poster-1683143567.jpg">
          <p class="ld_itema">"Vous n'avez pas le temps de réfléchir là-haut. Si vous pensez, vous êtes mort."</p>
        </a>

      </div>
    </section>

  <!-- FAQ -->

  <div class="allpage">
      <div class="backgroundfaq">
        <section class="card123">
          <div class="card__image"></div>
          <div class="card__text">
            <h1>FAQ</h1>

            <div class="accordion123">
              <div class="accordion__item">
                <button class="accordion__question">
                  Les expériences proposées par les cinémas Flutters
                  ?
                </button>
                <div class="accordion__collapse collapse">
                  <div class="accordion__content">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Morbi bibendum ante lorem, ac fringilla purus feugiat eu.
                    Vivamus quis felis et metus fringilla sodales. Suspendisse
                    sit amet dolor arcu. Maecenas diam metus, tincidunt vitae
                    dolor ut, tincidunt.
                  </div>
                </div>
              </div>
              <div class="accordion__item">
                <button class="accordion__question">
                  Comment puis-je devenir ambassadeur de Flutters ?
                </button>
                <div class="accordion__collapse collapse">
                  <div class="accordion__content">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Morbi bibendum ante lorem, ac fringilla purus feugiat eu.
                    Vivamus quis felis et metus fringilla sodales. Suspendisse
                    sit amet dolor arcu. Maecenas diam metus, tincidunt vitae
                    dolor ut, tincidunt.
                  </div>
                </div>
              </div>
              <div class="accordion__item">
                <button class="accordion__question">
                  Comment puis-je bénéficier de tarifs réduits ?
                </button>
                <div class="accordion__collapse collapse">
                  <div class="accordion__content">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Morbi bibendum ante lorem, ac fringilla purus feugiat eu.
                    Vivamus quis felis et metus fringilla sodales. Suspendisse
                    sit amet dolor arcu. Maecenas diam metus, tincidunt vitae
                    dolor ut, tincidunt.
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>    
  <!-- Footer -->
  <?php include 'pages/footer/footer.php' ?>

  <!-- Import Bootstrap JS Library -->
  <script src="https://flutters.ovh/ld_mode/main.js"></script>
  <script src="homepage.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/gsap.min.js"></script>
</body>


</html>