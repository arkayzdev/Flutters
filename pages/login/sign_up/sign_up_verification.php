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

// Check if the captcha has been complete
if ($_POST['captcha_check'] != 1) {
    $msg = 'Le captcha n a pas été complété';
    header('location:sign_up.php?message=' . $msg);
    exit;
}

// Valide email
if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
    $msg = 'Attention ! Adresse email non valide !';
    header('location:sign_up.php?message=' . $msg);
    exit;
}

// Password requirement met
if (strlen($_POST['password']) < 6 || strlen($_POST['password']) > 12) {
    $msg = 'Attention ! Mot de passe invalide. Le mot de passe doit être compris entre 6 et 12 caractères !';
    header('location:sign_up.php?message=' . $msg);
    exit;
}

// pwd and confirmation pwd match
if ($_POST['password'] !== $_POST['confirm-password']) {
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
    $msg = 'Email déjà utilisé';
    header('location:sign_up.php?message=' . $msg);
    exit;
}

// -> All conditions are validated

// Add new user in the db
$q = 'INSERT INTO USERS (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)';
$req = $bdd->prepare($q); // Return a pdo declaration (statement)
$reponse = $req->execute([
    'first_name' => $_POST['firstname'],
    'last_name' => $_POST['lastname'],
    'email' => $_POST['email'],
    'password' => hash('sha512', $_POST['password'])
]); // Request setled up.

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
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'flutters.noreply@gmail.com';
$mail->Password = 'kvslcvqrtitiflsl';
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

// Redirection
$msg = "Votre compte a été crée ! Vérifiez vos mail pour valider l'inscription !";
header('location:../sign_in/sign_in.php?message=' . $msg . '&green_alert=1');
exit;
?>
