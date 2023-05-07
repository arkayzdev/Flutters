<?php
// Import PHPMailer Datas
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
// MAIL 
$headers = 'From:flutters.noreply@gmail.com' . "\r\n"; // Header
$subject = 'Flutters: Commande confirmée'; // Subject
$message = ' 

    Flutters vous remercie pour votre commande ! <br> 
    Vous trouverez dans ce mail votre billet. <br>

    ------------------------ <br>
    Numéro de commande: ' . str_replace('cs_test_', '',$id) . '<br>
    Email de Facturation: ' . $user_email . ' <br>
    Total: ' . number_format($price/100,2) . '€ <br>
    ------------------------ <br>

    Lien de téléchargement vers le pdf : https://Flutters.ovh/pages/order/order_pdf/generate_pdf.php?order_id=' . $id .'<br>

    Vous devez être connecté pour télécharger votre ticket, si vous ne l\'êtes pas, vous pouvez toujours retrouver votre ticket dans la section "mes réservations de votre profil".
    '; // Mail content

// PHP Mailer
$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->CharSet = "UTF-8";
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'flutters.noreply@gmail.com';
$mail->Password = 'jsclcfdogvsmscgt';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->SMTPDebug = true;

$mail->setFrom('flutters.noreply@gmail.com');

$mail->addAddress($account_email);

$mail->isHTML(true);

$mail->Subject = $subject;
$mail->Body = $message;

$mail->send();
// FIN MAIL
