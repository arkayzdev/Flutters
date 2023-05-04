<?php
setlocale(LC_TIME, 'fr_FR.utf8','fra'); 


include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");

if(isset($_GET['search']) && $_GET['search']!=""){

    $q = 'SELECT * FROM EVENT WHERE name LIKE ? AND date_event >= ?  ORDER BY date_event ASC;';

    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        '%' . $_GET['search'] . '%',
        date('Y-m-d')
    ]);
    $result = $req -> fetchAll(PDO::FETCH_ASSOC);

    foreach($result as $event) { 
        echo '<a class="event_a" href="event_page.php?id=' . htmlspecialchars($event['id_event']) . '">'
    ?>
            <?php 
                echo '<img id="event_img" src="../dashboard/events/' . htmlspecialchars($event['image']) . '">
                <p class="titles"> ' . htmlspecialchars($event['name']) . '<br>' . ucwords(strftime("%d %B %G", strtotime($event['date_event']))) . '</p> 
            ';?>
        </a>
    <?php 
    }
} else {
    $q = 'SELECT * FROM EVENT WHERE date_event >= ? ORDER BY date_event ASC;';

        $req = $bdd->prepare($q);
        $reponse = $req->execute([
            date('Y-m-d')
        ]);
        $result = $req -> fetchAll(PDO::FETCH_ASSOC);

        foreach($result as $event) { 
            echo '<a class="event_a" href="event_page.php?id=' . htmlspecialchars($event['id_event']) . '">'
        ?>
                <?php 
                    echo '<img id="event_img" src="../dashboard/events/' . htmlspecialchars($event['image']) . '">
                    <p class="titles"> ' . htmlspecialchars($event['name']) . '<br>' . ucwords(strftime("%d %B %G", strtotime($event['date_event']))) . '</p> 
                    ';?>
            </a>
    <?php 
    }
}
?>