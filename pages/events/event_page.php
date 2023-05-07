<?php 

session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/pages/ban-check.php');
  setlocale(LC_TIME, 'fr_FR.utf8','fra'); 

    // Connect to the db
    include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");

    // Get every information we need
    $q = 'SELECT * FROM EVENT WHERE id_event = :id_event';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
      'id_event' => htmlspecialchars($_GET['id'])
    ]);
    $result = $req -> fetch(PDO::FETCH_ASSOC);


    $id = $result['id_event'];
    $name= $result['name'];
    $description= $result['description'];
    $date_event= $result['date_event'];
    $capacity= $result['capacity'];
    $price=number_format($result['price'],2);
    $image=$result['image'];
    $start_time= date('G:i',strtotime($result['start_time']));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo '<title>' . $name . '</title>' ?>

    <!-- Import Bootstrap CSS Library -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Import css -->
    <link href="event_page.css?rs=<?= time() ?>" rel="stylesheet">
    <!-- ICONS -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/solid.css">
</head>
<body id="event_page">
<?php 
          // LD MODE COOKIES PAS TOUCHER
    if (!isset($_COOKIE['ld_mode'])) {
      setcookie("ld_mode", 3, $_SERVER['DOCUMENT_ROOT']);
    }
    include ($_SERVER['DOCUMENT_ROOT'].'/ld_mode/ld_mode.php');
    ?>
    <!-- Include Header -->
    <?php include("/var/www/flutters.ovh/pages/nav/nav.php"); ?> 

    <!-- Button trigger message modal -->
        <button type="button" style="display:none" id="btn_message_modal" data-bs-toggle="modal" data-bs-target="#message_modal">
        </button>

        <!-- activate the message -->
        <?php 
        if(isset($_GET['msg'])){ 
            ?>
            <script>
            window.addEventListener("load", myInitFunction)

            function myInitFunction() {
                // window.onload = document.getElementById("btn_message_modal").click();
                window.addEventListener("load", document.getElementById("btn_message_modal").click());      }
            </script>
            <?php
            }?>
            <!-- message modal -->
            <div class="modal fade" id="message_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="background-color:white;">
                        <div class="modal-header" style="border:none;">
                            <h1 class="modal-title fs-5 mt-4" id="exampleModalLabel" style="font-weight:700;">Notification Flutters</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body pt-0 pb-0" style="border:none">
                            <?php echo '<p class="mb-0" style="font-weight:600;">' . $_GET['msg'] .'</p>';?>
                        </div>
                        <div class="modal-footer" style="border:none">
                            <button class="btn event_comment_button" type="button" data-bs-dismiss="modal">D'accord</button>
                        </div>
                    </div>
                </div>
            </div>

    
    <main>

    <!-- Section : event_presentation -->
    <section id="event_presentation" class="r_background" style="background: linear-gradient(to left, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.6) 50%,rgba(0, 0, 0, 0.8) ), url('../dashboard/events/<?php echo htmlspecialchars($image) ?>');">
        <div id="event_presentation_firstdiv" class="d-flex ">
            <!-- poster  -->
            <div class=" d-flex justify-content-center align-items-center" >
                <img src="../dashboard/events/<?php echo htmlspecialchars($image) ?>">
            </div>
            <!-- informations -->
            <div>
                <p class="fs-5 fw-bold mb-0" style="color:darkgrey;"><?php echo strtoupper(strftime("%A %d %B %G", strtotime($date_event)))?> à <?php echo htmlspecialchars($start_time)?></p>
                <h2><?php echo htmlspecialchars($name)?></h2>
                <p style="width:95%; word-break:normal"><?php echo htmlspecialchars($description)?></p>
                <p style="width:95%;"><strong>Entrées :</strong>  <?php echo htmlspecialchars($capacity)?> places</p>
                <p style="width:95%;"><strong>Prix à l'unité</strong> :  <?php echo htmlspecialchars($price)?>€</p>
            </div>
        </div>

        <?php 
            // Verify the date
            $q = 'SELECT date_event FROM EVENT WHERE id_event = :id_event';
            $req = $bdd->prepare($q);
            $reponse = $req->execute([
            'id_event' => htmlspecialchars($_GET['id'])
            ]);
            $result = $req -> fetch(PDO::FETCH_ASSOC);

            if($result['date_event'] >= date('Y-m-d')){
            ?>
        <?php if(isset($_SESSION['email'])){?>
            <!-- tickets -->
            <div id="ticket" class="d-flex flex-column align-items-center mt-5">

            <!-- select_ticket quantity -->
            <div id="select_ticket">
                <button disabled id="select_ticket_minus" onclick="select_ticket('minus', '<?php echo htmlspecialchars($price) ?>')" ><i class="uil uil-minus-circle"></i></button>
                <input id="select_ticket_value" style="display:none;" value=0>
                <p id="select_ticket_quantity"> 0 Billet(s)</p>
                <button id="select_ticket_plus" onclick="select_ticket('plus', '<?php echo htmlspecialchars($price) ?>')" ><i class="uil uil-plus-circle"></i></button>
            </div>

            <p>Prix unitaire : <?php echo $price?>€ TTC</p>
            <p>8 billets maximum autorisé par commande</p>
            <button onclick="redirect_payment(<?php echo $id?>)" id="select_ticket_total">Prix Total : 0.00€ TTC</button>
            <p class="mt-1">Cliquez pour être redirigé vers le paiement</p>
            </div>

            <?php
            } else {?>
                <!-- tickets -->
                <div id="ticket" class="d-flex flex-column align-items-center mt-5">
    
                <!-- select_ticket quantity -->
                <div id="select_ticket">
                    <button disabled id="select_ticket_minus"><i class="uil uil-minus-circle"></i></button>
                    <input id="select_ticket_value" style="display:none;" value=0>
                    <p id="select_ticket_quantity"> 0 Billet(s)</p>
                    <button disabled style="color:lightgrey" id="select_ticket_plus" ><i class="uil uil-plus-circle"></i></button>
                </div>
    
                <p>Prix unitaire : <?php echo $price?>€ TTC</p>
                <p>8 billets maximum autorisé par commande</p>
                <button id="select_ticket_total">Connectez-vous pour réserver</button>
                <p class="mt-1">Cliquez pour être redirigé vers le paiement</p>
                </div>
        <?php
            }
        ?>
    </section>
        <?php } ?>

    

    </main>


    <!-- Footer -->
    <?php include '/var/www/flutters.ovh/pages/footer/footer.php' ?>

    <!-- Import Bootstrap JS Library -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/gsap.min.js"></script>
    <script src="main.js"></script>
    <script src="https://flutters.ovh/ld_mode/main.js"></script>
</body>
</html>