<?php
include '../../connect_db.php';

$q = 'SELECT * FROM TYPE';
$req = $bdd->query($q);
$result = $req -> fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Alter table -->
<?php if (isset($_GET['type']) && isset($_GET['id']) && $_GET['type'] == 'modify') : ?>
    <?php foreach($result as $id_type) {
            if($_GET['id'] ==  $id_type['id_type']) : ?>
                <tr>
                    <form method="POST" action="movie-type-update" enctype="multipart/form-data">
                        <?php
                        echo '<td><input class="update-input form-control" name="name" value="' . htmlspecialchars($id_type['name']) . '"></td>';?>
                        <td >
                            <?php echo '<input type="hidden" name="id" value="' . $id_type['id_type'] . '">'; ?>
                            <input class="btn btn-danger" type="submit" value="Modifier" onclick="return confirm('Appliquer les modifications ?');">
                            <a class="btn btn-danger" href="movie-type" onclick="return confirm('Êtes-vous sûr de vouloir annuler ?');">Annuler</a>
                        </td>
                    </form>
                </tr>
            <?php endif; } ?>

<!-- Create Table -->
<?php elseif (isset($_GET['type']) && $_GET['type'] == 'create') : ?>
    <tr>
        <form method="POST" action="movie-type-create" enctype="multipart/form-data">
            <td><input class="update-input form-control" name="name"></td>
            <td><input class="btn btn-danger" type="submit" value="Ajouter" onclick="return confirm('Ajouter ?');">
            <a class="btn btn-danger" href="movie-type" onclick="return confirm('Êtes-vous sûr de vouloir annuler ?');">Annuler</a></td>
        </form>
    </tr>

<!-- Display Table -->
<?php else :?>
    <?php foreach($result as $id_type) { ?>
        <tr>
            <?php 
            echo '<td>' .  htmlspecialchars($id_type['id_type']). '</td>';
            echo '<td>' .  htmlspecialchars($id_type['name']) . '</td>';
            echo '<td class="d-flex justify-content-center"><a class="button hover-effect" href="movie-type?id='. $id_type['id_type'] . 
            '&type=modify"><i class="uil uil-setting"></i></a>';
            echo ' <a class="button hover-effect" href="movie-type?id=' . $id_type['id_type'] . 
            '&type=delete" onclick="return confirm(\'Êtes-vous sûr de vouloir le supprimer ? Les genres seront aussi supprimés des films !\');"><i class="uil uil-trash-alt"></i></a></td>'; ?>
        </tr>
<?php } endif; ?>

    


