<?php
include($_SERVER['DOCUMENT_ROOT'] . '/pages/connect_db.php');
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $q = "SELECT status FROM USERS WHERE email = '$email'";
    $req = $bdd->query($q);
    $result = $req->fetch(PDO::FETCH_ASSOC);
    if ($result['status'] == 'ban') {
        header('location: https://flutters.ovh/pages/ban');
        exit;
    } 
} ?>



