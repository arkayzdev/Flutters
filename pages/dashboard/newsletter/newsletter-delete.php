<?php
    include '../../connect_db.php';

    if (isset($_GET['id']) && $_GET['type'] == 'delete') {
            $id = $_GET['id'];
            $q = "DELETE FROM NEWSLETTER WHERE email = :email";
            $req = $bdd->prepare($q);
            $req->execute([
                'email' => $id,
            ]);
    } 
?>
   