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
                        echo '<td><input class="update-input form-control" name="first_name" value="' . htmlspecialchars($id_actor['first_name']) . '"></td>';
                        echo '<td><input class="update-input form-control" name="last_name" value="'. htmlspecialchars($id_actor['last_name']). '"></td>';?>
                        <td >
                            <?php echo '<input type="hidden" name="id" value="' . $id_actor['id_actor'] . '">'; ?>
                            <input class="btn btn-danger" type="submit" value="Modifier" onclick="return confirm('Appliquer les modifications ?');">
                            <a class="btn btn-danger" href="actors" onclick="return confirm('Êtes-vous sûr de vouloir annuler ?');">Annuler</a>
                        </td>
                    </form>
                </tr>
            <?php endif; } ?>

<!-- Create Table -->
<?php elseif (isset($_GET['type']) && $_GET['type'] == 'create') : ?>
    <tr>
        <form method="POST" action="actor-create" enctype="multipart/form-data">
            <td><input class="update-input form-control" name="first_name"></td>
            <td><input class="update-input form-control" name="last_name"></td>
            <td><input class="btn btn-danger" type="submit" value="Ajouter" onclick="return confirm('Ajouter ?');">
            <a class="btn btn-danger" href="actors" onclick="return confirm('Êtes-vous sûr de vouloir annuler ?');">Annuler</a></td>
        </form>
    </tr>

<!-- Display Table -->
<?php else :?>
    <?php foreach($result as $id_actor) { ?>
        <tr>
            <?php 
            echo '<td>' .  htmlspecialchars($id_actor['id_actor']). '</td>';
            echo '<td>' .  htmlspecialchars($id_actor['first_name']) . '</td>';
            echo '<td>' .  htmlspecialchars($id_actor['last_name']) . '</td>';
            echo '<td class="d-flex justify-content-center"><a class="button hover-effect" href="actors?id='. $id_actor['id_actor'] . 
            '&type=modify"><i class="uil uil-setting"></i></a>';
            echo ' <a class="button hover-effect" href="actors?id=' . $id_actor['id_actor'] . 
            '&type=delete" onclick="return confirm(\'Êtes-vous sûr de vouloir le supprimer ? Les acteurs seront aussi supprimés des films !\');"><i class="uil uil-trash-alt"></i></a></td>'; ?>
        </tr>
<?php } endif; ?>

    


