<?php
include '../../connect_db.php';

if (isset($_GET['id']) && $_GET['type'] == 'delete') {
    $id = $_GET['id'];
    
    $q = "SET FOREIGN_KEY_CHECKS=0;";
    $req = $bdd->prepare($q);
    $req->execute();

    $q = "DELETE FROM TAKE_PLACE WHERE id_session= $id";
    $req = $bdd->prepare($q);
    $req->execute();

    $q = "DELETE FROM PAYMENT WHERE id_session= $id";
    $req = $bdd->prepare($q);
    $req->execute();

    $q = "DELETE FROM ORDERS WHERE order_id IN (SELECT order_id FROM TICKET WHERE id_session = $id)";
    $req = $bdd->prepare($q);
    $req->execute();

    $q = "DELETE FROM TICKET WHERE id_session= $id";
    $req = $bdd->prepare($q);
    $req->execute();

    $q = "DELETE FROM SESSION WHERE id_session= $id";
    $req = $bdd->prepare($q);
    $req->execute();

    $q = "SET FOREIGN_KEY_CHECKS=1;";
    $req = $bdd->prepare($q);
    $req->execute();
}
