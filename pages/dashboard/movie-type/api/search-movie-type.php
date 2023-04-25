<?php
include '../../../connect_db.php';

if(isset($_GET['name']) && !empty($_GET['name'])) {
    $name = $_GET['name'];

    $q = "SELECT * FROM TYPE WHERE name LIKE ?";
    $req = $bdd->prepare($q);
    $success = $req->execute([
        '%' . $name . '%',
    ]);

    if($success) {
        $result = $req -> fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $id_type) { ?>
            <tr>
                <?php 
                echo '<td>' .  htmlspecialchars($id_type['id_type']). '</td>';
                echo '<td>' .  htmlspecialchars($id_type['name']) . '</td>';
                echo '<td class="d-flex justify-content-center"><a class="button hover-effect" href="movie-type?id='. $id_type['id_type'] . 
                '&type=modify"><i class="uil uil-setting"></i></a>';
                echo ' <a class="button hover-effect" href="movie-type?id=' . $id_type['id_type'] . 
                '&type=delete" onclick="return confirm(\'Êtes-vous sûr de vouloir le supprimer ? Les genres seront aussi supprimés des films !\');"><i class="uil uil-trash-alt"></i></a></td>'; ?>
            </tr>
    <?php }
    } 
}
if (empty($_GET['name'])) {
    $q = 'SELECT * FROM TYPE';
    $req = $bdd->query($q);
    $result = $req -> fetchAll(PDO::FETCH_ASSOC);

    foreach($result as $id_type) { ?>
        <tr>
            <?php 
            echo '<td>' .  htmlspecialchars($id_type['id_type']). '</td>';
            echo '<td>' .  htmlspecialchars($id_type['name']) . '</td>';
            echo '<td class="d-flex justify-content-center"><a class="button hover-effect" href="movie-type?id='. $id_type['id_type'] . 
            '&type=modify"><i class="uil uil-setting"></i></a>';
            echo ' <a class="button hover-effect" href="movie-type?id=' . $id_type['id_type'] . 
            '&type=delete" onclick="return confirm(\'Êtes-vous sûr de vouloir le supprimer ? Les genres seront aussi supprimés des films !\');"><i class="uil uil-trash-alt"></i></a></td>'; ?>
        </tr>
<?php }
} ?>
