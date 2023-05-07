<?php

$q = 'SELECT * FROM USERS';
$req = $bdd->prepare($q);
$reponse = $req->execute();
$result = $req -> fetchAll(PDO::FETCH_ASSOC);

// Import PHPMailer Datas
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

foreach($result as $res){
    if (isset($res['last_login']) && date('Y-m-d', strtotime($res['last_login'] . ' + 30 days'))<date('Y-m-d') && $res['last_login_active']==1 ){
        $account_email = $res['email'];
        $token = hash('sha512', $res['first_name']);
        // PHP Mailer
        $mail = new PHPMailer(true);

        // MAIL 
        $headers = 'From:flutters.noreply@gmail.com' . "\r\n"; // Header
        $subject = 'Vous nous manquez chez Flutters !';
        $message = ' 
            De la part de toute l\'équipe Flutters, <br>
            Bonjour ! <br><br>
            Vous n\'avez pas été connecté depuis un petit moment et vous nous manquez terriblement !<br>
            Nous voulions juste vous rappeler que nous pensons à vous tout les jours et que nos salles de cinéma vous attendent ! <br><br>
            Pour vous désinscrire, cliquez <a href="https://flutters.ovh/pages/login/sign_in/unsubscribe_last_log.php?email=' . $account_email . '&token=' . $token . '">ici</a>.
            '; // Mail content

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

        $mail->addAddress($account_email);

        $mail->isHTML(true);

        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
        // FIN MAIL

        $q = 'UPDATE USERS SET last_login = :today WHERE email = :email';
        $req = $bdd->prepare($q);
        $reponse = $req->execute([
            'today' => date('Y-m-d'),
            'email' => $res['email']
        ]);
        $result = $req -> fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
<script>
    window.addEventListener("load", (event) => {
        window.location.href = "/";
    });
</script>