<?php
include '../../connect_db.php';

if (isset($_GET['id']) && $_GET['type'] == 'delete') {
    $id = $_GET['id'];
    $q = "SELECT poster_image FROM MOVIE WHERE id_movie = $id";
    $req = $bdd->query($q);
    $result = $req->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $file_src = $result['poster_image'];
        if (is_file($file_src)) {
            unlink($file_src);
        } 
    }

    $q = "SELECT id_session FROM TAKE_PLACE WHERE id_movie= $id";
    $req = $bdd->prepare($q);
    $req->execute();
    $sessions = $req->fetchAll(PDO::FETCH_ASSOC);
    
    $q = "DELETE FROM SESSION WHERE id_session = ?";
    $req = $bdd->prepare($q);
    foreach ($sessions as $session) {
        $req->execute([$session['id_session']]);
    }
    
    $q = "DELETE FROM TAKE_PLACE WHERE id_movie= $id";
    $req = $bdd->prepare($q);
    $req->execute();

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
    
    $q = "DELETE FROM REVIEW WHERE id_movie= $id";
    $req = $bdd->prepare($q);
    $req->execute();
    

    $q = "DELETE FROM MOVIE WHERE id_movie= $id";
    $req = $bdd->prepare($q);
    $req->execute();

   
}
