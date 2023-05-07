  <?php

    // send the email to the user
    // Import PHPMailer Datas
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

    // include bdd
    include("/var/www/flutters.ovh/pages/connect_db.php");

    // check if the acc has been already activated or not
    $query = $bdd->prepare('SELECT email FROM NEWSLETTER WHERE email = :email');
    $query->execute([
        'email' => htmlspecialchars($_POST['email']),
    ]);
    $email_ver = $query->fetch(PDO::FETCH_COLUMN);

    if ($email_ver != "") {
        $msg = 'Vous êtes déjà inscrit à la newsletter !';
        header('location:newsletter.php?message=' . $msg);
        exit;
    }

    // insert the email in the bdd
    $query = $bdd->prepare('INSERT INTO NEWSLETTER(email, sub_date) VALUES(:email, :sub_date)');
    $query->execute([
        'email' => htmlspecialchars($_POST['email']),
        'sub_date' => date("y-m-d"),
    ]);

    $phpmailer->SMTPDebug=0;
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'noreply.flutters@gmail.com';
    $mail->Password = 'yzxuigjxhslrhlqt';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    // Paramètres du message
    $mail->setFrom('noreply.flutters@gmail.com', 'Flutters');
    $mail->addAddress(htmlspecialchars($_POST['email']));
    $mail->addReplyTo('votre-email@gmail.com', 'Votre nom');
    $mail->isHTML(true);
    $mail->Subject = 'Bienvenue chez Flutters !';
    $mail->Body = '<img src="https://ci4.googleusercontent.com/proxy/vqph7D0GB8PFU2PMsQwylXGcR6tgSvA4wlUY_bCuF6oCMS1Syec0xexdOV-Ip-pQ6azMTqWeskEoq71xSBJrb3Z2HjRmTbVMicdDBxk0jckcwlzfzbrG76f3PDPAqJhcpjCQJi9F281Jp1m7qvc7wVhU=s0-d-e1-ft#http://image.email.ugc.fr/lib/fe5c15707c6200747015/m/8/30262719-58be-4d67-bdd5-03c0058ccc12.jpg" />
    <p>Nous sommes ravis de vous accueillir en tant que membres de Flutters, le site de cinéma dédié aux passionnés de films du monde entier. Votre abonnement est une marque de confiance que nous prenons très au sérieux et nous sommes déterminés à offrir une expérience de qualité à tous nos abonnés.</p>';

    $mail->send();

    $msg = 'Vous vous êtes inscrit à la newsletter Flutters avec succès ! !';
    header('location:newsletter.php?message=' . $msg);
    exit;


    ?>