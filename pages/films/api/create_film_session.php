<?php

include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");

if(isset($_GET['date']) && $_GET['date']!=""){
    // SI UNE DATE EST SELECTIONEE
} else {


    $q = 'SELECT * FROM SESSION WHERE id_session IN (SELECT id_session FROM TAKE_PLACE WHERE id_movie = :id_movie) AND seance_date = CURRENT_DATE ORDER BY start_time ASC;';

    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'id_movie' => $_GET['id'],
    ]);
    $result = $req -> fetchAll(PDO::FETCH_ASSOC);

    foreach($result as $session) { 

        if($session['start_time']<date('G:i')){
            echo '<button style="height:5em; color: darkgrey" value='. $session['id_session'] . ' class="calendar_button_passed">
            <i class="uil uil-ticket" style="font-size:1.5em;";"></i>
            <div>
                <p style="width:4em; margin-left: 0.4em;color: darkgrey;">' .  date("G:i", strtotime($session['start_time'])) . '</p>
                <p style="width:5em;color: darkgrey">' .  $session['language'] . '</p>
            </div>
            </button>';
        } else {
            echo '<button onclick="" style="height:5em;" value='. $session['id_session'] . ' class="calendar_button">
            <i class="uil uil-ticket" style="font-size:1.5em;";"></i>
            <div>
                <p style="width:4em; margin-left: 0.4em;">' .  date("G:i", strtotime($session['start_time'])) . '</p>
                <p style="width:5em;">' .  $session['language'] . '</p>
            </div>
            </button>';
    }
}


}
