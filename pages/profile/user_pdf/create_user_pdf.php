<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export User Infos : <?php echo $email?></title>
</head>
<body>
    <h2>Informations Utilisateur : <?php echo $email?></h2>

    <!-- User infos -->
    <div>
        <p>ID client #<?php echo $id_client?></p>
        <p>Email : <?php echo $email?></p>
        <p>Nom : <?php echo $last_name?></p>
        <p>Prénom : <?php echo $first_name?></p>
        <p>Newsletter : <?php echo $newsletter?></p>
    </div>
    
    <h2>Commandes effectuées</h2>

    <!-- Orders infos -->
    <div>
        <?php
        foreach($order_ as $order){
            
            // Select order informations
                $q = 'SELECT count(id_ticket) FROM TICKET WHERE order_id = :order_id;';
                $req = $bdd->prepare($q);
                $reponse = $req->execute([
                    'order_id' => $order['order_id'],
                ]);
                $ticket_ = $req -> fetch(PDO::FETCH_ASSOC);
                $nb_billet = $ticket_['count(id_ticket)'];

                $q = 'SELECT * FROM SESSION WHERE id_session = (SELECT id_session FROM TICKET WHERE order_id = :order_id LIMIT 1);';
                $req = $bdd->prepare($q);
                $reponse = $req->execute([
                    'order_id' => $order['order_id'],
                ]);
                $session_ = $req -> fetch(PDO::FETCH_ASSOC);
                $seance_date = $session_['seance_date'];
                $language = $session_['language'];
                $start_time = $session_['start_time'];

                $q = 'SELECT * FROM MOVIE WHERE id_movie = (SELECT id_movie FROM SESSION WHERE id_session = :id_session);';
                $req = $bdd->prepare($q);
                $reponse = $req->execute([
                    'id_session' => $session_['id_session'],
                ]);
                $movie_ = $req -> fetch(PDO::FETCH_ASSOC);
                $title = $movie_['title'];

                $q = 'SELECT price FROM PAYMENT WHERE id = :order_id;';
                $req = $bdd->prepare($q);
                $reponse = $req->execute([
                    'order_id' => $order['order_id'],
                ]);
                $price_ = $req -> fetch(PDO::FETCH_ASSOC);

                $price = $price_['price'];
        ?>
            <div>
                <p>ID : #<?php echo str_replace('cs_test_', '', $order['order_id'])?></p>
                <p>Acheté le <?php echo ucwords(strftime('%A %e %B %Y',strtotime($order['purchase_date'])))?></p>
                <p>Prix Total : <?php echo number_format($price/100,2)?>€</p>
                <p>Nombre de billets : <?php echo $nb_billet?> billets</p>
                <p>Séance : <?php echo $title . ' - ' . ucwords(strftime('%A %e %B %Y',strtotime($seance_date))) . ' à ' . date('H:i', strtotime($start_time)) . ' en ' . $language?></p>
                <p>---------------------------------------------------------------</p>
            </div style="margin-bottom:40px;">
       <?php 
        }
        ?>
    </div>
    <h2>Logs</h2>

</body>
</html>