<?php
// Verify if get email and hashed pwd exist -> link to data base
if (isset($_GET['email']) && isset($_GET['hash'])) {
  include("/var/www/flutters.ovh/pages/connect_db.php");
} else {
  $msg = 'Erreur, cette page n est pas attribuée';
  header('location:email_redirection.php?message=' . $msg);
  exit;
}

// check if the acc has been already activated or not
$query = $bdd->prepare('SELECT email_verification FROM USERS WHERE email = :email');
$query->execute([
  'email' => htmlspecialchars($_GET['email']),
]);
$email_ver = $query->fetch(PDO::FETCH_COLUMN);

if ($email_ver == 1) {
  $msg = 'Votre compte a déjà été activé';
  header('location:email_redirection.php?message=' . $msg);
  exit;
}

// get the hashed password from db
$query = $bdd->prepare('SELECT password FROM USERS WHERE email = :email');
$query->execute([
  'email' => htmlspecialchars($_GET['email']),
]);
$result = $query->fetch(PDO::FETCH_COLUMN);

// check get pwd and db pwd
if ($_GET['hash'] == $result) {
  // We have a match, activate the account 
  $q = 'UPDATE USERS SET email_verification = :email_verification WHERE email = :email';
  $req = $bdd->prepare($q); // Renvoie une déclaration pdo (statement)
  $reponse = $req->execute([
    'email_verification' => 1,
    'email' => htmlspecialchars($_GET['email']),
  ]);

  $msg = 'Félicitation ! Votre compte a été activé !';
  header('location:email_redirection.php?message=' . $msg);
  exit;
} else {
  $msg = 'Erreur: hash do not match';
  header('location:email_redirection.php?message=' . $msg);
  exit;
}
