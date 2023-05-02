<?php 
session_set_cookie_params(3600);
session_start();

    // $_SESSION['email']='huangfrederic2002@gmail.com';
    // $_SESSION['email']='franck.zhuang@htm.fr';
    // $_SESSION['user_type']='Normal';

    // Connect to the db
    include("../connect_db.php");

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
                            <button onclick="download_user_pdf()" id="redeem_data" type='submit' value="Exporter les informations utilisateurs">Exporter les informations utilisateurs</button>

                        </div>
                        <!-- profile right side infos -->
                        <div class="col-6 d-flex flex-column align-items-center align-self-center justify-content-center">
                            <!-- profile_avatar -->
                            <?php 
                            $q = "SELECT src, name FROM COMPONENT c
                                INNER JOIN WEARS w on c.id_component = w.id_component
                                INNER JOIN USERS U on w.id_client = U.id_client
                                WHERE U.id_client = $user_id";
                            $req = $bdd->query($q);
                            $results = $req->fetchAll(PDO::FETCH_ASSOC); ?>
                            
                            <div>
                                <div id="avatar-parent">
                                    <img class="profile_avatar"src="<?php echo $avatar?>">
                                    <?php if($results) : 
                                        foreach($results as $component) : ?>
                                            <img class="profile_avatar"src="<?php echo $component['src']?>" alt="">
                                        <?php endforeach;
                                    endif; ?>
                                </div>
                            </div>
                            
                            
                            
            

                            <!-- Button trigger modal -->
                            <button class="mb-4" type="button" id="image_btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Modifier la photo
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                 <form action="avatar_update" method="POST">
                                    <div class="modal-content" style="background-color:white;">
                                        <div class="modal-header" style="border:none;">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-weight:600;">Modification de votre photo de profil</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                       
                                        <div class="modal-body" style="border:none">
                                       
                                            <div class="d-flex flex-column">
                                                <?php 
                                                $q = "SELECT COUNT(name), name FROM COMPONENT c
                                                INNER JOIN WEARS w on c.id_component = w.id_component
                                                INNER JOIN USERS U on w.id_client = U.id_client
                                                WHERE U.id_client = $user_id
                                                AND type = 'head'";
                                                $req = $bdd->query($q);
                                                $head_result = $req->fetch(PDO::FETCH_ASSOC); 
                                                $head_name = $head_result['name'];
                                                
                                                $q = "SELECT name FROM COMPONENT WHERE type ='head' AND NOT name = '$head_name'";
                                                $req = $bdd->query($q);
                                                $all_head = $req->fetchAll(PDO::FETCH_ASSOC); ?>
                                                

                                                <label class="form-label" for="head_select">Chapeau</label>
                                                <select id="head_select" class="form-select mb-2" name="head">
                                                    <option value="<?php echo ($head_result['COUNT(name)']) ? $head_result['name'] : "none"?>"><?php echo ($head_result['COUNT(name)']) ? $head_result['name'] : "Aucun"?></option>
                                                    <?php echo ($head_result['COUNT(name)']) ? '<option value="none">Aucun</option>' : '' ;
                                                    foreach ($all_head as $head) : ?>
                                                        <option value="<?php echo $head['name']?>"><?php echo $head['name']?></option>
                                                    <?php endforeach; ?>
                                                    
                                                </select>

                                                <?php 
                                                $q = "SELECT COUNT(name), name FROM COMPONENT c
                                                INNER JOIN WEARS w on c.id_component = w.id_component
                                                INNER JOIN USERS U on w.id_client = U.id_client
                                                WHERE U.id_client = $user_id
                                                AND type = 'eyes'";
                                                $req = $bdd->query($q);
                                                $eyes_result = $req->fetch(PDO::FETCH_ASSOC); 
                                                $eyes_name = $eyes_result['name'];
                                                
                                                $q = "SELECT name FROM COMPONENT WHERE type ='eyes' AND NOT name = '$eyes_name'";
                                                $req = $bdd->query($q);
                                                $all_eyes = $req->fetchAll(PDO::FETCH_ASSOC); ?>

                                                <label class="form-label" for="eyes_select">Yeux</label>
                                                <select id="eyes_select" class="form-select mb-2" name="eyes">
                                                    <option value="<?php echo ($eyes_result['COUNT(name)']) ? $eyes_result['name'] : "none"?>"><?php echo ($eyes_result['COUNT(name)']) ? $eyes_result['name'] : "Aucun"?></option>
                                                    <?php echo ($eyes_result['COUNT(name)']) ? '<option value="none">Aucun</option>' : '' ;
                                                    foreach ($all_eyes as $eyes) : ?>
                                                        <option value="<?php echo $eyes['name']?>"><?php echo $eyes['name']?></option>
                                                    <?php endforeach; ?>
                                                </select>

                                                <?php 
                                                $q = "SELECT COUNT(name), name FROM COMPONENT c
                                                INNER JOIN WEARS w on c.id_component = w.id_component
                                                INNER JOIN USERS U on w.id_client = U.id_client
                                                WHERE U.id_client = $user_id
                                                AND type = 'mouth'";
                                                $req = $bdd->query($q);
                                                $mouth_result = $req->fetch(PDO::FETCH_ASSOC); 
                                                $mouth_name = $mouth_result['name'];
                                                
                                                $q = "SELECT name FROM COMPONENT WHERE type ='mouth' AND NOT name = '$mouth_name'";
                                                $req = $bdd->query($q);
                                                $all_mouth = $req->fetchAll(PDO::FETCH_ASSOC); ?>

                                                <label class="form-label" for="mouth_select">Bouche</label>
                                                <select id="mouth_select" class="form-select mb-2" name="mouth">
                                                    <option value="<?php echo ($mouth_result['COUNT(name)']) ? $mouth_result['name'] : "none"?>"><?php echo ($mouth_result['COUNT(name)']) ? $mouth_result['name'] : "Aucun"?></option>
                                                    <?php echo ($mouth_result['COUNT(name)']) ? '<option value="none">Aucun</option>' : '' ;
                                                    foreach ($all_mouth as $mouth) : ?>
                                                        <option value="<?php echo $mouth['name']?>"><?php echo $mouth['name']?></option>
                                                    <?php endforeach; ?>
                                                </select>

                                                <?php 
                                                $q = "SELECT COUNT(name), name FROM COMPONENT c
                                                INNER JOIN WEARS w on c.id_component = w.id_component
                                                INNER JOIN USERS U on w.id_client = U.id_client
                                                WHERE U.id_client = $user_id
                                                AND type = 'outfit'";
                                                $req = $bdd->query($q);
                                                $outfit_result = $req->fetch(PDO::FETCH_ASSOC); 
                                                $outfit_name = $outfit_result['name'];
                                                
                                                $q = "SELECT name FROM COMPONENT WHERE type ='outfit' AND NOT name = '$outfit_name'";
                                                $req = $bdd->query($q);
                                                $all_outfit = $req->fetchAll(PDO::FETCH_ASSOC); ?>

                                                <label class="form-label" for="outfit_select">Costume</label>
                                                <select id="outfit_select" class="form-select mb-2" name="outfit">
                                                    <option value="<?php echo ($outfit_result['COUNT(name)']) ? $outfit_result['name'] : "none"?>"><?php echo ($outfit_result['COUNT(name)']) ? $outfit_result['name'] : "Aucun"?></option>
                                                    <?php echo ($outfit_result['COUNT(name)']) ? '<option value="none">Aucun</option>' : '' ;
                                                    foreach ($all_outfit as $outfit) : ?>
                                                        <option value="<?php echo $outfit['name']?>"><?php echo $outfit['name']?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>          
                                        
                                        </div>
                                        <div class="modal-footer" style="border:none">
                                            <input type="hidden" name="id" value="<?php echo $user_id?>">
                                            <button id="profile_avatar_delete_modal" data-bs-dismiss="modal" type="submit">Modifier</button>
                                            <button type="button" id="profile_avatar_delete_modal" data-bs-dismiss="modal">Annuler</button>
                                        </div>
                                    </form> 
                                    </div>
                                </div>
                            </div>

                            <!-- informations about avatar changement -->
                            <p id="avatar_info">Personnalisez votre avatar pour qu'il soit à votre goût !</p>
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