<?php
    include '../../connect_db.php';

    if (isset($_GET['id']) && $_GET['type'] == 'delete') {
            $id = $_GET['id'];
            $q = "DELETE FROM WEARS WHERE id_client= $id";
            $req = $bdd->prepare($q);
            $req->execute();

            $q = "DELETE FROM REVIEW WHERE id_client= $id";
            $req = $bdd->prepare($q);
            $req->execute();

            $q = "DELETE FROM TICKET WHERE order_id IN (SELECT order_id FROM ORDERS WHERE id_client = $id)";
            $req = $bdd->prepare($q);
            $req->execute();

            $q = "DELETE FROM PAYMENT WHERE id IN (SELECT order_id FROM ORDERS WHERE id_client = $id);";
            $req = $bdd->prepare($q);
            $req->execute();

            $q = "DELETE FROM ORDERS WHERE id_client = $id;";
            $req = $bdd->prepare($q);
            $req->execute();

            $q = "DELETE FROM USERS WHERE id_client= $id";
            $req = $bdd->prepare($q);
            $req->execute();
    } 
?>
   