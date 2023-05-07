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
        <?php include("/var/www/flutters.ovh/pages/nav/nav.php"); 

        // LD MODE COOKIES PAS TOUCHER
        if (!isset($_COOKIE['ld_mode'])) {
            setcookie("ld_mode", 3, time()+3600);
        }
        include ($_SERVER['DOCUMENT_ROOT'].'/ld_mode/ld_mode.php');
?>

        <h2 id="about_h2">À propos</h2>
        
        <main class="ld_item" id=main_allabout>

        <section>
      <h1 class="directeurs_about">Fondateurs de Flutters</h1>
      <br />
      <br />
    </section>
    <section>
      <div class="main_about">
        <div class="container_allcard">
          <div class="card_directeurs">
            <img src="img/jojo.jpg" />
            <div class="details_directeurs">
              <h3>TODOROV Jonathan</h3>
              <p>Directeur</p>
              <div class="social-links_directeurs">
                <a
                  href="https://www.facebook.com/zuck/?locale=fr_FR"
                  target="_blank"
                  ><i class="uil uil-facebook-f"></i
                ></a>
                <a href="https://www.instagram.com/zuck/" target="_blank"
                  ><i class="uil uil-instagram"></i
                ></a>
                <a href="https://twitter.com/finkd?lang=fr" target="_blank"
                  ><i class="uil uil-twitter-alt"></i
                ></a>
              </div>
            </div>
          </div>
          <div class="card_directeurs">
            <img src="img/fred.jpg" />
            <div class="details_directeurs">
              <h3>HUANG Frédéric</h3>
              <p>Directeur</p>
              <div class="social-links_directeurs">
                <a
                  href="https://www.facebook.com/DwayneJohnson/?locale=fr_FR"
                  target="_blank"
                  ><i class="uil uil-facebook-f"></i
                ></a>
                <a href="https://www.instagram.com/therock/" target="_blank"
                  ><i class="uil uil-instagram"></i
                ></a>
                <a href="https://twitter.com/TheRock" target="_blank"
                  ><i class="uil uil-twitter-alt"></i
                ></a>
              </div>
            </div>
          </div>
          <div class="card_directeurs">
            <img src="img/franck.jpg" />
            <div class="details_directeurs">
              <h3>ZHUANG Franck</h3>
              <p>Directeur</p>
              <div class="social-links_directeurs">
                <a
                  href="https://www.facebook.com/BillGates/?locale=fr_FR"
                  target="_blank"
                  ><i class="uil uil-facebook-f"></i
                ></a>
                <a
                  href="https://z-p4.www.instagram.com/thisisbillgates/?hl=fr-ca"
                  target="_blank"
                  ><i class="uil uil-instagram"></i
                ></a>
                <a href="https://twitter.com/BillGates" target="_blank"
                  ><i class="uil uil-twitter-alt"></i
                ></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <h1 class="directeurs_about">Présentation Flutters</h1>
      <br />
      <br />
    </section>
    <div class="about_history">
      <details class="card_history">
        <summary>
          <h2 id="title_history">Flutters</h2>
          <h3 id="title2_history">Présentation du cinéma Flutters</h3>
          <div class="crop">
            <img src="/pages/about/img/Icon-White.svg  " alt="" />
          </div>
        </summary>

        <p id="text_history">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt eum
          assumenda repellendus aperiam veniam mollitia consequatur laudantium
          vero iusto fugit quaerat ratione similique facere sequi voluptates,
          voluptas magni reprehenderit iste.Lorem, ipsum dolor sit amet
          consectetur adipisicing elit. Provident omnis velit eveniet
          repellendus, quidem ullam, laboriosam animi aspernatur dolorum
          officiis eligendi architecto molestias, sequi quae quas consequatur
          ipsa. Ut, iusto.
        </p>
        <p id="text_history">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam, hic
          esse? Quod iure magnam recusandae necessitatibus? Eum ullam dolore
          accusamus perferendis officia. Repudiandae, fugit? Mollitia quos
          recusandae similique deleniti minus?Lorem, ipsum dolor sit amet
          consectetur adipisicing elit. Provident omnis velit eveniet
          repellendus, quidem ullam, laboriosam animi aspernatur dolorum
          officiis eligendi architecto molestias, sequi quae quas consequatur
          ipsa. Ut, iusto.
        </p>
        <p id="text_history">
          Lorem, ipsum dolor sit amet consectetur adipisicing elit. Provident
          omnis velit eveniet repellendus, quidem ullam, laboriosam animi
          aspernatur dolorum officiis eligendi architecto molestias, sequi quae
          quas consequatur ipsa. Ut, iusto.Lorem, ipsum dolor sit amet
          consectetur adipisicing elit. Provident omnis velit eveniet
          repellendus, quidem ullam, laboriosam animi aspernatur dolorum
          officiis eligendi architecto molestias, sequi quae quas consequatur
          ipsa. Ut, iusto.
        </p>
      </details>
    </div>

    <section>
      <h1 class="flutters_about">Notre parcours</h1>
      <br />
      <br />
    </section>
    <section class="timeline">
      <div class="info_about">
        <img width="50" height="50" src="/pages/about/img/Icon-White.svg" alt="" />
        <h2>Il etait une fois</h2>
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
        <script src="https://flutters.ovh/ld_mode/main.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>
