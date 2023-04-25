<?php 
session_set_cookie_params(3600);
session_start();

    // $_SESSION['email']='huangfrederic2002@gmail.com';
    // $_SESSION['email']='franck.zhuang@htm.fr';
    // $_SESSION['user_type']='Normal';

    // Connect to the db
    include("../connect_db.php");

        // logs
    // type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated  | $page = actual url
    $log_type = 3; $log_page = 'https://flutters.ovh/pages/profile/profile';
    include($_SERVER['DOCUMENT_ROOT']."/log.php");

    // Verify if session is on
    if(!isset($_SESSION['email'])){
        $msg = 'ERROR: PROFILE_SESSION_NOT_LOADED';
        header('location:../login/sign_in/sign_in.php?message=' . $msg);
        exit;
    }
 
    // Get every informations of the user
    $q = 'SELECT * FROM USERS WHERE email = :email';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
      'email' => htmlspecialchars($_SESSION['email']),
    ]);
    $result= $req -> fetch();

    $email = $result['email'];
    $firstname = $result['first_name'];
    $lastname = $result['last_name'];
    $user_id = $result['id_client'];

    if($result['avatar']=='' || !isset($result['avatar'])){
        $avatar = 'default_avatar.png';
    } else {
        $avatar = $result['avatar'];

    }

    $query = $bdd->prepare('SELECT COUNT(email) FROM NEWSLETTER WHERE email = :email');
    $query->execute([
        'email' => htmlspecialchars($_SESSION['email']),
    ]);
    $result = $query->fetch(PDO::FETCH_COLUMN);

    if ($result >= 1) {
        $newsletter = 1;
    } else {
        $newsletter = 0;
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
  <title>Profile</title>

  <!-- Import Bootstrap CSS Library -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <!-- Import css -->
  <link href="profile.css?rs=<?= time() ?>" rel="stylesheet">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>

<body>
    <!-- Include Header -->
    <?php include("/var/www/flutters.ovh/pages/nav/nav.php"); ?>

    <!-- Button trigger message modal -->
    <button type="button" style="display:none" id="btn_message_modal" data-bs-toggle="modal" data-bs-target="#message_modal">
    Supprimer la photo
    </button>

    <!-- activate the message -->
    <?php 
    if(!empty($_GET['message'])){ 
        echo '
        <script>
        window.onload = function(){document.getElementById("btn_message_modal").click();};
        </script>';
     } ;
     ?>


    <!-- message modal -->
    <div class="modal fade" id="message_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color:white;">
                <div class="modal-header" style="border:none;">
                    <h1 class="modal-title fs-5 mt-4" id="exampleModalLabel" style="font-weight:700;">Notification Flutters</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0 pb-0" style="border:none">
                    <?php echo '<p class="mb-0" style="font-weight:600;">' . $_GET['message'] .'</p>';?>
                </div>
                <div class="modal-footer" style="border:none">
                    <button id="profile_avatar_delete_modal" type="button" data-bs-dismiss="modal">D'accord</button>
                </div>
            </div>
        </div>
    </div>

    <!-- main content -->
    <main class="d-flex flex-column pb-5">
        <!-- profile_up_side nav -->
        <div class="d-block d-lg-none" id="profile_up_side">
            <nav>
                <ul class="d-flex p-0">
                    <li class="col-6 text-center"><a href="profile.php">Mes informations</a></li>
                    <li class="col-6 text-center"><a href="mes_reservations.php">Mes réservations</a></li>
                </ul>
            </nav>
        </div>
        <!-- the rest -->
        <div class="d-flex">

            <!-- fill -->
            <div class="d-none d-xl-block col-xl-1"></div>

            <!-- profile_left_side nav -->
            <div class="d-none d-lg-block col-4 col-xl-3" id="profile_left_side">
                <nav style="list-style:none;">
                    <ul class="d-none d-lg-flex">
                        <li><a href="#mes_informations">Mes informations</a></li>
                        <li><a href="#mon_mot_de_passe">Mon mot de passe</a></li>
                        <li><a href="#ma_newsletter">Ma newsletter</a></li>
                        <li><a href="mes_reservations.php">Mes réservations</a></li>
                    </ul>
                </nav>
            </div>

            <!-- profile_right_side informations -->
            <div class="col-12 col-lg-8 col-xl-7 d-flex flex-column">

                <!----- Mes informations ----->
                <div class="profile_right_side_div">
                    <!-- title -->
                    <h3 id="h3" id="mes_informations">Mes informations</h3>
                    <!-- profile -->
                    <div class="d-flex flex-column-reverse flex-lg-row">
                        <!-- profile left side infos -->
                        <div class="col-6" id="mes_infos_left">
                            <!-- profile_my_info -->
                            <form action="profile_name_update.php" method="POST">
                                <!-- firstname -->
                                <div class="changeable">
                                    <label>Prénom</label>
                                    <?php
                                    echo '<input type="text" name="firstname" placeholder="Remplir ce champs" required value="' . $firstname . '">';
                                    ?>
                                </div>
                                <!-- lastname -->
                                <div class="changeable">
                                    <label>Nom</label>
                                    <?php
                                    echo '<input type="text" name="lastname" placeholder="Remplir ce champs" required value="' . $lastname . '">';
                                    ?>                                </div>
                                <!-- email -->
                                <div class="changeable">
                                    <label>Email</label>
                                    <?php
                                    echo '<p>' . $email . '</p>'
                                    ?>
                                </div>

                                <!-- update_button -->
                                <div class="update_btn">
                                    <input type='submit' value="Mettre à jour">
                                </div>
                            </form>

                            <!-- PDF --> 
                            <form action="profile_pdf.php" method="POST">
                                <!-- actual pwd -->
                                <?php 
                                echo '<input type=\'text\' name=\'user_id\' value="' . $user_id . '" class="d-none">';
                                echo '<input type=\'text\' name=\'first_name\' value="' . $firstname . '" class="d-none">';
                                echo '<input type=\'text\' name=\'last_name\' value="' . $lastname . '" class="d-none">';
                                echo '<input type=\'text\' name=\'email\' value="' . $email . '" class="d-none">';
                                echo '<input type=\'text\' name=\'avatar\' value="' . $avatar . '" class="d-none">';
                                echo '<input type=\'text\' name=\'newsletter\' value="' . $newsletter . '" class="d-none">';
                                ?>
                                <!-- lastname -->
                                <!-- update_button -->
                                <button id="redeem_data" type='submit' value="Exporter les informations utilisateurs">Exporter les informations utilisateurs</button>
                            </form>
                        </div>
                        <!-- profile right side infos -->
                        <div class="col-6 d-flex flex-column align-items-center align-self-center justify-content-center">
                            <!-- profile_avatar -->
                            <?php
                             echo '<img id="profile_avatar" src="users_avatars/' . $avatar . '">';
                            ?>

                            <!-- change avatar pic -->
                            <label for="image" id="image_btn">Modifier ma photo</label>
                            <form method="POST" id="avatar_submit_btn" action="avatar_verification.php" enctype="multipart/form-data">
                                <input type="file" id="image" style="display:none" name="image" accept="image/jpg, image/png, image/gif" onChange='change_avatar()'></input>
                            </form>

                            <!-- Button trigger modal -->
                            <button type="button" id="avatar_btn_delete" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Supprimer la photo
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content" style="background-color:white;">
                                        <div class="modal-header" style="border:none;">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-weight:600;">Suppression de votre photo de profil</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="border:none">
                                            <p style="font-weight:400;">Etes-vous sûr(e) de vouloir supprimer votre photo de profil ?</p>
                                        </div>
                                        <div class="modal-footer" style="border:none">
                                            <button id="profile_avatar_delete_modal" type="button" data-bs-dismiss="modal" onclick="delete_avatar()">Oui</button>
                                            <button type="button" id="profile_avatar_delete_modal" data-bs-dismiss="modal">Non, annuler</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- informations about avatar changement -->
                            <p id="avatar_info">Seuls les photos au format jpg, jpeg et png faisant moins de 10Mo sont acceptés</p>
                        </div>
                    </div>
                </div>

                <!-- Mon mot de passe -->
                <div id="mon_mot_de_passe" class="profile_right_side_div">
                    <!-- title -->
                    <h3>Mon mot de passe</h3>
                    <!-- profile pwd change -->
                    <div>
                        <!-- profile_password -->
                        <form action="profile_pwd_update.php" method="POST">
                            <!-- actual pwd -->
                            <div class="changeable">
                                <label>Mot de passe actuel</label>
                                <input type='password' name='actual_password' placeholder="Mot de passe actuel">
                            </div>
                            <!-- lastname -->
                            <div class="changeable">
                                <label>Nouveau mot de passe</label>
                                <input type='password' name='new_password' placeholder="Nouveau mot de passe">
                            </div>
                            <!-- update_button -->
                            <div class="update_btn">
                                <input type='submit' value="Mettre à jour">
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="profile_right_side_div">
                    <!-- title -->
                    <h3 id="ma_newsletter">Newsletter</h3>
                    <!-- profile newsletter -->
                    <div>
                        <!-- proile_form_newsletter -->
                        <form action="profile_newsletter_update.php" method="POST">
                            <!-- newsletter_checkbox -->
                            <div class="d-flex">
                                <label class="col-10">Recevoir toute l'actualité des films et évènements Flutters à venir</label>
                                <?php
                                if($newsletter == 0){
                                    echo '<input id="check_box" class="col-2" value="1" type=\'checkbox\' name=\'newsletter\'>';
                                } else {
                                    echo '<input id="check_box" class="col-2" value="1" type=\'checkbox\' name=\'newsletter\' checked>';
                                }
                                ?>
                            </div>
                            <!-- update_button -->
                            <div class="update_btn">
                                <input type='submit' value="Mettre à jour">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- fill -->
            <div class="d-none d-xl-block col-xl-1"></div>

        </div>
    </main>

      <!-- Footer -->
  <?php include '/var/www/flutters.ovh/pages/footer/footer.php' ?>

    <!-- Import Bootstrap JS Library -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/gsap.min.js"></script>
    <script src="profile.js"></script>
</body>

</html>