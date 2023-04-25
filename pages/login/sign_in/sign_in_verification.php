<?php
// Connect to db
include("../../connect_db.php");

// Set Cookies
if (isset($_POST['email']) && !empty($_POST['email'])) {
    setcookie('email', $_POST['email'], time() + 24 * 3600);
}

// Account creation requirement

// Valide email
if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {

    // logs
    // type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated  | $page = actual url
    $log_type = 2; $log_page = 'https://flutters.ovh/pages/login/sign_in/sign_in';
    include($_SERVER['DOCUMENT_ROOT']."/log.php");
    
    $msg = 'Attention ! Adresse email non valide !';
    header('location:sign_in.php?message=' . $msg);
    exit;
}

// Verify if email exist in the db
$query = $bdd->prepare('SELECT COUNT(email) FROM USERS WHERE email = :email');
$query->execute([
    'email' => htmlspecialchars($_POST['email']),
]);
$result_email = $query->fetch(PDO::FETCH_COLUMN);

if ($result_email == 0) {

    // logs
    // type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated  | $page = actual url
    $log_type = 2; $log_page = 'https://flutters.ovh/pages/login/sign_in/sign_in';
    include($_SERVER['DOCUMENT_ROOT']."/log.php");

    $msg = 'Email non existant';
    header('location:sign_in.php?message=' . $msg);
    exit;
}

// Verify if password match with the db one
$query = $bdd->prepare('SELECT password FROM USERS WHERE email= :email');
$query->execute([
    'email' => htmlspecialchars($_POST['email']),
]);
$result_password = $query->fetch(PDO::FETCH_COLUMN);

if ($result_password != hash('sha512', $_POST['password'])) {

    // logs
    // type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated  | $page = actual url
    $log_type = 2; $log_page = 'https://flutters.ovh/pages/login/sign_in/sign_in';
    include($_SERVER['DOCUMENT_ROOT']."/log.php");

    $msg = 'Mot de passe incorrect';
    header('location:sign_in.php?message=' . $msg);
    exit;
}

// Verify if the mail verification has been activated
$query = $bdd->prepare('SELECT email_verification FROM USERS WHERE email = :email');
$query->execute([
    'email' => htmlspecialchars($_POST['email']),
]);
$result_email_verification = $query->fetch(PDO::FETCH_COLUMN);

if ($result_email_verification == 0) {

    // logs
    // type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated  | $page = actual url
    $log_type = 2; $log_page = 'https://flutters.ovh/pages/login/sign_in/sign_in';
    include($_SERVER['DOCUMENT_ROOT']."/log.php");

    $msg = 'Ce compte est désactivé, pour l\'activer, validez le mail de confirmation. ';
    header('location:sign_in.php?message=' . $msg);
    exit;
}

// start session
session_start();

// Session for email
$_SESSION['email'] = $_POST['email'];

// Session for lastname
$query = $bdd->prepare('SELECT last_name FROM USERS WHERE email= :email');
$query->execute([
    'email' => htmlspecialchars($_POST['email']),
]);
$result_lastname = $query->fetch(PDO::FETCH_COLUMN);
$_SESSION['lastname'] = $result_lastname;

// Session for lastname
$query = $bdd->prepare('SELECT first_name FROM USERS WHERE email= :email');
$query->execute([
    'email' => htmlspecialchars($_POST['email']),
]);
$result_firstname = $query->fetch(PDO::FETCH_COLUMN);
$_SESSION['firstname'] = $result_firstname;

// Session for lastname
$query = $bdd->prepare('SELECT user_type FROM USERS WHERE email= :email');
$query->execute([
    'email' => htmlspecialchars($_POST['email']),
]);
$result_user_type = $query->fetch(PDO::FETCH_COLUMN);
$_SESSION['user_type'] = $result_user_type;

// Unset Cookies
setcookie('email', $_POST['email'], time() - 24 * 3600);

// logs
// type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated  | $page = actual url
$log_type = 1; $log_page = 'https://flutters.ovh/pages/login/sign_in/sign_in';
include($_SERVER['DOCUMENT_ROOT']."/log.php");

// Redirection
header('location:/');
exit;
