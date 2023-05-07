<!DOCTYPE html>
<html lang="en">

<?php     

    // logs
    // type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated  | $page = actual url
    $log_type = 3; $log_page = 'https://flutters.ovh/pages/forgot_pwd/forgot_pwd';
    include($_SERVER['DOCUMENT_ROOT']."/log.php");
    ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MotdePasseOublié</title>

    <!-- Import Bootstrap CSS Library -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <!-- Login CSS file -->
    <link rel="stylesheet" href="../../login.css?rs=<?= time() ?>">
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
        <div style="background-color:white;" class="col col-lg-6 col-xl-5 d-flex flex-column align-items-center ld_item" style=" height:35vh background-color:white">
            <!-- form title -->
            <div class="ld_itema" style="text-align:center;margin-top: 20vh;">
                <h2 style="font-size:2.5em; font-weight:700;"> Reinitialisation du mot de passe </h2>
                <p style="color:grey;width:80%;margin-left:auto;margin-right:auto;">Veuillez entrer votre email, nous vous enverrons un lien pour réinitialiser votre mot de passe</p>
            </div>

            <!-- Notification -->
            <?php
            if (!empty($_GET['message']) && !empty($_GET['green_alert'])) {
                echo '<p class="mb-3 confirmation-message">' . htmlspecialchars($_GET['message']) . '</p>';
            } elseif (!empty($_GET['message'])) {
                echo '<p class="mb-3 verification-message">' . htmlspecialchars($_GET['message']) . '</p>';
            }
            ?>

            <div style="text-align:center" class="d-flex flex-column align-items-center mt-0">
                <form class="" action="forgot_pwd_verification.php" method="POST">
                    <div class="login-input">
                        <input type='email' class="ld_itema"  style="background-color:inherit;" name='email' placeholder='votremail@exemple.xyz' required>
                    </div>
                    <div class="login-submit mt-4">
                        <input class="mt-0 ld_itema" style="background-color:inherit;" type='submit' value="Récupération">
                    </div>
                </form>
                <p style="text-align:center; margin-top:2vh" class="ld_itema">Aller à la page de <a id="to-sign" href="../sign_in.php">connexion</a></p>
            </div>
        </div>

    </div>


    <!-- Import Bootstrap JS Library -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/gsap.min.js"></script>
    <script src="https://flutters.ovh/ld_mode/main.js"></script>
</body>

</html>