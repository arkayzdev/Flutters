<!-- Verification if email and hash password match -->
<?php
// Check if email and hash are set
$check = 0;

if (isset($_GET['email'])) {
    $check = $check + 1;
}

if (isset($_GET['hash'])) {
    $check = $check + 1;
}

if ($check == 2) {
    include("/var/www/flutters.ovh/pages/connect_db.php");
} else {
    $msg = 'Erreur, cette page né pas attribuée';
    header('location:forgot_pwd.php?message=' . $msg);
    exit;
}

// get the hashed password from db
$query = $bdd->prepare('SELECT password FROM USERS WHERE email = :email');
$query->execute([
    'email' => htmlspecialchars($_GET['email']),
]);
$result = $query->fetch(PDO::FETCH_COLUMN);

// check get pwd and db pwd match
if ($_GET['hash'] != hash('sha512', $result)) {
    $msg = 'Lien expiré -> ERROR: hash do not match' . $result . '<--Result--' . $_GET['hash'] . '<--hash--' . $_GET['email'];
    header('location:forgot_pwd.php?message=' . $msg);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

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
    <!-- Include Header -->
    <?php include("/var/www/flutters.ovh/pages/nav/login_nav.php"); ?>

    <!-- main -->
    <div class="d-flex w-100" id="page_background" style="height:100vh">
        <!-- background -->
        <div class="col col-lg-6 col-xl-7 d-none d-lg-inline img-fluid"></div>

        <!-- form -->
        <div class="col col-lg-6 col-xl-5 bg-white d-flex flex-column align-items-center" style=" height:35vh background-color:white">
            <!-- form title -->
            <div style="text-align:center; margin-top: 20vh">
                <h2 style="font-size:2.5em; font-weight:700;"> Reinitialisation du mot de passe </h2>
                <p style="color:grey;">Vous pouvez à présent définir votre nouveau mot de passe</p>
            </div>

            <!-- Notification -->
            <?php
            if (!empty($_GET['message'])) {
                echo '<p class="mb-3 verification-message">' . htmlspecialchars($_GET['message']) . '</p>';
            }
            ?>

            <div style="text-align:center" class="d-flex flex-column align-items-center mt-0">
                <form class="" action="forgot_pwd_modify.php" method="POST">
                    <!-- pwd -->
                    <div class="mt-4">
                        <p>Mot de passe (6-12 caractères)</p>
                        <div class="login-input">
                            <img src="../../img/pwd-login.png">
                            <input type='password' name='password' placeholder='Mot de passe' required>
                        </div>
                    </div>
                    <!-- confirm pwd -->
                    <div class="mt-3">
                        <p>Confirmation mot de passe</p>
                        <div class="login-input">
                            <img src="../../img/pwd-login.png">
                            <input type='password' name='confirm-password' placeholder='Répétez mot de passe' required>
                        </div>
                    </div>
                    <!-- Submit -->
                    <div class="login-submit mt-5">
                        <input class="mt-0" type='submit' value="Enregistrer">
                    </div>
                    <?php
                    echo '<input style="display:none" name="email" value=' . $_GET['email'] . '>';
                    echo '<input style="display:none" name="hash" value=' . $_GET['hash'] . '>';
                    ?>
                </form>
                <p style="text-align:center; margin-top:2vh">Aller à la page de <a id="to-sign" href="../sign_in.php">connexion</a></p>
            </div>
        </div>

        <!-- Import Bootstrap JS Library -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/gsap.min.js"></script>
</body>

</html>