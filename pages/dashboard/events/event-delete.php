<?php
include '../../connect_db.php';

if (isset($_GET['id']) && $_GET['type'] == 'delete') {
    $id = $_GET['id'];
    $q = "SELECT image FROM EVENT WHERE id_event = $id";
    $req = $bdd->query($q);
    $result = $req->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $file_src = $result['image'];
        unlink($file_src);
    }
    
    $q = "DELETE FROM TICKET WHERE id_event = $id";
    $req = $bdd->prepare($q);
    $req->execute();

    $q = "DELETE FROM EVENT WHERE id_event = $id";
    $req = $bdd->prepare($q);
    $req->execute();
  
}
