<?php 
session_start();
$_SESSION = [];
session_destroy();
header('location: https://flutters.ovh');
exit()
?>