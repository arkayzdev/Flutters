<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXPORT</title>

    <!-- Import css -->
    <!-- <link href="pdf.css" rel="stylesheet"> -->
</head>
<body>
    <div id="recap_page">
        <p>Cinéma Flutters La Misère</p>
        <p>28 Boulevard de la Misère, Paris 15ème</p>

        <h2><?php echo $title?></h2>

        <img style="width:400px;margin-bottom: 50px;" src="https://Flutters.ovh/pages/dashboard/movies/<?php echo $poster?>">

        <p><strong><?php echo $seance_date?></strong></p>
        <p>Début de séance : <?php echo $start_time?></p>
        <p>Durée : <?php echo $duration?> min</p>
        <p style="margin-bottom:30px;">Fin de la séance prévue à <?php echo $end_time?></p>

        <p>Audio</p>
        <p style="margin-bottom:30px;"><strong><?php echo $audio?></strong></p>

        <p>Salle</p>
        <p><strong><?php echo $room?> (<?php echo $capacity?> places)</strong></p>
    </div> 
    <div id="qr_page">
        <p>Numéro de réservation</p>
        <p style="margin-bottom:30px;"><strong><?php echo str_replace('cs_test_','',$order_id);?></strong></p>

        <p>Commande effectuée par</p>
        <p style="margin-bottom:50px;"><strong><?php echo htmlspecialchars($email)?> le <?php echo $purchase_date?></strong></p>
        <img style="margin-bottom: 30px" src="https://chart.googleapis.com/chart?chs=400x400&cht=qr&choe=UTF-8&chl=https://Flutters.ovh/pages/order/order_pdf/control_ticket.php?id=<?php echo $order_id?>" title="CONTROL TICKET" />

        <p><strong><?php echo $nb_billet?> billet(s)</strong></p>
        <p style="margin-bottom:50px;">Prix total : <strong><?php echo $final_price ?>€</strong></p>

        <p>Ce billet est à usage unique - Une fois scanné et validé à l'entrée de notre Cinéma, il ne pourra plus être réutilisé</p>
    </div>
</body>
</html>