<?php
  setlocale(LC_TIME, 'fr_FR.utf8','fra'); 

  include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");
  
    // Calendar Date
    $calendar = [];

    if(!isset($_GET['date'])){

        for($i=0; $i<6; $i++){
            array_push($calendar, date('Y-m-d', time()+$i*86400));
          }    
      
          for($i=0; $i<6; $i++){ 

            $q = 'SELECT * FROM SESSION WHERE id_session IN (SELECT id_session FROM TAKE_PLACE WHERE id_movie = :id_movie) AND seance_date = :seance_date ORDER BY start_time ASC;';

              $req = $bdd->prepare($q);
              $reponse = $req->execute([
                  'id_movie' => $_GET['id'],
                  'seance_date' => strftime("%Y-%m-%d", strtotime($calendar[$i]))
              ]);
              $result = $req -> fetchAll(PDO::FETCH_ASSOC);
  
              if(count($result) != 0){
                  echo '<button style=" box-shadow:  rgba(148, 15, 32, 0.45) 0px 5px 15px; transition: 0.2s; " onclick="calendar_button_trigger(this.value,' . htmlspecialchars($_GET['id']) . ')" value="' . htmlspecialchars($calendar[$i]) . '" class="calendar_button"><p id="' . htmlspecialchars($calendar[$i]) . '">' . strtoupper(strftime("%a %d %b",strtotime($calendar[$i]))) . '</p></button>';

                } else {
                    echo '<button onclick="calendar_button_trigger(this.value,' . htmlspecialchars($_GET['id']) . ')" value="' . htmlspecialchars($calendar[$i]) . '" class="calendar_button"><p id="' . htmlspecialchars($calendar[$i]) . '">' . strtoupper(strftime("%a %d %b",strtotime($calendar[$i]))) . '</p></button>';
                }
          
            }

          echo '<input class="d-none" id="calendar_selected_date" value=' . date('Y-m-d') . '>';
    } else {
 
        for($i=0; $i<6; $i++){
        array_push($calendar, date('Y-m-d', strtotime($_GET['date']. ' + ' . $i . ' day')));
        }    

        for($i=0; $i<6; $i++){ 

            $q = 'SELECT * FROM SESSION WHERE id_session IN (SELECT id_session FROM TAKE_PLACE WHERE id_movie = :id_movie) AND seance_date = :seance_date ORDER BY start_time ASC;';

            $req = $bdd->prepare($q);
            $reponse = $req->execute([
                'id_movie' => $_GET['id'],
                'seance_date' => strftime("%Y-%m-%d", strtotime($calendar[$i]))
            ]);
            $result = $req -> fetchAll(PDO::FETCH_ASSOC);

            if(count($result) != 0){
                echo '<button style="  box-shadow:  rgba(148, 15, 32, 0.45) 0px 5px 15px; transition: 0.2s; " onclick="calendar_button_trigger(this.value,' . htmlspecialchars($_GET['id']) . ')" value="' . htmlspecialchars($calendar[$i]) . '" class="calendar_button"><p id="' . htmlspecialchars($calendar[$i]) . '">' . strtoupper(strftime("%a %d %b",strtotime($calendar[$i]))) . '</p></button>';
            } else {
                echo '<button onclick="calendar_button_trigger(this.value,' . htmlspecialchars($_GET['id']) . ')" value="' . htmlspecialchars($calendar[$i]) . '" class="calendar_button"><p id="' . htmlspecialchars($calendar[$i]) . '">' . strtoupper(strftime("%a %d %b",strtotime($calendar[$i]))) . '</p></button>';
            }
        }

        echo '<input class="d-none" id="calendar_selected_date" value=' . date('Y-m-d', strtotime($_GET['date']. ' + 0 day')) . '>';
}