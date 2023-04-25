<?php
include '../../connect_db.php';

$q = 'SELECT * FROM USERS';
$req = $bdd->query($q);
$result = $req -> fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Alter table -->
<?php if (isset($_GET['type']) && isset($_GET['id']) && $_GET['type'] == 'modify') : ?>
    <?php foreach($result as $id_client) {
            if($_GET['id'] ==  $id_client['id_client']) : ?>
                <tr>
                    <form method="POST" action="user-update" enctype="multipart/form-data">
                        <td>
                            <select class="form-control" id="user-type-select"  name="user_type">
                                <?php echo '<option value="' . htmlspecialchars($id_client['user_type']) . '">' . $id_client['user_type'] . "</option>'";
                                    if ($id_client['user_type'] == "Normal") : ?>
                                        <option value="Admin">Admin</option>
                                    <?php else : ?>
                                        <option value="Normal">Normal</option>
                                    <?php endif;?>
                            </select>
                        </td>
                        <?php
                        echo '<td><input class="update-input form-control" name="first_name" value="' . htmlspecialchars($id_client['first_name']) . '"></td>';
                        echo '<td><input class="update-input form-control" name="last_name" value="'. htmlspecialchars($id_client['last_name']). '"></td>';
                        echo '<td><input class="update-input form-control" name="email" value="'. htmlspecialchars($id_client['email']). '"></td>'; ?>
                        <td >
                            <?php echo '<input type="hidden" name="id" value="' . htmlspecialchars($id_client['id_client']) . '">'; ?>
                            <input class="btn btn-danger" type="submit" value="Modifier" onclick="return confirm('Appliquer les modifications ?');">
                            <a class="btn btn-danger" href="users.php" onclick="return confirm('Êtes-vous sûr de vouloir annuler ?');">Annuler</a>
                        </td>
                    </form>
                </tr>
            <?php endif; } ?>

<!-- Create Table -->
<?php elseif (isset($_GET['type']) && $_GET['type'] == 'create') : ?>
    <tr>
        <form method="POST" action="user-create" enctype="multipart/form-data">
            <td><input class="update-input form-control" name="first_name"></td>
            <td><input class="update-input form-control" name="last_name"></td>
            <td><input class="update-input form-control" name="email"></td>
            <td><input class="update-input form-control" type="password" name="password"></td>
            <td><input class="btn btn-danger" type="submit" value="Ajouter" onclick="return confirm('Ajouter ?');">
            <a class="btn btn-danger" href="users.php" onclick="return confirm('Êtes-vous sûr de vouloir annuler ?');">Annuler</a></td>
        </form>
    </tr>

<!-- Display Table -->
<?php else :?>
    <?php foreach($result as $id_client) { ?>
        <tr>
            <?php if ($id_client['user_type'] == "Admin") {
                echo '<td><i class="uil uil-user-md"></i></td>';
            } else {
                echo '<td>' .  htmlspecialchars($id_client['id_client']). '</td>';
            }
            echo '<td>' .  htmlspecialchars($id_client['first_name']) . '</td>';
            echo '<td>' .  htmlspecialchars($id_client['last_name']) . '</td>';
            echo '<td>' .  htmlspecialchars($id_client['email']) . '</td>';
            echo '<td><a class="button hover-effect" href="users.php?id='. $id_client['id_client'] . 
            '&type=modify"><i class="uil uil-setting"></i></a>';
            echo ' <a class="button hover-effect" href="users.php?id=' . $id_client['id_client'] . 
            '&type=delete" onclick="return confirm(\'Êtes-vous sûr de vouloir le supprimer ?\');"><i class="uil uil-trash-alt"></i></a></td>'; ?>
        </tr>
<?php } endif; ?>

    


