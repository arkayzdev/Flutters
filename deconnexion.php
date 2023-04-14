<?php

session_start();

session_destroy();

if (isset($_GET['message'])) {
    header('location:/pages/login/sign_in/sign_in.php?message=' . $_GET['message']);
} else {
    header('location:/');
}
