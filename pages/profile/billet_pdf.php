<?php
    session_start();
    setlocale(LC_TIME, 'fr_FR.utf8','fra'); 

    // Connect to the db
    include("../connect_db.php");

    // Verify if session is on
    if(!isset($_SESSION['email'])){
        $msg = 'ERROR: PROFILE_SESSION_NOT_LOADED';
        header('location:../login/sign_in/sign_in.php?message=' . $msg);
        exit;
    }

    // Verify if email exist in the db
    $query = $bdd->prepare('SELECT email FROM USERS WHERE id_client = (SELECT id_client FROM ORDERS WHERE order_id = :order_id)');
    $query->execute([
        'order_id' => htmlspecialchars($_POST['r_order_id']),
    ]);
    $result = $query->fetch(PDO::FETCH_COLUMN);

    if($result != $_SESSION['email']){
        $msg = 'ERROR: ID WITH ACC DOES NOT MATCH' . $_POST['r_order_id'] . ' ' . $_SESSION['email'] . '';
        header('location:mes_reservations.php?message=' . $msg);
        exit;
    }

    require_once dirname(__FILE__).'/vendor/autoload.php';

    use Spipu\Html2Pdf\Html2Pdf;
    use Spipu\Html2Pdf\Exception\Html2PdfException;
    use Spipu\Html2Pdf\Exception\ExceptionFormatter;

    // $_POST['r_order_id']
    // $_POST['r_order_purchase_date']
    // $_POST['r_final_price']
    // $_POST['r_no_ticket']
    // $_POST['r_seance_date']
    // $_POST['r_start_time']
    // $_POST['r_langage']
    // $_POST['r_title']
    // $_POST['r_duration']
    // $_POST['r_poster_image']
    // $_POST['r_room_name']

    $content = '


    <page backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm"> 
        <h1 style="text-align:center; font-size:38px; margin: 30px 0 0px 0; text-decoration: underline">' . $_POST['r_title'] . '</h1>
        <p style="text-align:center; margin: 15px 0 30px 0; font-size:14px;"><strong> ' . strftime("%d %B %G", strtotime($_POST['r_seance_date'])) . ' à ' .  date("G:i", strtotime($_POST['r_start_time'])) . ' (' . $_POST['r_duration'] . ' min) en ' . $_POST['r_language'] . '</strong></p>

        <img style="display:block; margin: 20px 0 50px 220px; width:300px;" src="../dashboard/movies/' . $_POST['r_poster_image'] . '">


        <p style="font-size:16px; padding:0; margin:7px 0 7px 0;"><strong>Date de réservation: </strong>' . strftime("%d %B %G", strtotime($_POST['r_order_purchase_date'])) . '</p>
        <p style="font-size:16px;padding:0; margin:7px 0 7px 0;"><strong>Nombre de billets: </strong>' . $_POST['r_no_ticket'] . ' billet(s)</p>
        <p style="font-size:16px;padding:0; margin:7px 0 7px 0;"><strong>Prix total: </strong>' . number_format($_POST['r_final_price'],2) . '€ TTC</p>
        <p style="font-size:16px;padding:0; margin:7px 0 7px 0;"><strong>Numéro de commande:</strong> #' . $_POST['r_order_id'] . '</p>
        <p style="font-size:16px;padding:0; margin:7px 0 7px 0;"><strong>Salle: </strong>' . $_POST['r_room_name'] . '</p>
    </page> 
    
    ';

    try {
        ob_start();

        $html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8', 0);
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content);
        $html2pdf->output('user_data.pdf', 'D');
        // $html2pdf->output('user_data.pdf');

    } catch (Html2PdfException $e) {
        $html2pdf->clean();

        $formatter = new ExceptionFormatter($e);
        echo $formatter->getHtmlMessage();
    }
