<?php session_start();
  // $_SESSION['email']='huangfrederic2002@gmail.com';
  // $_SESSION['user_type']='Normal';

  // logs
  // type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated  | $page = actual url
  $log_type = 3; 
  $log_page = 'flutters.ovh';
  include($_SERVER['DOCUMENT_ROOT']."/log.php");
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
    include 'pages/nav/nav.php'; ?>

  <!-- homepage-welcome_attach -->
  <div id="homepage-welcome_attach">

    <!-- homepage-welcome_attach_pitch -->
    <div id="homepage-welcome_attach_pitch">
      <h3>Revivez vos <span style="color: #E32828;">meilleurs</span> instants, <br> aux meilleurs prix.</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. <br>
        Morbi bibendum ante lorem, ac fringilla purus feugiat eu. <br>
        Vivamus quis felis et metus fringilla sodales. <br>
        Suspendisse sit amet dolor arcu. </p>
      <a class="hover-effect" href="">Voir les films</a>
    </div>

  </div>

  <!-- Featured Movies -->
    <section>
      <h1 class="alaffiche">À l'affiche</h1>
      <br />
      <br />
    </section>
    <section>
      <div class="scroll-holder">
        <div class="scroll-tray">
          <div>
            <a href="https://Flutters.ovh">
            <img src="img/homepage/1.webp" /><a/>
          </div>
          <div>
          <a href="https://Flutters.ovh">
            <img src="img/homepage/2.webp" /></a>
          </div>
          <div>
          <a href="https://Flutters.ovh">
            <img src="img/homepage/3.webp" /></a>
          </div>
          <div>
          <a href="https://Flutters.ovh">
            <img src="img/homepage/4.webp" /></a>
          </div>
          <div>
          <a href="https://Flutters.ovh">
            <img src="img/homepage/5.webp" /></a>
          </div>
          <div>
          <a href="https://Flutters.ovh">
            <img src="img/homepage/6.webp" /></a>
          </div>
          <div>
          <a href="https://Flutters.ovh">
            <img src="img/homepage/7.webp" /></a>
          </div>
          <div>
          <a href="https://Flutters.ovh">
            <img src="img/homepage/8.webp" /></a>
          </div>
          <div>
          <a href="https://Flutters.ovh">
            <img src="img/homepage/9.webp" /></a>
          </div>
          <div>
          <a href="https://Flutters.ovh">
            <img src="img/homepage/10.webp" /></a>
          </div>
          <div>
          <a href="https://Flutters.ovh">
            <img src="img/homepage/11.jpeg" /></a>
          </div>
          <div>
          <a href="https://Flutters.ovh">
            <img src="img/homepage/12.jpeg" /></a>
          </div>
          <div>
          <a href="https://Flutters.ovh">
            <img src="img/homepage/13.webp" /></a>
          </div>
          <div>
          <a href="https://Flutters.ovh">
            <img src="img/homepage/12.jpeg" /></a>
          </div>
          <div>
          <a href="https://Flutters.ovh">
            <img src="img/homepage/11.jpeg" /></a>
          </div>
          <div>
          <a href="https://Flutters.ovh">
            <img src="img/homepage/10.webp" /></a>
          </div>
          <div>
          <a href="https://Flutters.ovh">
            <img src="img/homepage/9.webp" /></a>
          </div>
          <div>
          <a href="https://Flutters.ovh">
            <img src="img/homepage/8.webp" /></a>
          </div>
          <div>
          <a href="https://Flutters.ovh">
            <img src="img/homepage/7.webp" /></a>
          </div>
          <div>
          <a href="https://Flutters.ovh">
            <img src="img/homepage/6.webp" /><a/>
          </div>
          <div>
          <a href="https://Flutters.ovh">
            <img src="img/homepage/5.webp" /></a>
          </div>
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
      <div class="carousel-item active c-item">
        <img src="img/image_28.png" class="d-block w-100 c-img" alt="Slide 1" />
        <div class="carousel-caption top-0 mt-4">
          <p class="mt-5 fs-3 text-uppercase">Les événements</p>
          <h1 class="display-1 fw-bolder text-capitalize">FRENCH FESTIVAL</h1>
          <button class="btn btn-outline-light px-4 py-2 fs-5 mt-5">
            VOIR PLUS
          </button>
        </div>
      </div>
      <div class="carousel-item c-item">
        <img src="img/image_28.png" class="d-block w-100 c-img" alt="Slide 2" />
        <div class="carousel-caption top-0 mt-4">
          <p class="text-uppercase fs-3 mt-5">Les événements</p>
          <p class="display-1 fw-bolder text-capitalize">
            CINÉMAS EXTERIEURS
          </p>
          <button class="btn btn-outline-light px-4 py-2 fs-5 mt-5" data-bs-toggle="modal" data-bs-target="#booking-modal">
            VOIR PLUS
          </button>
        </div>
      </div>
      <div class="carousel-item c-item">
        <img src="img/image_28.png" class="d-block w-100 c-img" alt="Slide 3" />
        <div class="carousel-caption top-0 mt-4">
          <p class="text-uppercase fs-3 mt-5">blablablabla</p>
          <p class="display-1 fw-bolder text-capitalize">blablablabla</p>
          <button class="btn btn-outline-light px-4 py-2 fs-5 mt-5" data-bs-toggle="modal" data-bs-target="#booking-modal">
            VOIR PLUS
          </button>
        </div>
      </div>
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
  <section>
      <h1 class="actutitre">Actualité</h1>
      <br />
      <br />
      <br />
    </section>
    <div class="wrapper">
      <section>
        <div class="hero-news hero-news1">
          <article class="hero-news__item">
            <h3 class="hero-news__item-title">
              Ces deux stars de cinéma pourraient être... frères !
              <br />
              <a class="redirection" href="https://Flutters.ovh"><mark>Lire la suite</mark></a>
            </h3>
            <div class="hero-news__item-date">15 AVril, 2023</div>
          </article>
          <article class="hero-news__item">
            <h3 class="hero-news__item-title">
              "Je n'irai pas voir Mario !" : pourquoi le Luigi de 1993 boycotte
              le film d'animation
              <a class="redirection" href="https://Flutters.ovh"><mark>Lire la suite</mark></a>
            </h3>
            <div class="hero-news__item-date">5 AVril, 2023</div>
          </article>
          <article class="hero-news__item">
            <h3 class="hero-news__item-title">
              Deadpool 3 : on le pensait mort mais ce personnage sera de retour
              !
              <br />
              <a class="redirection" href="https://Flutters.ovh"><mark>Lire la suite</mark></a>
            </h3>
            <div class="hero-news__item-date">1 AVril, 2023</div>
          </article>
        </div>
      </section>
    </div>

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
  <script src="homepage.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/gsap.min.js"></script>
</body>


</html>