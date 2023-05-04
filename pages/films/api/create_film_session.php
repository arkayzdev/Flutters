<?php
// Connect to db
include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");

if(isset($_GET['search']) && $_GET['search']!=""){
    $q = 'SELECT * FROM SESSION WHERE id_session IN (SELECT id_session FROM TAKE_PLACE WHERE id_movie = :id_movie) AND seance_date = :seance_date ORDER BY start_time ASC;';

    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'id_movie' => $_GET['id'],
        'seance_date' => $_GET['search']
    ]);
    $result = $req -> fetchAll(PDO::FETCH_ASSOC);

    if(count($result)==0){
        echo '<button style="height:10em;" class="calendar_button_passed no_seance">
        <i class="uil uil-annoyed-alt" style="font-size:2em;color: darkslategrey;"></i>
        <div>
            <p style="width:6em; margin-left: 0.4em; color:darkslategrey;">Pas de séance à cette date.</p>
        </div>
        </button>';
    } else {
        foreach($result as $session) { 

            $from_time = strtotime(date('G:i:s')); 
            $to_time = strtotime($session['start_time']); 
            $diff_minutes = round(($from_time - $to_time) / 60,2). " minutes";

            $diff_days = round((strtotime($session['seance_date']) - strtotime(date('Y-m-d'))) / (60 * 60 * 24),2);

            if($diff_minutes > 0 && $diff_days<=0){
                echo '<button style="height:5em; color: darkgrey" value='. htmlspecialchars($session['id_session']) . ' class="calendar_button_passed">
                <i class="uil uil-ticket" style="font-size:1.5em;";"></i>
                <div>
                    <p style="width:4em; margin-left: 0.4em;color: darkgrey;">' .  date("G:i", strtotime($session['start_time'])) . '</p>
                    <p style="width:5em;color: darkgrey">' .  htmlspecialchars($session['language']) . '</p>
                </div>
                </button>';
            } else {
                echo '<button onclick="redirect_session(this.value,' . htmlspecialchars($_GET['id']) . ')" style="height:5em;" value='. htmlspecialchars($session['id_session']) . ' class="calendar_button">
                <i class="uil uil-ticket" style="font-size:1.5em;";"></i>
                <div>
                    <p style="width:4em; margin-left: 0.4em;">' .  date("G:i", strtotime($session['start_time'])) . '</p>
                    <p style="width:5em;">' .  htmlspecialchars($session['language']) . '</p>
                </div>
                </button>';
            }
        } 
    }
} else {
    $q = 'SELECT * FROM SESSION WHERE id_session IN (SELECT id_session FROM TAKE_PLACE WHERE id_movie = :id_movie) AND seance_date = CURRENT_DATE ORDER BY start_time ASC;';

    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'id_movie' => $_GET['id'],
    ]);
    $result = $req -> fetchAll(PDO::FETCH_ASSOC);

    if(count($result)==0){
        echo '<button style="height:10em;" class="calendar_button_passed no_seance">
        <i class="uil uil-annoyed-alt" style="font-size:2em;color: darkslategrey;"></i>
        <div>
            <p style="width:6em; margin-left: 0.4em; color:darkslategrey;">Pas de séance à cette date.</p>
        </div>
        </button>';
    } else {

        foreach($result as $session) { 

            $from_time = strtotime(date('G:i:s')); 
            $to_time = strtotime($session['start_time']); 
            $diff_minutes = round(($from_time - $to_time) / 60,2). " minutes";

            if($diff_minutes > 0){

                echo '<button style="height:5em; color: darkgrey" value='. htmlspecialchars($session['id_session']) . ' class="calendar_button_passed">
                <i class="uil uil-ticket" style="font-size:1.5em;";"></i>
                <div>
                    <p style="width:4em; margin-left: 0.4em;color: darkgrey;">' .  date("G:i", strtotime($session['start_time'])) . '</p>
                    <p style="width:5em;color: darkgrey">' .  htmlspecialchars($session['language']) . '</p>
                </div>
                </button>';
            } else {
                echo '<button onclick="redirect_session(this.value,' . htmlspecialchars($_GET['id']) . ')" style="height:5em;" value='. htmlspecialchars($session['id_session']) . ' class="calendar_button">
                <i class="uil uil-ticket" style="font-size:1.5em;";"></i>
                <div>
                    <p style="width:4em; margin-left: 0.4em;">' .  date("G:i", strtotime($session['start_time'])) . '</p>
                    <p style="width:5em;">' .  htmlspecialchars($session['language']) . '</p>
                </div>
                </button>';
            }
        }
    }

}
