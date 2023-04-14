<?php
include '../../connect_db.php';

if (isset($_GET['id']) && $_GET['type'] == 'delete') {
    $id = $_GET['id'];

    $q = "DELETE FROM IS_TO WHERE id_movie= $id";
    $req = $bdd->prepare($q);
    $req->execute();

    $q = "DELETE FROM PLAYED WHERE id_movie= $id";
    $req = $bdd->prepare($q);
    $req->execute();

    $q = "DELETE FROM REALIZED WHERE id_movie= $id";
    $req = $bdd->prepare($q);
    $req->execute();

    $q = "DELETE FROM MOVIE WHERE id_movie= $id";
    $req = $bdd->prepare($q);
    $req->execute();
}
