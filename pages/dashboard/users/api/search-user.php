<?php
include '../../../connect_db.php';

if(isset($_GET['name']) && !empty($_GET['name'])) {
    $name = $_GET['name'];

    $q = "SELECT * FROM USERS WHERE (first_name LIKE ? OR last_name LIKE ?)";
    $req = $bdd->prepare($q);
    $success = $req->execute([
        '%' . $name . '%',
        '%' . $name . '%'
    ]);

    if($success) {
        $result = $req -> fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $id_client) { ?>
            <tr>
                <?php if ($id_client['user_type'] == "Admin") {
                    echo '<td><i class="uil uil-user-md"></i></td>';
                } else {
                    echo '<td>' .  htmlspecialchars($id_client['id_client']). '</td>';
                }
                echo '<td>' .  htmlspecialchars($id_client['first_name']) . '</td>';
                echo '<td>' .  htmlspecialchars($id_client['last_name']) . '</td>';
                echo '<td>' .  htmlspecialchars($id_client['email']) . '</td>';
                echo '<td class="d-flex justify-content-center"><a class="button hover-effect" href="users.php?id='. $id_client['id_client'] . 
                '&type=modify"><i class="uil uil-setting"></i></a>';
                echo ' <a class="button hover-effect" href="users.php?id=' . $id_client['id_client'] . 
                '&type=delete" onclick="return confirm(\'Êtes-vous sûr de vouloir le supprimer ?\');"><i class="uil uil-trash-alt"></i></a></td>'; ?>
            </tr>
<?php  }
    } 
}
if (empty($_GET['name'])) {
    $q = 'SELECT * FROM USERS';
    $req = $bdd->query($q);
    $result = $req -> fetchAll(PDO::FETCH_ASSOC);

    foreach($result as $id_client) { ?>
        <tr>
            <?php if ($id_client['user_type'] == "Admin") {
                echo '<td><i class="uil uil-user-md"></i></td>';
            } else {
                echo '<td>' .  htmlspecialchars($id_client['id_client']). '</td>';
            }
            echo '<td>' .  htmlspecialchars($id_client['first_name']) . '</td>';
            echo '<td>' .  htmlspecialchars($id_client['last_name']) . '</td>';
            echo '<td>' .  htmlspecialchars($id_client['email']) . '</td>';
            echo '<td class="d-flex justify-content-center"><a class="button hover-effect" href="users.php?id='. $id_client['id_client'] . 
            '&type=modify"><i class="uil uil-setting"></i></a>';
            echo ' <a class="button hover-effect" href="users.php?id=' . $id_client['id_client'] . 
            '&type=delete" onclick="return confirm(\'Êtes-vous sûr de vouloir le supprimer ?\');"><i class="uil uil-trash-alt"></i></a></td>'; ?>
        </tr>
<?php }  
} ?>
