<?php
$ban = (isset($_SESSION['status']) && $_SESSION['status'] == 'ban') ? true : false;
if($ban){ 
    header('location: https://flutters.ovh/pages/ban');
    exit;
} ?>



