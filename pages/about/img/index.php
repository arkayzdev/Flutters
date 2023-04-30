<?php
    include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About</title>
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml" />
    <link href="open-sans.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="./assets/css/style.css" />
  </head>

  <body>


      <main>
      <section class="section about" aria-label="about">
          <div class="container">
            <div class="wrapper">
              <figure
                class="about-banner about-banner-1 img-holder"
                style="--width: 600; --height: 480"
              >
                <img
                  src="./assets/images/cammm.png"
                  width="600"
                  height="480"
                  loading="lazy"
                  
                  class="img-cover"
                />
              </figure>

              <h2 class="h2 section-title">Existe depuis 1999</h2>
            </div>

            <figure
              class="about-banner about-banner-2 img-holder"
              style="--width: 500; --height: 700"
            >
              <img
                src="./assets/images/tommm.png"
                width="500"
                height="700"
                loading="lazy"
                class="img-cover"
              />
            </figure>

            <div class="about-content">
              <h3 class="h2 section-title">L'histoire de Flutters</h3>

              <p class="section-text">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste
                blanditiis tempore deserunt rerum voluptate, numquam placeat
                voluptas sit. Facilis sequi corporis earum sint harum voluptates
                deserunt repudiandae sed eligendi veritatis!
              </p>

              <a href="#" class="btnabout">
                <span class="span">Découvrir</span>

                <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
              </a>

              <figure
                class="about-banner about-banner-3 img-holder"
                style="--width: 850; --height: 420"
              >
                <img
                  src="./assets/images/cineee.png"
                  width="850"
                  height="420"
                  loading="lazy"
                  class="img-cover"
                />
              </figure>
            </div>
          </div>
        </section>

        <!-- 
        - #COLLECTION
      -->

        <section
          class="section collection text-center"
          aria-labelledby="collection-label"
        >
          <div class="container">
            <h2 class="h2 section-title" id="collection-label">Fondateurs</h2>

            <p class="section-text">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin
              molestie ligula dignissim.
            </p>

            <ul class="grid-list">
              <li>
                <div class="collection-card">
                  <figure
                    class="card-banner img-holder"
                    style="--width: 500; --height: 550"
                  >
                    <img
                      src="./assets/images/franck.jpg"
                      width="500"
                      height="550"
                      loading="lazy"
                      
                      class="img-cover"
                    />
                  </figure>

                  <div class="card-content">
                    <h3 class="h3 card-title">ZHUANG Franck</h3>

                    <p class="card-text">Directeur</p>
                  </div>
                </div>
              </li>

              <li>
                <div class="collection-card">
                  <figure
                    class="card-banner img-holder"
                    style="--width: 500; --height: 550"
                  >
                    <img
                      src="./assets/images/fred.png"
                      width="500"
                      height="550"
                      loading="lazy"
                     
                      class="img-cover"
                    />
                  </figure>

                  <div class="card-content">
                    <h3 class="h3 card-title">HUANG Frédéric</h3>

                    <p class="card-text">Directeur</p>
                  </div>
                </div>
              </li>

              <li>
                <div class="collection-card">
                  <figure
                    class="card-banner img-holder"
                    style="--width: 500; --height: 550"
                  >
                    <img
                      src="./assets/images/jojo.jpg"
                      width="500"
                      height="550"
                      loading="lazy"
                   
                      class="img-cover"
                    />
                  </figure>

                  <div class="card-content">
                    <h3 class="h3 card-title">TODOROV Jonathan</h3>

                    <p class="card-text">Directeur</p>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </section>

        <!-- 
        - #FEATURES
      -->

        <section class="feature" aria-label="features">
          <div
            class="feature-banner has-bg-image has-after"
            style="background-image: url('./assets/images/chaise.png')"
          >
            <button
              class="play-btn"
              aria-label="play video: man making handmade belt"
            >
              <a
                href="https://www.youtube.com/watch?v=dQw4w9WgXcQ&ab_channel=RickAstley"
                target="_blank"
              >
                <img
                  src="./assets/images/play.svg"
                  width="60"
                  height="60"
                  loading="lazy"
                  alt="play icon"
                />
              </a>
            </button>
          </div>

          <div class="section feature-content">
            <div class="container">
              <h2 class="section-title">
                Un défis impossible ? <br />
                Nous le réalisons !
              </h2>

              <p class="section-text">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minus
                earum nulla officiis numquam consequatur veritatis quae dicta
                sunt perferendis quod, ullam alias animi. Aspernatur corrupti
                sed non soluta facere eum.
              </p>

              <br />
              <br />

              <ul class="feature-list">
                <li>
                  <div class="feature-list-card">
                    <div class="card-icon">
                      <img
                        src="./assets/images/feature-icon-1.svg"
                        width="45"
                        height="45"
                        loading="lazy"
                       
                      />
                    </div>

                    <div>
                      <h3 class="h4 card-title">
                        Élu meilleur cinéma (d'après nous)
                      </h3>

                      <p class="card-text">
                        5/5 étoiles sur Tripadvisor, Google et si vous êtes pas
                        convaincu, demandé à Mr Sanane !
                      </p>
                    </div>
                  </div>
                </li>

                <li>
                  <div class="feature-list-card">
                    <div class="card-icon">
                      <img
                        src="./assets/images/feature-icon-2.svg"
                        width="45"
                        height="45"
                        loading="lazy"
                        alt="badge icon"
                      />
                    </div>

                    <div>
                      <h3 class="h4 card-title">Équipement dernier cri</h3>

                      <p class="card-text">
                        On a même des sièges qui vibrent, c'est dire !
                      </p>
                    </div>
                  </div>
                </li>

                <li>
                  <div class="feature-list-card">
                    <div class="card-icon">
                      <img
                        src="./assets/images/feature-icon-3.svg"
                        width="45"
                        height="45"
                        loading="lazy"
                        alt="money bag icon"
                      />
                    </div>

                    <div>
                      <h3 class="h4 card-title">Prix abordable</h3>

                      <p class="card-text">
                        On est pas cher, mais on est pas gratuit non plus !
                      </p>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </section>

        <!-- 
        - TESTIMONIALS
      -->

        <section class="section testi" aria-label="testimonials">
          <div class="container">
            <div class="testi-card">
              <p class="card-text">
                Le plus beau cinéma du monde, et de loin ! Je recommande
                vivement !
              </p>

              <p class="client-name">SANANES Frédéric</p>

              <p class="client-title">Expert en cinéma depuis 2003</p>
            </div>
          </div>
        </section>

        <!-- 
        - #GALLERY
      -->

        <section class="gallery">
          <ul class="gallery-list">
            <li>
              <div
                class="gallery-card has-bg-image has-after"
                style="background-image: url('./assets/images/requin.avif')"
              >
                <div class="card-content">
                  <h3 class="h3 card-title">Screen X</h3>

                  <a href="actu1.html" class="btn-link" target="_blank">
                    <span class="span">Infos</span>

                    <ion-icon
                      name="arrow-forward"
                      aria-hidden="true"
                    ></ion-icon>
                  </a>
                </div>
              </div>
            </li>

            <li>
              <div
                class="gallery-card has-bg-image has-after"
                style="background-image: url('./assets/images/imax.avif')"
              >
                <div class="card-content">
                  <h3 class="h3 card-title">IMAX</h3>

                  <a href="actu2.html" class="btn-link" target="_blank">
                    <span class="span">Infos</span>

                    <ion-icon
                      name="arrow-forward"
                      aria-hidden="true"
                    ></ion-icon>
                  </a>
                </div>
              </div>
            </li>

            <li>
              <div
                class="gallery-card has-bg-image has-after"
                style="background-image: url('./assets/images/4dx.avif')"
              >
                <div class="card-content">
                  <h3 class="h3 card-title">4DX</h3>

                  <a href="actu3.html" class="btn-link" target="_blank">
                    <span class="span">Infos</span>

                    <ion-icon
                      name="arrow-forward"
                      aria-hidden="true"
                    ></ion-icon>
                  </a>
                </div>
              </div>
            </li>

            <li>
              <div
                class="gallery-card has-bg-image has-after"
                style="background-image: url('./assets/images/screenx.avif')"
              >
                <div class="card-content">
                  <h3 class="h3 card-title">Dolby cinéma</h3>

                  <a href="actu4.html" class="btn-link" target="_blank">
                    <span class="span">Infos</span>

                    <ion-icon
                      name="arrow-forward"
                      aria-hidden="true"
                    ></ion-icon>
                  </a>
                </div>
              </div>
            </li>
          </ul>
        </section>

        <!-- 
        - #BLOG
      -->

        <section class="section blog" aria-labelledby="blog-label">
          <div class="container">
            <h2 class="h2 section-title text-center" id="blog-label">
              Les projets
            </h2>

            <p class="section-text text-center">
              Les porojets en cours et à venir !
            </p>

            <ul class="grid-list">
              <li>
                <div class="blog-card">
                  <figure
                    class="card-banner img-holder"
                    style="--width: 1024; --height: 683"
                  >
                    <img
                      src="./assets/images/eco.png"
                      width="1024"
                      height="683"
                      loading="lazy"
                      class="img-cover"
                    />
                  </figure>

                  <div class="card-content">
                    <h3 class="h4">
                      <a href="#" class="card-title"> Ecologie </a>
                    </h3>

                    <div class="card-meta">
                      <time class="card-meta-wrapper" datetime="2022-10-12">
                        <span class="span">Avril 26, 2023</span>
                      </time>
                    </div>
                  </div>
                </div>
              </li>

              <li>
                <div class="blog-card">
                  <figure
                    class="card-banner img-holder"
                    style="--width: 1024; --height: 683"
                  >
                    <img
                      src="./assets/images/eco.png"
                      width="1024"
                      height="683"
                      loading="lazy"
                      class="img-cover"
                    />
                  </figure>

                  <div class="card-content">
                    <h3 class="h4">
                      <a href="#" class="card-title">
                        Ecologie x2 parce que on adore la nature
                      </a>
                    </h3>

                    <div class="card-meta">
                      <time class="card-meta-wrapper" datetime="2022-10-12">
                        <span class="span">October 12, 2022</span>
                      </time>
                    </div>
                  </div>
                </div>
              </li>
            </ul>

            <a href="#" class="btnabout">
              <span class="span">Read More</span>

              <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
            </a>
          </div>
        </section>
      </article>
    </main>

    <!-- 
    - #FOOTER
  -->

    <!-- 
    - custom js link
  -->
    <script src="./assets/js/script.js"></script>

    <!-- 
    - ionicon link
  -->
    <script
      type="module"
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"
    ></script>

  </body>
</html>
