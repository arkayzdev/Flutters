<?php
    include '../../connect_db.php';

    if (isset($_GET['id']) && $_GET['type'] == 'delete') {
            $id = $_GET['id'];
            $q = "DELETE FROM USERS WHERE id_client= $id";
            $req = $bdd->prepare($q);
            $req->execute();
    } 
?>
   