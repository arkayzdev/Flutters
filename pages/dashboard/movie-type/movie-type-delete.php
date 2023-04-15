<?php
    include '../../connect_db.php';

    if (isset($_GET['id']) && $_GET['type'] == 'delete') {
            $id = $_GET['id'];
            $q = "DELETE FROM IS_TO WHERE id_type= $id";
            $req = $bdd->prepare($q);
            $req->execute();

            $q = "DELETE FROM TYPE WHERE id_type= $id";
            $req = $bdd->prepare($q);
            $req->execute();
    } 
?>
   