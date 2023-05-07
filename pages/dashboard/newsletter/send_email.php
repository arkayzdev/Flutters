<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
 
  <title>Dashboard</title>

  <!-- Icons -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <link href="../dashboard.css" rel="stylesheet">
</head>

<body  class="ld_item">
<?php 
          // LD MODE COOKIES PAS TOUCHER
    if (!isset($_COOKIE['ld_mode'])) {
      setcookie("ld_mode", 3, $_SERVER['DOCUMENT_ROOT']);
    }
    include ($_SERVER['DOCUMENT_ROOT'].'/ld_mode/ld_mode.php');
    ?>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="../../../../"><img src="../img/header-logo.svg" alt="" width="120" height="35"></a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        <a class="nav-link px-3" href="../deconnexion.php">Déconnexion</a>
      </div>
    </div>
</header> 
 
  <div class="container-fluid">
    <div class="row">
      
    <?php include '../sidebar.php' ;

    ?>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 ld_item d-flex align-items-center" style="padding:3em;">
      <form class="d-flex flex-column m-2 col-10 ld_itema" method="POST" action="send_php_mailer.php" enctype="multipart/form-data">
            <div>
                <div class="d-flex">

                    <!-- IMAGE -->
                    <div class="me-4 d-flex flex-column">
                        <img src="../movies/img/Aperçu.png" id="preview-image" style="width: 240px; height: 350px; object-fit: cover;" />
                        <small class="mb-2 form-text" id="poster-image-inline">Format JPEG/PNG/GIF- 2 Mo max</small>
                        <div class="d-flex flex-column mb-3 btn btn-dark " style="width:60%">
                            <label class="form-label text-white m-1" for="customFile1">Choisir image</label>
                            <input type="file" accept="image/*" onchange="loadFile(event)" class="form-control d-none" id="customFile1" aria-describedby="poster-image-inline" name="image">
                      </div>
                      <div>
                          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#createModal">
                              Confirmer
                          </button>
                          <button type="button" class="btn" style="background-color: #c6c6c6;">
                              <a class="text-light" href="newsletter.php">Annuler</a> 
                          </button>
                      </div>
                    </div>
                    
                    <!-- SUBJECT AND CONTENT -->
                    <div class="ml-2 d-flex flex-column">
                        <div class="mb-3">
                            <label class="form-label" for="film-input">Sujet</label>
                            <input class="form-control" name="subject" placeholder="Sujet" id="film-input" required>
                        </div>    
                        <label class="form-label" for="description-input">Contenu</label>
                        <textarea class="form-control" name="content" rows="9" cols="50" aria-describedby="descriptionHelp" id="description-input"></textarea>
                        
                        <p class="mt-3 mb-2">Template:</p>
                        <div style="border:1px solid lightgrey; border-radius:10px; background-color:white;">
                          <p style="color: grey;margin-bottom:0;">De la part de toute l'équipe Flutters,</p>
                          <p style="color: grey;">Bonjour <I>utilisateur</I> !</p>

                          <p style="color: rgba(240,70,70,0.8);"><I>Votre image</I></p>

                          <p style="color: rgba(240,70,70,0.8);"><I>Votre contenu</I></p>

                          <p style="color: grey;">Pour vous désinscrire, cliquez <I style=" text-decoration:underline;">ici.</I></p>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="createModalLabel">Confirmation</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Attention, le mail généré sera envoyé à toute les addresses inscrite dans la newsletter
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Envoyer</button>
                        <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #c6c6c6; color: white">Annuler</button>
                    </div>
                    </div>
                </div>
            </div>

        </form>
      </main>

      
    </div>
  </div>
  <script src="main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
    integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/gsap.min.js"></script>
  <script src="https://flutters.ovh/ld_mode/main.js"></script>
</body>

</html>