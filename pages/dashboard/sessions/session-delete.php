<?php
include '../../connect_db.php';

if (isset($_GET['id']) && $_GET['type'] == 'delete') {
    $id = $_GET['id'];
    $q = "SELECT poster_image FROM MOVIE WHERE id_movie = $id";
    $req = $bdd->query($q);
    $result = $req->fetch(PDO::FETCH_ASSOC);
    $file_src = $result['poster_image'];
    unlink($file_src);

    $q = "DELETE FROM IS_TO WHERE id_movie= $id";
    $req = $bdd->prepare($q);
    $req->execute();

    $q = "DELETE FROM PLAYED WHERE id_movie= $id";
    $req = $bdd->prepare($q);
    $req->execute();

    $q = "DELETE FROM REALIZED WHERE id_movie= $id";
    $req = $bdd->prepare($q);
    $req->execute();

    $q = "DELETE FROM IN_LANGUAGE WHERE id_movie= $id";
    $req = $bdd->prepare($q);
    $req->execute();

    $q = "DELETE FROM MOVIE WHERE id_movie= $id";
    $req = $bdd->prepare($q);
    $req->execute();
}
