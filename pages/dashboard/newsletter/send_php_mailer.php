<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/pages/ban-check.php');
    // Connect to the db
    include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");

$subject = $_POST['subject'];
$content = $_POST['content'];

// Image
$from = $_FILES['image']['tmp_name'];

$timestamp = time(); 
$array = explode('.', $_FILES['image']['name']);
$extension = end($array); 
$filename = 'php_mailer-poster-' . $timestamp . '.' . $extension;
$destination = 'phpmailer_images/' . $filename;
$saveResult = move_uploaded_file($from, $destination);

// Get every information we need
$q = 'SELECT * FROM NEWSLETTER';
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
    $account_email = $res['email'];
    $token = hash('sha512', $res['sub_date']);
    // MAIL 
    $headers = 'From:flutters.noreply@gmail.com' . "\r\n"; // Header
    $message = ' 
        De la part de toute l\'équipe Flutters, <br>
        Bonjour ! <br><br>
        <img style="width:14em; height:21em" src=https://flutters.ovh/pages/dashboard/newsletter/'. $destination .'>
        <br><br>'
        . $content . ' <br><br> 
        Pour vous désinscrire, cliquez <a href="https://flutters.ovh/pages/dashboard/newsletter/unsubscribe_newsletter.php?email=' . $account_email . '&token=' . $token . '">ici</a>.
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
    $mail->SMTPDebug = 0;

    $mail->setFrom('flutters.noreply@gmail.com');

    $mail->addAddress($account_email);

    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->Body = $message;

    $mail->send();
    // FIN MAIL
}
?>
<script>
    window.addEventListener("load", (event) => {
        window.location.href = "http://flutters.ovh/pages/dashboard/newsletter/newsletter.php";
    });
</script>

