<?php
include '../../../connect_db.php';

if(isset($_GET['name']) && !empty($_GET['name'])) {
    $name = trim($_GET['name']);

    $q = "SELECT * FROM SESSION WHERE seance_date LIKE ? ORDER BY start_time ASC";
    $req = $bdd->prepare($q);
    $success = $req->execute([
        '%' . $name . '%'
    ]);
    $result_sessions = $req->fetchAll(PDO::FETCH_ASSOC);
}

if (empty($_GET['name'])) {
    $q = 'SELECT * FROM SESSION ORDER BY seance_date DESC';
    $req = $bdd->query($q);
    $result_sessions = $req->fetchAll(PDO::FETCH_ASSOC);
}

foreach ($result_sessions as $id_session) :
    $id = $id_session['id_session'];
    echo '<tr>';
    echo '<td>' .  htmlspecialchars($id_session['id_session']) . '</td>';
    echo '<td>' .  htmlspecialchars($id_session['seance_date']) . '</td>';
    echo '<td>' .  htmlspecialchars(date("H:i", strtotime($id_session['start_time']))) . '</td>';
    
    $q = "SELECT title, duration  FROM MOVIE m
    INNER JOIN TAKE_PLACE TP on m.id_movie = TP.id_movie
    INNER JOIN SESSION S on TP.id_session = S.id_session
    WHERE S.id_session = $id"; 
    $req = $bdd->query($q);
    $result = $req->fetch(PDO::FETCH_ASSOC);

    echo '<td>' .  htmlspecialchars($result['title']) . '</td>'; 
    echo '<td>' .  htmlspecialchars($result['duration']) . ' min</td>'; 
    echo '<td>' .  htmlspecialchars($id_session['language']) . '</td>'; 

    $id_room = $id_session['id_room'];
    $q = "SELECT room_name, capacity_seat FROM ROOM WHERE id_room = $id_room "; 
    $req = $bdd->query($q);
    $result = $req->fetch(PDO::FETCH_ASSOC);
    
    echo '<td>' .  htmlspecialchars($result['room_name']) . '</td>'; 
    echo '<td>' .  htmlspecialchars($result['capacity_seat']) . '</td>'; 
    echo '<td>' .  htmlspecialchars(number_format($id_session['price'],2)) . '€</td>'; 
    ?>

    <td>
        <button type="button" class="btn btn-light">
            <a class="text-dark" href="sessions?id=<?php echo $id_session['id_session']?>&type=modify">
                <i class="uil uil-setting"></i>
            </a>
        </button>

        <button type="button" class="btn btn-light ms-2" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteModal(<?php echo $id_session['id_session']?>)">
            <i class="uil uil-trash-alt"></i>
        </button>
    </td>
    </tr>
<?php endforeach; ?>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="deleteModalLabel">Confirmation</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Êtes-vous sûr de vouloir supprimer cette séance ?
        </div>
        <div class="modal-footer">
            <button id="delete-session-btn" type="button" class="btn btn-danger">Supprimer</button>
            <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #c6c6c6; color: white">Annuler</button>
        </div>
        </div>
    </div>
</div>
