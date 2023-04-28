<?php

session_start();

    // logs
    // type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated  | $page = actual url
    $log_type = 8; $log_page = 'https://flutters.ovh/deconnexion';
    include($_SERVER['DOCUMENT_ROOT']."/log.php");

session_destroy();


if (isset($_GET['message'])) {
    header('location:/pages/login/sign_in/sign_in.php?message=' . $_GET['message']);
} else {
    header('location:/');
}
