<?php
ob_start();
// Import PHPMailer Datas
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Connect to db
include("../../connect_db.php");

// Set Cookies
if (isset($_POST['email']) && !empty($_POST['email'])) {
    setcookie('email', $_POST['email'], time() + 24 * 3600);
}
if (isset($_POST['lastname']) && !empty($_POST['lastname'])) {
    setcookie('lastname', $_POST['lastname'], time() + 24 * 3600);
}
if (isset($_POST['firstname']) && !empty($_POST['firstname'])) {
    setcookie('firstname', $_POST['firstname'], time() + 24 * 3600);
}




// Account creation requirement

// Check REGEX
if (!preg_match("/^[a-zA-Zéèà]+$/", $_POST["firstname"]) && !preg_match("/^[a-zA-Zéèà-]+$/", $_POST["lastname"])){
    $msg = 'Les caractères spéciaux ne sont pas autorisés !';
    header('location:sign_up.php?message=' . $msg);
    exit;
}

// Check if the captcha has been complete
if ($_POST['captcha_check'] != 1) {

    // logs
    // type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated  | $page = actual url
    $log_type = 9; $log_page = 'https://flutters.ovh/pages/login/sign_up/sign_up';
    include($_SERVER['DOCUMENT_ROOT']."/log.php");

    $msg = 'Le captcha n a pas été complété';
    header('location:sign_up.php?message=' . $msg);
    exit;
}

// Valide email
if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {

    // logs
    // type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated  | $page = actual url
    $log_type = 9; $log_page = 'https://flutters.ovh/pages/login/sign_up/sign_up';
    include($_SERVER['DOCUMENT_ROOT']."/log.php");

    $msg = 'Attention ! Adresse email non valide !';
    header('location:sign_up.php?message=' . $msg);
    exit;
}

// Password requirement met
if (strlen($_POST["password"]) <= 8 || !preg_match("/[A-Z]/", $_POST["password"]) || !preg_match("/[a-z]/", $_POST["password"]) || !preg_match("/[0-9]/", $_POST["password"])) {

    // logs
    // type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated  | $page = actual url
    $log_type = 9; $log_page = 'https://flutters.ovh/pages/login/sign_up/sign_up';
    include($_SERVER['DOCUMENT_ROOT']."/log.php");

    $msg = 'Attention ! Mot de passe invalide. Le mot de passe doit être au minimum de 8 caractères et contenir au moins 1 majuscule, 1 minuscule et 1 chiffre !';
    header('location:sign_up.php?message=' . $msg);
    exit;
}

// pwd and confirmation pwd match
if ($_POST['password'] !== $_POST['confirm-password']) {

    // logs
    // type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated  | $page = actual url
    $log_type = 9; $log_page = 'https://flutters.ovh/pages/login/sign_up/sign_up';
    include($_SERVER['DOCUMENT_ROOT']."/log.php");

    $msg = 'Attention ! Les deux mots de passe ne sont pas identiques !';
    header('location:sign_up.php?message=' . $msg);
    exit;
}

// Verify if email exist in the db
$query = $bdd->prepare('SELECT COUNT(email) FROM USERS WHERE email = :email');
$query->execute([
    'email' => htmlspecialchars($_POST['email']),
]);
$result = $query->fetch(PDO::FETCH_COLUMN);

if ($result >= 1) {

    // logs
    // type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated  | $page = actual url
    $log_type = 9; $log_page = 'https://flutters.ovh/pages/login/sign_up/sign_up';
    include($_SERVER['DOCUMENT_ROOT']."/log.php");

    $msg = 'Email déjà utilisé';
    header('location:sign_up.php?message=' . $msg);
    exit;
}

// -> All conditions are validated

// Add new user in the db
$q = 'INSERT INTO USERS (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)';
$req = $bdd->prepare($q); 
$reponse = $req->execute([
    'first_name' => $_POST['firstname'],
    'last_name' => $_POST['lastname'],
    'email' => $_POST['email'],
    'password' => hash('sha512', $_POST['password'])
]); 

$password = hash('sha512', $_POST['password']);

// ERROR (No data)
if (!$reponse) {
    $msg = 'Erreur lors de l inscription en base de données.';
    header('location:sign_up.php?message=' . $msg);
    exit;
}

// MAIL 
$headers = 'From:flutters.noreply@gmail.com' . "\r\n"; // Header
$subject = 'Signup | Verification'; // Subject
$message = ' 

    Flutters vous remercie pour votre inscription ! <br> 
    Votre compte a été crée, pour activer votre compte, cliquez sur le lien ci-dessous. <br>


    ------------------------ <br>
    Utilisateur: ' . $_POST['lastname'] . ' ' . $_POST['firstname'] . ' <br>
    Email: ' . $_POST['email'] . ' <br>
    ------------------------ <br>


    Veuillez cliquer sur le lien pour activer votre compte: <br> 
    https://flutters.ovh/pages/login/email_verification/email_verification.php?email=' . $_POST['email'] . '&hash=' . hash('sha512', $_POST['password']) . ' 

    '; // Mail content

// PHP Mailer
$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->CharSet = "UTF-8";
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'flutters.noreply@gmail.com';
$mail->Password = 'jsclcfdogvsmscgt';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->SMTPDebug = true;

$mail->setFrom('flutters.noreply@gmail.com');

$mail->addAddress($_POST["email"]);

$mail->isHTML(true);

$mail->Subject = $subject;
$mail->Body = $message;
$mail->send();
// FIN MAIL

// Unset Cookies
if (isset($_POST['email']) && !empty($_POST['email'])) {
    setcookie('email', $_POST['email'], time() - 24 * 3600);
}
if (isset($_POST['lastname']) && !empty($_POST['lastname'])) {
    setcookie('lastname', $_POST['lastname'], time() - 24 * 3600);
}
if (isset($_POST['firstname']) && !empty($_POST['firstname'])) {
    setcookie('firstname', $_POST['firstname'], time() - 24 * 3600);
}

// logs
// type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated  | $page = actual url
$log_type = 10; $log_page = 'https://flutters.ovh/pages/login/sign_up/sign_up';
include($_SERVER['DOCUMENT_ROOT']."/log.php");

// Redirection
$msg = "Votre compte a été crée ! Vérifiez vos mail pour valider l'inscription !";
header('location:../sign_in/sign_in.php?message=' . $msg . '&green_alert=1');
exit;