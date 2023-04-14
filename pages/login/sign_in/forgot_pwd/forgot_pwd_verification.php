<?php
// Import PHPMailer Datas
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Connect to db
include("../../../connect_db.php");

// Set Cookies
if (isset($_POST['email']) && !empty($_POST['email'])) {
    setcookie('email', $_POST['email'], time() + 24 * 3600);
}

// requirements
// Valide email
if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
    $msg = 'Attention ! Adresse email non valide !';
    header('location:forgot_pwd.php?message=' . $msg);
    exit;
}

// Verify if email exist in the db
$query = $bdd->prepare('SELECT COUNT(email) FROM USERS WHERE email = :email');
$query->execute([
    'email' => htmlspecialchars($_POST['email']),
]);
$result_email = $query->fetch(PDO::FETCH_COLUMN);

if ($result_email == 0) {
    $msg = 'Email non existant dans notre base';
    header('location:forgot_pwd.php?message=' . $msg);
    exit;
}

// -> All conditions are validated

// get the hashed password from db and hash again to create securised link
$query = $bdd->prepare('SELECT password FROM USERS WHERE email = :email');
$query->execute([
    'email' => htmlspecialchars($_POST['email']),
]);
$result = $query->fetch(PDO::FETCH_COLUMN);

// MAIL 
$headers = 'From:noreply@flutters.com' . "\r\n"; // Header
$subject = 'Flutters | Reinitialisation du mot de passe'; // Subject
$message = ' 

    Une procédure de réinitialisation du mot de passe a été engagée sur votre email <br> 

    Pour accéder au lien de réinitialisation de mot de passe, veuillez cliquer sur le lien ci-dessous: <br> 
    https://flutters.ovh/pages/login/sign_in/forgot_pwd/forgot_pwd_redirection.php?email=' . $_POST['email'] . '&hash=' . hash('sha512', $result) . ' 

    '; // Mail content

// PHP Mailer
$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'noreply.flutters@gmail.com';
$mail->Password = 'yzxuigjxhslrhlqt';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('noreply.flutters@gmail.com');

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

// Redirection
$msg = "Le mail de réinitialisation a été envoyé ! Vérifiez vos mail !";
header('location:forgot_pwd.php?message=' . $msg . '&green_alert=1');
exit;
