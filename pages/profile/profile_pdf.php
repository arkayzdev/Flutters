<?php
    require_once dirname(__FILE__).'/vendor/autoload.php';

    use Spipu\Html2Pdf\Html2Pdf;
    use Spipu\Html2Pdf\Exception\Html2PdfException;
    use Spipu\Html2Pdf\Exception\ExceptionFormatter;

    if($_POST['newsletter']==1){
        $_POST['newsletter'] = 'actif';
    } else {
        $_POST['newsletter'] = 'inactif';
    };

    $content = '

    <page> 
        <h1 style="text-align:center; font-size:38px; margin: 50px 0 50px 0;"> Informations Utilisateur </h1>
        <p style="margin: 75px 0 0 100px; padding:0; font-size:18px;"> <strong>Utilisateur</strong>: ' . $_POST['last_name'] . ' ' . $_POST['first_name'] . '  </p>
        <p style="margin: 15px 0 0 100px; padding:0; font-size:18px;"> <strong>Email</strong>: ' . $_POST['email'] . '  </p>
        <p style="margin: 15px 0 0 100px; padding:0; font-size:18px;"> <strong>Newsletter</strong>: ' . $_POST['newsletter'] . '  </p>
        <img style="width:200px; height:200px; position: absolute; left:500px; top: 150px; object-fit: cover;" src="users_avatars/' . $_POST['avatar'] . '">

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
