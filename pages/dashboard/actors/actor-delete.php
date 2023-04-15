<?php
    include '../../connect_db.php';

    if (isset($_GET['id']) && $_GET['type'] == 'delete') {
            $id = $_GET['id'];
            $q = "DELETE FROM PLAYED WHERE id_actor= $id";
            $req = $bdd->prepare($q);
            $req->execute();

            $q = "DELETE FROM ACTOR WHERE id_actor= $id";
            $req = $bdd->prepare($q);
            $req->execute();
    } 
?>
   