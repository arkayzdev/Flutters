<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription</title>

  <!-- Import Bootstrap CSS Library -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <!-- Login CSS file -->
  <link href="../login.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>

<body>
  <!-- Include Header -->
  <?php include("../../nav/login_nav.php"); ?>
  <!-- main -->
  <div class="d-flex w-100" id="page_background" style="height:100vh">
    <!-- background -->
    <div class="col col-lg-6 col-xl-7 d-none d-lg-inline img-fluid"></div>

    <!-- form -->
    <div class="col col-lg-6 col-xl-5 bg-white d-flex flex-column justify-content-start align-items-center" style="height:100vh">
      <!-- form title -->
      <div>
        <h2 style="margin-top: 30vh;font-size:2.8em; font-weight:700; text-align:center;"> Vérification du compte </h2>
      </div>
      <div>
        <?php
        if (!empty($_GET['message'])) {
          echo '<p class="confirmation-message" style="text-align:center; margin-top:3em;">' . htmlspecialchars($_GET['message']) . '</p>';
        } else {
          echo '<p class="validation-message" style="text-align:center; margin-top:3em;">Erreur: no ?message</p>';
        }
        ?>
        <p style="text-align:center; margin-top:2vh">Aller à la page de <a id="to-sign" href="../sign_in/sign_in.php">connexion</a></p>
      </div>
    </div>
  </div>
  <!-- Import Bootstrap JS Library -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/gsap.min.js"></script>
</body>

</html>