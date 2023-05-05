<?php 
    // if (!isset($_COOKIE['ld_mode'])) {
    //     setcookie("ld_mode", 0, time()+3600);
    //     echo 'aAAA';
    // }
    ?>

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

