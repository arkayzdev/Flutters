<?php session_start();
   
    include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>A propos</title>

        <!-- Import Bootstrap CSS Library -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <!-- Import css -->
        <link href="about.css?rs=<?= time() ?>" rel="stylesheet">
        <link href="about2.css?rs=<?= time() ?>" rel="stylesheet">

        <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"
    />
    </head>
    <body id="about_body">
        <!-- Include Header -->
        <?php include("/var/www/flutters.ovh/pages/nav/nav.php"); ?>

        <h2 id="about_h2">À propos</h2>
        
        <main id=main_allabout>

        <section>
      <h1 class="flutters_about">Flutters</h1>
      <br />
      <br />
    </section>
    <section class="timeline">
      <div class="info_about">
        <img width="50" height="50" src="pages/about/img/Icon-Black.svg" alt="" />
        <h2>Notre histoire</h2>
        <p>
          At vero eos et accusamus et iusto odio dignissimos ducimus qui
          blanditiis praesentium
        </p>
      </div>

      <ol>
        <li>
          <div id="first">
            <time>1998</time> In mattis elit vitae odio posuere, nec maximus
            massa varius. Suspendisse varius volutpat mattis. Vestibulum id
            magna est.
          </div>
        </li>
        <li>
          <div>
            <time>2000</time> In mattis elit vitae odio posuere, nec maximus
            massa varius. Suspendisse varius volutpat mattis. Vestibulum id
            magna est.
          </div>
        </li>
        <li>
          <div>
            <time>2009</time> In mattis elit vitae odio posuere, nec maximus
            massa varius. Suspendisse varius volutpat mattis. Vestibulum id
            magna est.
          </div>
        </li>
        <li>
          <div>
            <time>2012</time> Aenean condimentum odio a bibendum rhoncus. Ut
            mauris felis, volutpat eget porta faucibus, euismod quis ante.
          </div>
        </li>
        <li>
          <div>
            <time>2016</time> Vestibulum porttitor lorem sed pharetra dignissim.
            Nulla maximus, dui a tristique iaculis, quam dolor convallis enim,
            non dignissim ligula ipsum a turpis.
          </div>
        </li>
        <li>
          <div>
            <time>2019</time> In mattis elit vitae odio posuere, nec maximus
            massa varius. Suspendisse varius volutpat mattis. Vestibulum id
            magna est.
          </div>
        </li>
        <li>
          <div>
            <time>2021</time> In mattis elit vitae odio posuere, nec maximus
            massa varius. Suspendisse varius volutpat mattis. Vestibulum id
            magna est.
          </div>
        </li>
        <li>
          <div>
            <time>2023</time> In mattis elit vitae odio posuere, nec maximus
            massa varius. Suspendisse varius volutpat mattis. Vestibulum id
            magna est.
          </div>
        </li>
        <li></li>
      </ol>
    </section>
    
</main>
    

               <!-- Footer -->
               <?php include '/var/www/flutters.ovh/pages/footer/footer.php' ?>

        <!-- Import Bootstrap JS Library -->
        <script src="about.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>
