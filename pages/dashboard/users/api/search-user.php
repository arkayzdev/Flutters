<?php
include '../../../connect_db.php';

if(isset($_GET['name']) && !empty($_GET['name'])) {
    $name = $_GET['name'];

    $q = "SELECT * FROM USERS WHERE (first_name LIKE ? OR last_name LIKE ?)";
    $req = $bdd->prepare($q);
    $req->execute([
        '%' . $name . '%',
        '%' . $name . '%'
    ]);
    $result = $req -> fetchAll(PDO::FETCH_ASSOC);
}

if (empty($_GET['name'])) {
    $q = 'SELECT * FROM USERS';
    $req = $bdd->query($q);
    $result = $req -> fetchAll(PDO::FETCH_ASSOC);
}

foreach($result as $id_client) : ?>
    <tr>
        <?php if ($id_client['user_type'] == "Admin") {
            echo '<td><i class="uil uil-user-md"></i></td>';
        } else {
            echo '<td>' .  htmlspecialchars($id_client['id_client']). '</td>';
        }
        echo '<td>' .  htmlspecialchars($id_client['first_name']) . '</td>';
        echo '<td>' .  htmlspecialchars($id_client['last_name']) . '</td>';
        echo '<td>' .  htmlspecialchars($id_client['email']) . '</td>'; ?>
        <td>
        <button type="button" class="btn btn-light">
            <a class="text-dark" href="users?id=<?php echo $id_client['id_client']?>&type=modify">
                <i class="uil uil-setting"></i>
            </a>
        </button>

        <button type="button" class="btn btn-light ms-2" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteModal(<?php echo $id_client['id_client']?>)">
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
                Êtes-vous sûr de vouloir supprimer cet acteur ?
            </div>
            <div class="modal-footer">
                <button id="delete-user-btn" type="button" class="btn btn-danger">Supprimer</button>
                <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #c6c6c6; color: white">Annuler</button>
            </div>
            </div>
        </div>
    </div>
    
