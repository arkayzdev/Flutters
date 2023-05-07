<?php

    // logs
    // type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated  | $page = actual url
    $log_type = 3; $log_page = 'https://flutters.ovh/pages/login/sign_up/sign_up';
    include($_SERVER['DOCUMENT_ROOT']."/log.php");

    if(isset($_SESSION['email'])){
      header('location:/index');
      exit;
    }
?>

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
  <link rel="stylesheet" href="../login.css?rs=<?= time() ?>">
</head>

<body>
<?php 
          // LD MODE COOKIES PAS TOUCHER
    if (!isset($_COOKIE['ld_mode'])) {
      setcookie("ld_mode", 3, $_SERVER['DOCUMENT_ROOT']);
    }
    include ($_SERVER['DOCUMENT_ROOT'].'/ld_mode/ld_mode.php');
    ?>
  <!-- Include Header -->
  <?php include("/var/www/flutters.ovh/pages/nav/login_nav.php"); ?>

  <!-- main -->
  <div class="d-flex w-100" id="page_background" style="height:100vh">

    <!-- background -->
    <div class="col col-lg-6 col-xl-7 d-none d-lg-inline img-fluid"></div>

    <!-- form -->
    <div style="background-color:white;" class="col col-lg-6 col-xl-5  d-flex flex-column justify-content-center align-items-center ld_item">

      <!-- form title -->
      <div class="w-75" id="login_title" style="margin-bottom:2em"> 
        <h2 class="align-self-start ld_itema" style="font-size:3em; font-weight:700;"> Inscription </h2>
      </div>

      <!-- Error message -->
      <?php
      if (!empty($_GET['message'])) {
        echo '<p class="verification-message">' . htmlspecialchars($_GET['message']) . '</p>';
      }
      ?>

      <!-- form inputs -->
      <form class="w-75 mt-3" action="sign_up_verification.php" method="POST" enctype="multipart/form-data">
        <!-- first and last names -->
        <div class="d-flex flex-column flex-lg-row">
          <div class="col me-lg-4">
            <p class="mb-1 ld_itema">Nom</p>
            <div class="login-input">
              <img class="ms-1 me-1 pb-2" src="../img/char-login.png">
              <input class="col-8 mt-1 ms-2 ld_itema" style="background-color:inherit" type='text' name='lastname' placeholder="Nom" required value='<?= isset($_COOKIE['lastname']) ? htmlspecialchars($_COOKIE['lastname']) : '' ?>'>
            </div>
          </div>

          <div class="col">
            <p class="mb-1 ld_itema">Prénom</p>
            <div class="login-input">
              <img class="ms-1 me-1 pb-2" src="../img/char-login.png">
              <input class="col-8 mt-1 ms-2 ld_itema" style="background-color:inherit" type='text' name='firstname' placeholder="Prénom" required value='<?= isset($_COOKIE['firstname']) ? htmlspecialchars($_COOKIE['firstname']) : '' ?>'>
            </div>
          </div>
        </div>
        <!-- email -->
        <div class="col mt-3">
          <p class="mb-1 ld_itema">Adresse email</p>
          <div class="login-input">
            <img class="ms-1 me-1 pb-1" src="../img/mail-login.png">
            <input class="col-8 mt-1 mb-1 ms-2 ld_itema" style="background-color:inherit" type='email' name='email' placeholder="exemple@xyz.ab" required value='<?= isset($_COOKIE['email']) ? htmlspecialchars($_COOKIE['email']) : '' ?>'>
          </div>
        </div>
        <!-- pwd -->
        <div class="col mt-3">
          <p class="mb-0 ld_itema">Mot de passe</p>
          <div class="login-input">
            <img class="ms-1 me-1 pb-2" src="../img/pwd-login.png">
            <input class="col-10 mt-1 ms-2 ld_itema" style="background-color:inherit" type='password' name='password' placeholder='Mot de passe' required>
          </div>
          <p style="color:grey; font-size:0.7em;padding:0;margin:0;">(Minimum 8 caractères avec au moins 1 majuscule, 1 minuscule et 1 chiffre)</p>

        </div>
        <!-- confirm pwd -->
        <div class="col mt-3">
          <p class="mb-1 ld_itema">Confirmation mot de passe</p>
          <div class="login-input">
            <img class="ms-1 me-1 pb-2" src="../img/pwd-login.png">
            <input class="col-8 mt-1 ms-2 ld_itema" style="background-color:inherit" type='password' name='confirm-password' placeholder='Répétez mot de passe' required>
          </div>
        </div>
        <?php include("/var/www/flutters.ovh/pages/login/captcha/captcha.php") ?>
        <!-- submit -->
        <div class="col login-submit">
          <input class="w-100 mt-1" type='submit' value="INSCRIPTION">
        </div>
        <!-- to-connect -->
        <div class="w-75">
          <p class="align-self-start ld_itema " id="login_title_bottom" style="font-size:14px; font-weight:600; margin-top:2em;"> Déjà un compte ? <a id="to-sign" href="../sign_in/sign_in.php">Se connecter</a> </p>
        </div>
        <!-- Captcha validation input -->
        <input style="display:none;" id="captcha_form_input" value="0" name="captcha_check">
      </form>
    </div>
  </div>

  <!-- Import Bootstrap JS Library -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/gsap.min.js"></script>
  <!-- Captcha JS Script -->
  <script src="../captcha/captcha.js"></script>
  <script src="https://flutters.ovh/ld_mode/main.js"></script>
</body>

</html>