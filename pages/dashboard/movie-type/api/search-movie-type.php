<?php
include '../../../connect_db.php';

if(isset($_GET['name']) && !empty($_GET['name'])) {
    $name = trim($_GET['name']);

    $q = "SELECT * FROM TYPE WHERE name LIKE ?";
    $req = $bdd->prepare($q);
    $req->execute([
        '%' . $name . '%',
    ]);
    $result = $req -> fetchAll(PDO::FETCH_ASSOC);
}
    
if (empty($_GET['name'])) {
    $q = 'SELECT * FROM TYPE';
    $req = $bdd->query($q);
    $result = $req -> fetchAll(PDO::FETCH_ASSOC);
}

foreach($result as $id_type) : ?>
    <tr>
        <?php 
        echo '<td>' .  htmlspecialchars($id_type['id_type']). '</td>';
        echo '<td>' .  htmlspecialchars($id_type['name']) . '</td>'; ?>
        <td class="d-flex justify-content-center">
            <button type="button" class="btn btn-light">
                <a class="text-dark" href="movie-type?id=<?php echo $id_type['id_type']?>&type=modify">
                    <i class="uil uil-setting"></i>
                </a>
            </button>

            <button type="button" class="btn btn-light ms-2" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteModal(<?php echo $id_type['id_type']?>)">
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
                Êtes-vous sûr de vouloir supprimer ce genre ?
            </div>
            <div class="modal-footer">
                <button id="delete-movie-type-btn" type="button" class="btn btn-danger">Supprimer</button>
                <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #c6c6c6; color: white">Annuler</button>
            </div>
            </div>
        </div>
    </div>  