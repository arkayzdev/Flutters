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
        foreach($result as $id_actor) { ?>
            <tr>
                <?php 
                echo '<td>' .  htmlspecialchars($id_actor['id_actor']). '</td>';
                echo '<td>' .  htmlspecialchars($id_actor['first_name']) . '</td>';
                echo '<td>' .  htmlspecialchars($id_actor['last_name']) . '</td>';
                echo '<td class="d-flex justify-content-center"><a class="button hover-effect" href="actors?id='. $id_actor['id_actor'] . 
                '&type=modify"><i class="uil uil-setting"></i></a>';
                echo ' <a class="button hover-effect" href="actors?id=' . $id_actor['id_actor'] . 
                '&type=delete" onclick="return confirm(\'Êtes-vous sûr de vouloir le supprimer ?\');"><i class="uil uil-trash-alt"></i></a></td>'; ?>
            </tr>
    <?php }
    } 
}
if (empty($_GET['name'])) {
    $q = 'SELECT * FROM ACTOR';
    $req = $bdd->query($q);
    $result = $req -> fetchAll(PDO::FETCH_ASSOC);

    foreach($result as $id_actor) { ?>
        <tr>
            <?php 
            echo '<td>' .  htmlspecialchars($id_actor['id_actor']). '</td>';
            echo '<td>' .  htmlspecialchars($id_actor['first_name']) . '</td>';
            echo '<td>' .  htmlspecialchars($id_actor['last_name']) . '</td>';
            echo '<td class="d-flex justify-content-center"><a class="button hover-effect" href="actors?id='. $id_actor['id_actor'] . 
            '&type=modify"><i class="uil uil-setting"></i></a>';
            echo ' <a class="button hover-effect" href="actors?id=' . $id_actor['id_actor'] . 
            '&type=delete" onclick="return confirm(\'Êtes-vous sûr de vouloir le supprimer ?\');"><i class="uil uil-trash-alt"></i></a></td>'; ?>
        </tr>
<?php } 
} ?>
