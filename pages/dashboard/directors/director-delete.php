<?php
    include '../../connect_db.php';

    if (isset($_GET['id']) && $_GET['type'] == 'delete') {
            $id = $_GET['id'];
            $q = "DELETE FROM REALIZED WHERE id_director= $id";
            $req = $bdd->prepare($q);
            $req->execute();

            $q = "DELETE FROM DIRECTOR WHERE id_director= $id";
            $req = $bdd->prepare($q);
            $req->execute();
    } 
?>
   