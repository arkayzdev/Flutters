<?php 
    // if (!isset($_COOKIE['ld_mode'])) {
    //     setcookie("ld_mode", 0, time()+3600);
    //     echo 'aAAA';
    // }

    if(!isset($_COOKIE['pop_up_cookie'])){
    ?>
    <script>
        window.addEventListener("DOMContentLoaded", (event) => {
            document.getElementById("COOKIE_POP_UP_BTN").click();
        });
    </script>
    <?php } ?>

    <!-- Button trigger modal -->
    <button type="button" id="COOKIE_POP_UP_BTN" class="d-none" data-bs-toggle="modal" data-bs-target="#COOKIE_POP_UP">
        Launch static backdrop modal
    </button>

    <!-- Modal -->
    <div class="modal fade" style="padding-right:0!important" id="COOKIE_POP_UP" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header ps-0 pe-2 ">
                <img class="nav_logo ms-2 d-block mt-0" style="width:8em;color:black" src="/img/homepage/Typo-Black.svg">
                <img class="nav_logo me-4 d-block mt-0" style="width:3em;color:black" src="/ld_mode/cookie.svg">
            </div>
            <div class="modal-body">
                <p style="padding:0; margin:0;font-weight:700; font-size:1.3em; color:#e32828;">Chez Flutters, on respecte votre vie privée !</p>
                <p style="font-size:0.9em" class="mt-3"> Notre site utilise des cookies pour les fonctionnalités suivante:</p>

                <table class="table table-hover table-responsive">
                    <thead>
                        <tr style="font-size:0.9em">
                            <th scope="col">Cookie</th>
                            <th scope="col">Necessité</th>
                            <th scope="col">Expiration</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider" style="font-size:0.9em">
                        <tr>
                            <td>Stockage des informations lors de l'inscription et connexion lors d'erreur d'enregistrement</td>
                            <td>Requis</td>
                            <td>24 Heures</td>
                        </tr>
                        <tr>
                            <td>Paramètrage du thème sombre et clair</td>
                            <td>Requis</td>
                            <td>Fermeture du navigateur</td>
                        </tr>
                        <tr>
                            <td>Pop up des Cookies</td>
                            <td>Requis</td>
                            <td>24 Heures</td>
                        </tr>
                    </tbody>
                </table>

                <p class="mt-4 ms-2" style="font-size:0.8em; color:darkslategrey;">Flutters utilise des cookies pour améliorer votre expérience sur notre site. Nous respectons votre vie privée et nous ne collectons aucune information à des fins commerciales ou statistiques. En continuant à utiliser notre site, vous acceptez notre politique de confidentialité et l'utilisation de cookies. Pour en savoir plus, veuillez consulter notre politique de confidentialité en cliquant sur le lien 
                <a style="color:red; text-decoration:underline" target="_blank" href="https://www.economie.gouv.fr/politique-confidentialite">ci-joint</a>. </p>
            </p>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="accepted_popup()" class="btn btn-danger" data-bs-dismiss="modal">Accepter et Fermer</button>
            </div>
            </div>
        </div>
    </div>

    <!-- CSS -->
    <link href="/ld_mode/style.css?rs=<?= time()?>" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- HTML BUTTON -->  
  <?php if(isset($_COOKIE['ld_mode']) && $_COOKIE['ld_mode']==0){ echo '
    <button style="background-color: rgb(227, 41, 40); color: white;" onclick="ld_switch()" id="ld_button" value="'. $_COOKIE['ld_mode'] . '">
    <i class="uil uil-sun"></i>';
    }elseif(isset($_COOKIE['ld_mode']) && $_COOKIE['ld_mode']==1){
        echo '
    <button style="background-color: rgba(45, 45, 45, 1); color: white; transition:0.3s" onclick="ld_switch()" id="ld_button" value="'. $_COOKIE['ld_mode'] . '">
    <i class="uil uil-moon"></i>';
    } else {
        echo '
        <button style="background-color: rgb(227, 41, 40); color: white; transition:0.3s" onclick="ld_switch()" id="ld_button" value="0">
        <i class="uil uil-sun"></i>';
    }?>
    </button>


    <!-- JS SCRIPT
    <script src="https://flutters.ovh/ld_mode/main.js"></script> -->


    <?php
    // bouton sur le côté en sticky pour le day n light 
    // Par défaut en light
    // doit être chargeable en direct
    // Doit appliquer le status sur les autres pages

    // Utiliser la Variable globale $_SESSION['light'];
    // Utiliser une function pour appliquer sur la page actuelle et changer la variable session
    // Vérifier à l'arrivée sur la page quelle valeur a $_SESSION['light'] et changer les couleurs (LES DEUX);

