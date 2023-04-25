<?php
echo $_POST['hash'];
$a = $_POST['hash'];

// Password requirement met
if (strlen($_POST['password']) < 6 || strlen($_POST['password']) > 12) {
    $msg = 'Attention ! Mot de passe invalide. Le mot de passe doit être compris entre 6 et 12 caractères !';
    header('location:forgot_pwd_redirection.php?message=' . $msg . '&email=' . $_POST['email'] . '&hash=' . $_POST['hash']);
    exit;
}

// pwd and confirmation pwd match
if ($_POST['password'] !== $_POST['confirm-password']) {
    $msg = 'Attention ! Les deux mots de passe ne sont pas identiques !';
    header('location:forgot_pwd_redirection.php?message=' . $msg . '&email=' . $_POST['email'] . '&hash=' . $_POST['hash']);
    exit;
}

// Verify if get email and hashed pwd exist -> link to data base
if (isset($_POST['email'])) {
    include("/var/www/flutters.ovh/pages/connect_db.php");
} else {
    $msg = 'Email non attribué -> ERROR: $_get is null';
    header('location:email_redirection.php?message=' . $msg);
    exit;
}

// We have a match, activate the account 
$q = 'UPDATE USERS SET password = :password WHERE email = :email';
$req = $bdd->prepare($q); // Renvoie une déclaration pdo (statement)
$reponse = $req->execute([
    'password' => hash('sha512', $_POST['password']),
    'email' => htmlspecialchars($_POST['email']),
]);


// logs
// type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated  | $page = actual url
$log_type = 5; $log_page = 'https://flutters.ovh/pages/forgot_pwd/forgot_pwd';
include($_SERVER['DOCUMENT_ROOT']."/log.php");

$msg = 'Le mot de passe a été modifié ! Vous pouvez à présent vous connecter';
header('location:../sign_in.php?message=' . $msg . '&green_alert=1');
exit;
