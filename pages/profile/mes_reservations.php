<?php 
    session_start();
  setlocale(LC_TIME, 'fr_FR.utf8','fra'); 


    // $_SESSION['email']='huangfrederic2002@gmail.com';
    // $_SESSION['email']='franck.zhuang@htm.fr';
    // $_SESSION['user_type']='Normal';

    // Connect to the db
    include("../connect_db.php");

    // Verify if session is on
    if(!isset($_SESSION['email'])){
        $msg = 'ERROR: PROFILE_SESSION_NOT_LOADED';
        header('location:../login/sign_in/sign_in.php?message=' . $msg);
        exit;
    }


 

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
  <title>Profile</title>

  <!-- Import Bootstrap CSS Library -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <!-- Import css -->
  <link href="profile.css?rs=<?= time() ?>" rel="stylesheet">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
  
</head>

<body>
<?php 
          // LD MODE COOKIES PAS TOUCHER
    if (!isset($_COOKIE['ld_mode'])) {
      setcookie("ld_mode", 3, $_SERVER['DOCUMENT_ROOT']);
    }
    include ($_SERVER['DOCUMENT_ROOT'].'/ld_mode/ld_mode.php');
    ?>
    <!-- Include Header -->
    <?php include("/var/www/flutters.ovh/pages/nav/nav.php"); ?>

    <!-- main content -->
    <main class="d-flex flex-column pb-5">
                <!-- Button trigger message modal -->
        <button type="button" style="display:none" id="btn_message_modal" data-bs-toggle="modal" data-bs-target="#message_modal">
        </button>

        <!-- activate the message -->
        <?php 
        if(!empty($_GET['message'])){ 
            echo '
            <script>
            window.onload = function(){document.getElementById("btn_message_modal").click();};
            </script>';
        } ;
        ?>


        <!-- message modal -->
        <div class="modal fade" id="message_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="background-color:white;">
                    <div class="modal-header" style="border:none;">
                        <h1 class="modal-title fs-5 mt-4" id="exampleModalLabel" style="font-weight:700;">Notification Flutters</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pt-0 pb-0" style="border:none">
                        <?php echo '<p class="mb-0" style="font-weight:600;">' . htmlspecialchars($_GET['message']) .'</p>';?>
                    </div>
                    <div class="modal-footer" style="border:none">
                        <button id="profile_avatar_delete_modal" type="button" data-bs-dismiss="modal">D'accord</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- profile_up_side nav -->
        <div class="d-block d-lg-none" id="profile_up_side">
            <nav>
                <ul class="d-flex p-0 ld_item">
                    <li class="col-6 text-center"><a class="ld_itema" href="profile.php">Mes informations</a></li>
                    <li class="col-6 text-center"><a class="ld_itema" href="mes_reservations.php">Mes réservations</a></li>
                </ul>
            </nav>
        </div>
        <!-- the rest -->
        <div class="d-flex">
            <!-- fill -->
            <div class="d-none d-xl-block col-xl-1"></div>

            <!-- profile_left_side nav -->
            <div class="d-none d-lg-block col-4 col-xl-3" id="profile_left_side">
                <nav style="list-style:none;">
                    <ul class="d-none d-lg-flex ld_item">
                        <li><a class="ld_itema" href="profile.php">Mes informations</a></li>
                        <li><a class="ld_itema" href="mes_reservations.php">Mes réservations</a></li>
                    </ul>
                </nav>
            </div>

            <!-- profile_right_side informations -->
            <div class="col-12 col-lg-8 col-xl-7 d-flex flex-column">

            <?php
            /////////////////////////////////////////////
                $q = 'SELECT * FROM ORDERS INNER JOIN TICKET ON ORDERS.order_id = TICKET.order_id INNER JOIN SESSION ON SESSION.id_session = TICKET.id_session WHERE id_client = (SELECT id_client FROM USERS WHERE email = :email) ORDER BY seance_date DESC;';
                $req = $bdd->prepare($q);
                $reponse = $req->execute([
                  'email' => htmlspecialchars($_SESSION['email']),
                ]);
                $tableau1 = $req -> fetchAll(PDO::FETCH_ASSOC);

                $q = 'SELECT * FROM ORDERS INNER JOIN TICKET ON ORDERS.order_id = TICKET.order_id INNER JOIN EVENT ON EVENT.id_event = TICKET.id_event WHERE id_client = (SELECT id_client FROM USERS WHERE email = :email) ORDER BY date_event DESC;';
                $req = $bdd->prepare($q);
                $reponse = $req->execute([
                  'email' => htmlspecialchars($_SESSION['email']),
                ]);
                $tableau2 = $req -> fetchAll(PDO::FETCH_ASSOC);

                // Fusionner les tableaux
                $result = array();
                $i = 0;
                foreach($tableau1 as $res) { 
                    $result[$i] = $res;
                    $i = $i+1;
                }
                foreach($tableau2 as $res) { 
                    $result[$i] = array( 'order_id' => $res['order_id'], 'seance_date' => $res['date_event']);
                    $i = $i+1;
                }
                

                function removeDuplicateOrders($orders) {
                    $orderIds = array();
                    foreach ($orders as $key => $order) {
                      $orderId = $order['order_id'];
                      if (in_array($orderId, $orderIds)) {
                        unset($orders[$key]);
                      } else {
                        $orderIds[] = $orderId;
                      }
                    }
                    return array_values($orders);
                  }
                  $result = removeDuplicateOrders($result);

                // Fonction de comparaison pour trier par ordre alphabétique du nom
                function compareByName($a, $b) {
                    return strcmp($b['seance_date'], $a['seance_date']);
                }

                usort($result, 'compareByName');


                /////////////////////////////////////////////
                
                if(isset($result[0])){
                    foreach($result as $id_client) { 
                        // Verify if its an event or a movie session
                        $q = 'SELECT id_session,id_event FROM TICKET WHERE order_id = :order_id LIMIT 1';
                        $req = $bdd->prepare($q);
                        $reponse = $req->execute([
                          'order_id' => htmlspecialchars($id_client['order_id']),
                        ]);
                        $result = $req -> fetch(PDO::FETCH_ASSOC);

                        if(isset($result['id_session'])){

                            $r_order_id = $id_client['order_id'];
                            $r_order_purchase_date = $id_client['purchase_date'];
                            $r_final_price = $id_client['final_price'];

                            // Verify if email exist in the db
                            $query = $bdd->prepare('SELECT COUNT(id_ticket) FROM TICKET WHERE order_id = :order_id');
                            $query->execute([
                                'order_id' => htmlspecialchars($r_order_id),
                            ]);
                            $r_no_ticket = $query->fetch(PDO::FETCH_COLUMN);

                            $query = $bdd->prepare('SELECT seance_date FROM SESSION WHERE id_session = (SELECT id_session FROM TICKET WHERE order_id = :order_id LIMIT 1)');
                            $query->execute([
                                'order_id' => htmlspecialchars($r_order_id),
                            ]);
                            $r_seance_date = $query->fetch(PDO::FETCH_COLUMN);

                            $query = $bdd->prepare('SELECT start_time FROM SESSION WHERE id_session = (SELECT id_session FROM TICKET WHERE order_id = :order_id LIMIT 1)');
                            $query->execute([
                                'order_id' => htmlspecialchars($r_order_id),
                            ]);
                            $r_start_time = $query->fetch(PDO::FETCH_COLUMN);

                            $query = $bdd->prepare('SELECT language FROM SESSION WHERE id_session = (SELECT id_session FROM TICKET WHERE order_id = :order_id LIMIT 1)');
                            $query->execute([
                                'order_id' => htmlspecialchars($r_order_id),
                            ]);
                            $r_language = $query->fetch(PDO::FETCH_COLUMN);

                            $query = $bdd->prepare('SELECT title FROM MOVIE WHERE id_movie = (SELECT id_movie FROM TAKE_PLACE WHERE id_session = (SELECT id_session FROM TICKET WHERE order_id = :order_id LIMIT 1))');
                            $query->execute([
                                'order_id' => htmlspecialchars($r_order_id),
                            ]);
                            $r_title = $query->fetch(PDO::FETCH_COLUMN);

                            $query = $bdd->prepare('SELECT duration FROM MOVIE WHERE id_movie = (SELECT id_movie FROM TAKE_PLACE WHERE id_session = (SELECT id_session FROM TICKET WHERE order_id = :order_id LIMIT 1))');
                            $query->execute([
                                'order_id' => htmlspecialchars($r_order_id),
                            ]);
                            $r_duration = $query->fetch(PDO::FETCH_COLUMN);

                            $query = $bdd->prepare('SELECT poster_image FROM MOVIE WHERE id_movie = (SELECT id_movie FROM TAKE_PLACE WHERE id_session = (SELECT id_session FROM TICKET WHERE order_id = :order_id LIMIT 1))');
                            $query->execute([
                                'order_id' => htmlspecialchars($r_order_id),
                            ]);
                            $r_poster_image = $query->fetch(PDO::FETCH_COLUMN);

                            $query = $bdd->prepare('SELECT room_name FROM ROOM WHERE id_room = (SELECT id_room FROM SESSION WHERE id_session = (SELECT id_session FROM TICKET WHERE order_id = :order_id LIMIT 1))');
                            $query->execute([
                                'order_id' => htmlspecialchars($r_order_id),
                            ]);
                            $r_room_name = $query->fetch(PDO::FETCH_COLUMN);
                            ?>

                            <!-- Tickets -->
                            <div class="profile_right_side_div d-block d-sm-flex flex-row-reverse r_background"
                                    <?php
                                        if(date("Y-m-d",strtotime($r_seance_date))<date('Y-m-d')){
                                            echo 'style="filter: grayscale(100%);background: linear-gradient(to left, rgba(230, 230, 230, 0.5), rgba(230, 230, 230, 1)), url(../dashboard/movies/' . $r_poster_image . '); ">';
                                            echo '<div class="col-sm-4">';
                                            echo '<img style="filter: grayscale(100%);"  class="r_poster" src="../dashboard/movies/' . $r_poster_image . '">';
                                        } else {
                                            echo 'style="background: linear-gradient(to left, rgba(230, 230, 230, 0.5), rgba(230, 230, 230, 1)), url(../dashboard/movies/' . $r_poster_image . '); ">';
                                            echo '<div class="col-sm-4">';
                                            echo '<img class="r_poster" src="../dashboard/movies/' . $r_poster_image . '">';
                                        }
                                    ?>
                                </div>
                                <div class="col-sm-8">
                                    <?php 
                                    echo '<p><strong>Film : </strong>' . strftime("%d %B %G", strtotime($r_seance_date)) . ' à ' .  date("G:i", strtotime($r_start_time)) . ' (' . $r_duration . ' min) en ' . $r_language . '</p>';
                                    echo '<h3>' . $r_title . '</h3>';
                                    echo '<p><strong>Date de réservation: </strong>' . strftime("%d %B %G", strtotime($r_order_purchase_date)) . '</p>';
                                    echo '<p><strong>Nombre de billets: </strong>' . $r_no_ticket . ' billet(s)</p>';
                                    echo '<p><strong>Prix total: </strong>' . number_format($r_final_price,2) . '€ TTC</p>';
                                    echo '<p style="word-break:break-all;padding-right:2em;"><strong>Numéro de commande:</strong> #' . str_replace('cs_test_','',$r_order_id) . '</p>';
                                    echo '<p><strong>Salle: </strong>' . htmlspecialchars($r_room_name) . '</p>';
                                    
                                    ?>
                                    
                                    <!-- PDF --> 
                                    <div class="d-flex">
                                        <button style="border:none;" id="billet_pdf" onclick="download_order_pdf('<?php echo $r_order_id?>')">Télécharger</button>                        
                                        <!-- Button trigger modal -->
                                        <button class="d-block d-lg-none ms-2"type="button" data-bs-toggle="modal" data-bs-target="#show_qr_code_<?php echo $r_order_id?>" style="border:none;width:2.5em; font-size:1em;" id="billet_pdf"><i class="uil uil-qrcode-scan"></i></button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="show_qr_code_<?php echo $r_order_id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content" style="background-color:white;">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo htmlspecialchars($r_title)?></h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body d-flex justify-content-center" style="paddding:0;" >
                                                <img src="https://chart.googleapis.com/chart?chs=400x400&cht=qr&choe=UTF-8&chl=https://Flutters.ovh/pages/order/order_pdf/control_ticket.php?id=<?php echo $r_order_id?>" title="CONTROL TICKET" />
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php } elseif(isset($result['id_event'])){
                        $r_order_id = $id_client['order_id'];

                        $q = 'SELECT * FROM ORDERS WHERE order_id = :order_id';
                        $req = $bdd->prepare($q);
                        $reponse = $req->execute([
                          'order_id' => htmlspecialchars($r_order_id),
                        ]);
                        $result = $req -> fetch(PDO::FETCH_ASSOC);
                        $r_order_purchase_date = $result['purchase_date'];
                        $r_final_price = $result['final_price']; ; 

                        $q = 'SELECT count(id_ticket) FROM TICKET WHERE order_id = :order_id';
                        $req = $bdd->prepare($q);
                        $reponse = $req->execute([
                          'order_id' => htmlspecialchars($r_order_id),
                        ]);
                        $result = $req -> fetch(PDO::FETCH_ASSOC);
                        $r_no_ticket = $result['count(id_ticket)'];       
                        
                        $q = 'SELECT id_event FROM TICKET WHERE order_id = :order_id LIMIT 1';
                        $req = $bdd->prepare($q);
                        $reponse = $req->execute([
                          'order_id' => htmlspecialchars($r_order_id),
                        ]);
                        $result = $req -> fetch(PDO::FETCH_ASSOC);

                        $q = 'SELECT * FROM EVENT WHERE id_event = :id_event';
                        $req = $bdd->prepare($q);
                        $reponse = $req->execute([
                          'id_event' => htmlspecialchars($result['id_event']),
                        ]);
                        $result = $req -> fetch(PDO::FETCH_ASSOC);

                        $r_poster_image = $result['image'];
                        $r_seance_date = $result['date_event'];
                        $r_start_time = $result['start_time'];
                        $r_title = $result['name'];

                        ?>
                        <!-- Tickets -->
                        <div class="profile_right_side_div d-block d-sm-flex flex-row-reverse r_background"
                                    <?php
                                    if(date("Y-m-d",strtotime($r_seance_date))<=date('Y-m-d')){
                                        echo 'style="filter: grayscale(100%);background: linear-gradient(to left, rgba(230, 230, 230, 0.5), rgba(230, 230, 230, 1)), url(../dashboard/events/' . htmlspecialchars($r_poster_image) . '); ">';
                                        echo '<div class="col-sm-4">';
                                        echo '<img style="filter: grayscale(100%);" class="r_poster" src="../dashboard/events/' . htmlspecialchars($r_poster_image) . '">';
                                    } else {
                                        echo 'style="background: linear-gradient(to left, rgba(230, 230, 230, 0.5), rgba(230, 230, 230, 1)), url(../dashboard/events/' . htmlspecialchars($r_poster_image) . '); ">';
                                        echo '<div class="col-sm-4">';
                                        echo '<img class="r_poster" src="../dashboard/events/' . htmlspecialchars($r_poster_image) . '">';
                                    }
                                    ?>
                                </div>
                                <div class="col-sm-8">
                                    <?php 
                                    echo '<p><strong>Evènement</strong> : ' . strftime("%d %B %G", strtotime($r_seance_date)) . ' à ' .  date("G:i", strtotime($r_start_time)) . '</p>';
                                    echo '<h3>' . $r_title . '</h3>';
                                    echo '<p><strong>Date de réservation: </strong>' . strftime("%d %B %G", strtotime($r_order_purchase_date)) . '</p>';
                                    echo '<p><strong>Nombre de billets: </strong>' . $r_no_ticket . ' billet(s)</p>';
                                    echo '<p><strong>Prix total: </strong>' . number_format($r_final_price,2) . '€ TTC</p>';
                                    echo '<p style="word-break:break-all;padding-right:2em;"><strong>Numéro de commande:</strong> #' . str_replace('cs_test_','',$r_order_id) . '</p>';                                    
                                    ?>
                                    
                                    <!-- PDF --> 
                                    <div class="d-flex">
                                        <button style="border:none;" id="billet_pdf" onclick="download_event_pdf('<?php echo $r_order_id?>')">Télécharger</button>                        
                                        <!-- Button trigger modal -->
                                        <button class="d-block d-lg-none ms-2"type="button" data-bs-toggle="modal" data-bs-target="#show_qr_code_<?php echo $r_order_id?>" style="border:none;width:2.5em; font-size:1em;" id="billet_pdf"><i class="uil uil-qrcode-scan"></i></button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="show_qr_code_<?php echo $r_order_id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content" style="background-color:white;">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo htmlspecialchars($r_title)?></h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body d-flex justify-content-center" style="paddding:0;" >
                                                <img src="https://chart.googleapis.com/chart?chs=400x400&cht=qr&choe=UTF-8&chl=https://Flutters.ovh/pages/events/events_pdf/control_ticket.php?id=<?php echo $r_order_id?>" title="CONTROL TICKET" />
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                    }
                    }
                        } else { ?>
                            <div id="no_command">
                                <p> Vous n'avez aucune commande </p>
                            </div>
                        <?php } ?>

            </div>

            <!-- fill -->
            <div class="d-none d-xl-block col-xl-1"></div>

        </div>
    </main>

          <!-- Footer -->
  <?php include '/var/www/flutters.ovh/pages/footer/footer.php' ?>

    <!-- Import Bootstrap JS Library -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/gsap.min.js"></script>
    <script src="profile.js"></script>
    <script src="https://flutters.ovh/ld_mode/main.js"></script>
</body>

</html>