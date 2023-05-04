<?php
include '../../../connect_db.php';

if(isset($_GET['name']) && !empty($_GET['name'])) {
    $name = trim($_GET['name']);

    $q = "SELECT * FROM EVENT WHERE (name LIKE ? OR date_event LIKE ?) ";
    $req = $bdd->prepare($q);
    $req->execute([
        '%' . $name . '%',
        '%' . $name . '%'
    ]);
    $result_events = $req->fetchAll(PDO::FETCH_ASSOC);
}

if (empty($_GET['name'])) {
    $q = 'SELECT * FROM EVENT';
    $req = $bdd->query($q);
    $result_events = $req->fetchAll(PDO::FETCH_ASSOC);
} ?>
    
<?php foreach ($result_events as $id_event) : 
    $id = $id_event['id_event'];
    echo '<tr>';
    echo '<td>' .  htmlspecialchars($id_event['id_event']) . '</td>';
    echo '<td>' .  htmlspecialchars($id_event['name']) . '</td>';
    echo '<td>' .  htmlspecialchars(substr($id_event['description'], 0, 20) . '...'). '</td>';
    echo '<td>' .  htmlspecialchars($id_event['date_event']) . '</td>';
    echo '<td>' .  htmlspecialchars(date("H:i", strtotime($id_event['start_time']))) . '</td>';
    echo '<td>' .  htmlspecialchars(number_format($id_event['price'],2)) . '€</td>'; 
    echo '<td>' .  htmlspecialchars($id_event['capacity']) . '</td>';?>
     <td>
        <button type="button" class="btn btn-light">
            <a class="text-dark" href="events?id=<?php echo $id_event['id_event']?>&type=modify">
                <i class="uil uil-setting"></i>
            </a>
        </button>

        <button type="button" class="btn btn-light ms-2" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteModal(<?php echo $id_event['id_event']?>)">
            <i class="uil uil-trash-alt"></i>
        </button>
    </td>
    
    

    </tr>
<?php endforeach; ?>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="deleteModalLabel">Confirmation</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Êtes-vous sûr de vouloir supprimer cet événement?
        </div>
        <div class="modal-footer">
            <button id="delete-event-btn" type="button" class="btn btn-danger">Supprimer</button>
            <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #c6c6c6; color: white">Annuler</button>
        </div>
        </div>
    </div>
</div>
