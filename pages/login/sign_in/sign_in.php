<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>

  <!-- Import Bootstrap CSS Library -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <!-- Login CSS file -->
  <link rel="stylesheet" href="../login.css?rs=<?= time() ?>">
</head>

<body>
  <!-- Include Header -->
  <?php include("/var/www/flutters.ovh/pages/nav/login_nav.php"); ?>

  <!-- main -->
  <div class="d-flex w-100" id="page_background" style="height:100vh">

    <!-- background -->
    <div class="col col-lg-6 col-xl-7 d-none d-lg-inline img-fluid"></div>

    <!-- form -->
    <div class="col col-lg-6 col-xl-5 bg-white d-flex flex-column justify-content-center align-items-center">

      <!-- form title -->
      <div class="w-75" style="margin-bottom:2em">
        <h2 class="align-self-start" style="font-size:3em; font-weight:700;"> Connexion </h2>
      </div>

      <!-- Notifications -->
      <?php
      if (!empty($_GET['message']) && !empty($_GET['green_alert'])) {
        echo '<p class="confirmation-message">' . htmlspecialchars($_GET['message']) . '</p>';
      } elseif (!empty($_GET['message'])) {
        echo '<p class="verification-message">' . htmlspecialchars($_GET['message']) . '</p>';
      }
      ?>

      <!-- form inputs -->
      <form class="w-75 mt-3" action="sign_in_verification.php" method="POST">
        <!-- email -->
        <div class="col mt-3">
          <p class="mb-1">Adresse email</p>
          <div class="login-input">
            <img class="ms-1 me-1 pb-1" src="../img/mail-login.png">
            <input class="col-8 mt-1 mb-1 ms-2" type='email' name='email' placeholder="exemple@xyz.ab" required value='<?= isset($_COOKIE['email']) ? htmlspecialchars($_COOKIE['email']) : '' ?>'>
          </div>
        </div>
        <!-- pwd -->
        <div class="col mt-3">
          <p class="mb-1">Votre mot de passe</p>
          <div class="login-input">
            <img class="ms-1 me-1 pb-2" src="../img/pwd-login.png">
            <input class="col-10 mt-1 ms-2" type='password' name='password' placeholder='Mot de passe' required>
          </div>
        </div>
        <!-- pwd-forgot -->
        <div class="w-75 mt-3"><a class="align-self-start" style="font-size:14px; font-weight:600; margin-top:2em" id="pwd-forgot" href="forgot_pwd/forgot_pwd.php">Mot de passe oublié ?</a></div>
        <!-- include captcha -->
        <?php include("/var/www/flutters.ovh/pages/login/captcha/captcha.php") ?>
        <!-- submit -->
        <div class="col login-submit">
          <input class="w-100 mt-1" type='submit' value="CONNEXION">
        </div>
        <!-- to-sign-up -->
        <div class="w-75">
          <p class="align-self-start" style="font-size:14px; font-weight:600; margin-top:2em;"> Pas encore de compte ? <a id="to-sign" href="../sign_up/sign_up.php">Créer un compte</a> </p>
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
</body>

</html>