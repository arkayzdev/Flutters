<?php
include("../connect_db.php");
$id = (int)$_POST['id'];
$head = $_POST['head'];
$eyes = $_POST['eyes'];
$mouth = $_POST['mouth'];
$outfit = $_POST['outfit'];

$q = "  SELECT COUNT(name), c.id_component FROM COMPONENT c
    INNER JOIN WEARS w on c.id_component = w.id_component
    INNER JOIN USERS U on w.id_client = U.id_client
    WHERE U.id_client = $id
    AND c.type = 'head'";
    $req = $bdd->query($q);
    $head_result = $req->fetch(PDO::FETCH_ASSOC); 
    $id_component = $head_result['id_component'];

if ($head == 'none') {
    if($head_result['COUNT(name)']) {
        $q = "DELETE FROM WEARS WHERE id_client = $id AND id_component = $id_component";
        $req = $bdd->prepare($q);
        $req->execute();
    }
} else {
    $q = "SELECT id_component FROM COMPONENT WHERE name = '$head'";
    $req = $bdd->query($q);
    $result = $req->fetch(PDO::FETCH_ASSOC);
    $head_id = (int)$result['id_component'];
    
    if($head_result['COUNT(name)']) {
        $q = "UPDATE WEARS SET id_component=$head_id WHERE id_client = $id AND id_component= $id_component";
        $req = $bdd->prepare($q);
        $req->execute();
    } else {
        $q = "INSERT INTO WEARS(id_component, id_client) VALUES ($head_id, $id)";
        $req = $bdd->prepare($q);
        $req->execute();
    }
}

$q = "  SELECT COUNT(name), c.id_component FROM COMPONENT c
    INNER JOIN WEARS w on c.id_component = w.id_component
    INNER JOIN USERS U on w.id_client = U.id_client
    WHERE U.id_client = $id
    AND c.type = 'eyes'";
    $req = $bdd->query($q);
    $eyes_result = $req->fetch(PDO::FETCH_ASSOC); 
    $id_component = $eyes_result['id_component'];

if ($eyes == 'none') {
    if($eyes_result['COUNT(name)']) {
        $q = "DELETE FROM WEARS WHERE id_client = $id AND id_component = $id_component";
        $req = $bdd->prepare($q);
        $req->execute();
    }
} else {
    $q = "SELECT id_component FROM COMPONENT WHERE name = '$eyes'";
    $req = $bdd->query($q);
    $result = $req->fetch(PDO::FETCH_ASSOC);
    $eyes_id = (int)$result['id_component'];
    
    if($eyes_result['COUNT(name)']) {
        $q = "UPDATE WEARS SET id_component = $eyes_id WHERE id_client = $id AND id_component= $id_component";
        $req = $bdd->prepare($q);
        $req->execute();
    } else {
        $q = "INSERT INTO WEARS(id_component, id_client) VALUES ($eyes_id, $id)";
        $req = $bdd->prepare($q);
        $req->execute();
    }
}

$q = "  SELECT COUNT(name), c.id_component FROM COMPONENT c
    INNER JOIN WEARS w on c.id_component = w.id_component
    INNER JOIN USERS U on w.id_client = U.id_client
    WHERE U.id_client = $id
    AND c.type = 'mouth'";
    $req = $bdd->query($q);
    $mouth_result = $req->fetch(PDO::FETCH_ASSOC); 
    $id_component = $mouth_result['id_component'];

if ($mouth == 'none') {
    if($mouth_result['COUNT(name)']) {
        $q = "DELETE FROM WEARS WHERE id_client = $id AND id_component = $id_component";
        $req = $bdd->prepare($q);
        $req->execute();
    }
} else {
    $q = "SELECT id_component FROM COMPONENT WHERE name = '$mouth'";
    $req = $bdd->query($q);
    $result = $req->fetch(PDO::FETCH_ASSOC);
    $mouth_id = (int)$result['id_component'];
    
    if($mouth_result['COUNT(name)']) {
        $q = "UPDATE WEARS SET id_component = $mouth_id WHERE id_client = $id AND id_component= $id_component";
        $req = $bdd->prepare($q);
        $req->execute();
    } else {
        $q = "INSERT INTO WEARS(id_component, id_client) VALUES ($mouth_id, $id)";
        $req = $bdd->prepare($q);
        $req->execute();
    }
}

$q = "  SELECT COUNT(name), c.id_component FROM COMPONENT c
    INNER JOIN WEARS w on c.id_component = w.id_component
    INNER JOIN USERS U on w.id_client = U.id_client
    WHERE U.id_client = $id
    AND c.type = 'outfit'";
    $req = $bdd->query($q);
    $outfit_result = $req->fetch(PDO::FETCH_ASSOC); 
    $id_component = $outfit_result['id_component'];

if ($outfit == 'none') {
    if($outfit_result['COUNT(name)']) {
        $q = "DELETE FROM WEARS WHERE id_client = $id AND id_component = $id_component";
        $req = $bdd->prepare($q);
        $req->execute();
    }
} else {
    $q = "SELECT id_component FROM COMPONENT WHERE name = '$outfit'";
    $req = $bdd->query($q);
    $result = $req->fetch(PDO::FETCH_ASSOC);
    $outfit_id = (int)$result['id_component'];
    
    if($outfit_result['COUNT(name)']) {
        $q = "UPDATE WEARS SET id_component = $outfit_id WHERE id_client = $id AND id_component= $id_component";
        $req = $bdd->prepare($q);
        $req->execute();
    } else {
        $q = "INSERT INTO WEARS(id_component, id_client) VALUES ($outfit_id, $id)";
        $req = $bdd->prepare($q);
        $req->execute();
    }
}

header('location: profile')

?>
