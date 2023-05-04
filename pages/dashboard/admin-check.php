<?php
session_start();
$admin = (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Admin') ? true : false;


