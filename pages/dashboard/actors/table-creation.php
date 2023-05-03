<?php
include '../../connect_db.php';

$q = 'SELECT * FROM ACTOR';
$req = $bdd->query($q);
$result = $req -> fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Alter table -->
<?php if (isset($_GET['type']) && isset($_GET['id']) && $_GET['type'] == 'modify') : ?>
    <?php foreach($result as $id_actor) {
            if($_GET['id'] ==  $id_actor['id_actor']) : ?>
                <tr>
                    <form method="POST" action="actor-update" enctype="multipart/form-data">
                        <?php
                        echo '<td><input class="update-input form-control" name="first_name" value="' . htmlspecialchars($id_actor['first_name'],  ENT_QUOTES) . '" required></td>';
                        echo '<td><input class="update-input form-control" name="last_name" value="'. htmlspecialchars($id_actor['last_name'],  ENT_QUOTES). '" required></td>';?>
                        <td >
                            <?php echo '<input type="hidden" name="id" value="' . $id_actor['id_actor'] . '">'; ?>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#alterModal">
                                Confirmer
                            </button>
                            <button type="button" class="btn" style="background-color: #c6c6c6;">
                                <a class="text-light" href="actors">Annuler</a> 
                            </button>
                        </td>
                    <!-- Modal -->
                    <div class="modal fade" id="alterModal" tabindex="-1" aria-labelledby="alterModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="alterModalLabel">Confirmation</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                               Êtes-vous sûr de vouloir modifier cet acteur ?
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Modifier</button>
                                <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #c6c6c6; color: white">Fermer</button>
                            </div>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </tr>
            <?php endif; } ?>

<!-- Create Table -->
<?php elseif (isset($_GET['type']) && $_GET['type'] == 'create') : ?>
    <tr>
        <form method="POST" action="actor-create" enctype="multipart/form-data">
            <td><input class="update-input form-control" name="first_name" required></td>
            <td><input class="update-input form-control" name="last_name" required></td>
            <td>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#createModal">
                Confirmer
            </button>
            <button type="button" class="btn" style="background-color: #c6c6c6;">
                <a class="text-light" href="actors">Annuler</a> 
            </button>
            </td>
            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="createModalLabel">Confirmation</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir créer cet acteur ?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Créer</button>
                        <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #c6c6c6; color: white">Fermer</button>
                    </div>
                    </div>
                </div>
            </div>
        </form>
    </tr>

   

<!-- Display Table -->
<?php else :?>
    <?php foreach($result as $id_actor) : ?>
        <tr>
            <?php
            echo '<td>' .  $id_actor['id_actor']. '</td>';
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
<?php endif; ?>


    



                            