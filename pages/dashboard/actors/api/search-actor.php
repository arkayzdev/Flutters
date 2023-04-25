<?php
include '../../../connect_db.php';

if(isset($_GET['name']) && !empty($_GET['name'])) {
    $name = $_GET['name'];

    $q = "SELECT * FROM ACTOR WHERE (first_name LIKE ? OR last_name LIKE ?)";
    $req = $bdd->prepare($q);
    $success = $req->execute([
        '%' . $name . '%',
        '%' . $name . '%'
    ]);

    if($success) {
        $result = $req -> fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $id_actor) : ?>
            <tr>
            <?php
            echo '<td>' .  htmlspecialchars($id_actor['id_actor']). '</td>';
            echo '<td>' .  htmlspecialchars($id_actor['first_name']) . '</td>';
            echo '<td>' .  htmlspecialchars($id_actor['last_name']) . '</td>'; ?>
            <td class="d-flex justify-content-center">
                <button type="button" class="btn btn-light">
                    <a class="text-dark" href="actors?id=<?php echo $id_actor['id_actor']?>&type=modify">
                        <i class="uil uil-setting"></i>
                    </a>
                </button>
                
                <button type="button" class="btn btn-light ms-2" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteModal(<?php echo $id_actor['id_actor']?>)">
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
                        Êtes-vous sûr de vouloir supprimer cet acteur ?
                    </div>
                    <div class="modal-footer">
                        <button id="delete-actor-btn" type="button" class="btn btn-danger">Supprimer</button>
                        <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #c6c6c6; color: white">Annuler</button>
                    </div>
                    </div>
                </div>
            </div>
    <?php }
    } 

if (empty($_GET['name'])) {
    $q = 'SELECT * FROM ACTOR';
    $req = $bdd->query($q);
    $result = $req -> fetchAll(PDO::FETCH_ASSOC);

    foreach($result as $id_actor) : ?>
       <tr>
            <?php
            echo '<td>' .  htmlspecialchars($id_actor['id_actor']). '</td>';
            echo '<td>' .  htmlspecialchars($id_actor['first_name']) . '</td>';
            echo '<td>' .  htmlspecialchars($id_actor['last_name']) . '</td>'; ?>
            <td class="d-flex justify-content-center">
                <button type="button" class="btn btn-light">
                    <a class="text-dark" href="actors?id=<?php echo $id_actor['id_actor']?>&type=modify">
                        <i class="uil uil-setting"></i>
                    </a>
                </button>
                
                <button type="button" class="btn btn-light ms-2" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteModal(<?php echo $id_actor['id_actor']?>)">
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
                        Êtes-vous sûr de vouloir supprimer cet acteur ?
                    </div>
                    <div class="modal-footer">
                        <button id="delete-actor-btn" type="button" class="btn btn-danger">Supprimer</button>
                        <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #c6c6c6; color: white">Annuler</button>
                    </div>
                    </div>
                </div>
            </div>
<?php } 
?>
