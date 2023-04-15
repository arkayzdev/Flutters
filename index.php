<?php session_start();
  // $_SESSION['email']='huangfrederic2002@gmail.com';
  // $_SESSION['user_type']='Normal';
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
      href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css"
    />
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
      <br />
    </section>
    <section>
      <div class="scroll-holder">
        <div class="scroll-tray">
          <div>
            <img src="img/homepage/1.webp" />
          </div>
          <div>
            <img src="img/homepage/2.webp" />
          </div>
          <div>
            <img src="img/homepage/3.webp" />
          </div>
          <div>
            <img src="img/homepage/4.webp" />
          </div>
          <div>
            <img src="img/homepage/5.webp" />
          </div>
          <div>
            <img src="img/homepage/6.webp" />
          </div>
          <div>
            <img src="img/homepage/7.webp" />
          </div>
          <div>
            <img src="img/homepage/8.webp" />
          </div>
          <div>
            <img src="img/homepage/9.webp" />
          </div>
          <div>
            <img src="img/homepage/10.webp" />
          </div>
          <div>
            <img src="img/homepage/11.jpeg" />
          </div>
          <div>
            <img src="img/homepage/12.jpeg" />
          </div>
          <div>
            <img src="img/homepage/13.webp" />
          </div>
          <div>
            <img src="img/homepage/12.jpeg" />
          </div>
          <div>
            <img src="img/homepage/11.jpeg" />
          </div>
          <div>
            <img src="img/homepage/10.webp" />
          </div>
          <div>
            <img src="img/homepage/9.webp" />
          </div>
          <div>
            <img src="img/homepage/8.webp" />
          </div>
          <div>
            <img src="img/homepage/7.webp" />
          </div>
          <div>
            <img src="img/homepage/6.webp" />
          </div>
          <div>
            <img src="img/homepage/5.webp" />
          </div>
        </div>
        <div class="scroll-tray">
        <div>
            <img src="img/homepage/1.webp" />
          </div>
          <div>
            <img src="img/homepage/2.webp" />
          </div>
          <div>
            <img src="img/homepage/3.webp" />
          </div>
          <div>
            <img src="img/homepage/4.webp" />
          </div>
          <div>
            <img src="img/homepage/5.webp" />
          </div>
          <div>
            <img src="img/homepage/6.webp" />
          </div>
          <div>
            <img src="img/homepage/7.webp" />
          </div>
          <div>
            <img src="img/homepage/8.webp" />
          </div>
          <div>
            <img src="img/homepage/9.webp" />
          </div>
          <div>
            <img src="img/homepage/10.webp" />
          </div>
          <div>
            <img src="img/homepage/11.jpeg" />
          </div>
          <div>
            <img src="img/homepage/12.jpeg" />
          </div>
          <div>
            <img src="img/homepage/13.webp" />
          </div>
          <div>
            <img src="img/homepage/12.jpeg" />
          </div>
          <div>
            <img src="img/homepage/11.jpeg" />
          </div>
          <div>
            <img src="img/homepage/10.webp" />
          </div>
          <div>
            <img src="img/homepage/9.webp" />
          </div>
          <div>
            <img src="img/homepage/8.webp" />
          </div>
          <div>
            <img src="img/homepage/7.webp" />
          </div>
          <div>
            <img src="img/homepage/6.webp" />
          </div>
          <div>
            <img src="img/homepage/5.webp" />
          </div>
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
              <a class="redirection" href="”youtube.com”"><mark>Lire la suite</mark></a>
            </h3>
            <div class="hero-news__item-date">15 AVril, 2023</div>
          </article>
          <article class="hero-news__item">
            <h3 class="hero-news__item-title">
              "Je n'irai pas voir Mario !" : pourquoi le Luigi de 1993 boycotte
              le film d'animation
              <a class="redirection" href="”youtube.com”"><mark>Lire la suite</mark></a>
            </h3>
            <div class="hero-news__item-date">5 AVril, 2023</div>
          </article>
          <article class="hero-news__item">
            <h3 class="hero-news__item-title">
              Deadpool 3 : on le pensait mort mais ce personnage sera de retour
              !
              <br />
              <a class="redirection" href="”youtube.com”"><mark>Lire la suite</mark></a>
            </h3>
            <div class="hero-news__item-date">1 AVril, 2023</div>
          </article>
        </div>
      </section>
    </div>

  <!-- FAQ -->
  <div class="faq d-flex justify-content-center">
    <div class="col-sm-6 row faq-left d-flex ">
      <h2 id="faqtitre">Questions récurrentes</h2>
      <p>Notre centre d'aide en ligne n'est pas encore disponible.</p>
      <div class="faq-link">
        <a target="_blank" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ&ab_channel=RickAstley">N'appuyez pas<img src="img/angle-right.svg" alt="" width="5%"></a>
      </div>

    </div>
    <div class=" col-sm-6 faq-right d-flex justify-content-end">
      <div class="container-faq d-flex flex-column justify-content-center align-items-center">
        <div class="FluttersFAQ">
          <div class="visible-pannel d-flex justify-content-between align-items-center">
            <h4>Quelles sont les expériences proposées par les
              cinémas Flutter ?</h4>
            <img src="img/bottom-arrow.png" alt="croix animation">
          </div>
          <div class="toggle-pannel">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
              Morbi bibendum ante lorem, ac fringilla purus feugiat eu.
              Vivamus quis felis et metus fringilla sodales.
              Suspendisse sit amet dolor arcu.
              Maecenas diam metus, tincidunt vitae dolor ut, tincidunt.</p>
            <br>
          </div>
        </div>
        <hr>
        <div class="FluttersFAQ">
          <div class="visible-pannel d-flex justify-content-between align-items-center">
            <h4>Comment puis-je devenir ambassadeur de Flutters ?</h4>
            <img src="img/bottom-arrow.png" alt="croix animation">
          </div>
          <div class="toggle-pannel">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
              Morbi bibendum ante lorem, ac fringilla purus feugiat eu.
              Vivamus quis felis et metus fringilla sodales.
              Suspendisse sit amet dolor arcu.
              Maecenas diam metus, tincidunt vitae dolor ut, tincidunt.
              <br>
            </p>
          </div>
        </div>
        <hr>
        <div class="FluttersFAQ">
          <div class="visible-pannel d-flex justify-content-between align-items-center">
            <h4>Comment puis-je bénéficier de tarifs réduits ?</h4>
            <img src="img/bottom-arrow.png" alt="croix animation">
          </div>
          <div class="toggle-pannel">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit.
              Morbi bibendum ante lorem, ac fringilla purus feugiat eu.
              Vivamus quis felis et metus fringilla sodales.
              Suspendisse sit amet dolor arcu.
              Maecenas diam metus, tincidunt vitae dolor ut, tincidunt.
              <br>
            </p>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php include 'pages/footer/footer.php' ?>

  <!-- Import Bootstrap JS Library -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="homepage.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/gsap.min.js"></script>
</body>


</html>