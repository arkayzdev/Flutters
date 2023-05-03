<?php
include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");

$email = $_GET['email'];
$id = $_GET['id'];

$q = 'SELECT * FROM REVIEW WHERE id_client = (SELECT id_client FROM USERS WHERE email = :email) AND id_movie=:id';
$req = $bdd->prepare($q);
$reponse = $req->execute([
    'email' => $email,
    'id' => $id
]);
$result = $req -> fetchAll(PDO::FETCH_ASSOC);

$str_star = $result[0]['score'];
$description = $result[0]['description'];

echo '
    <div class="d-flex justify-content-between"> 
    <h3>Mon Commentaire</h3>
    <p></p>
    </div>
    <div></div>
    <div>
        <input style="display:none;" id="comment_stars_value" type="number" min="1" max="5" value="' . $str_star . '">
';

        for($i=0;$i<$str_star;$i++){
            echo '<button onclick="comment_stars_value(this.value)" class="comment_stars" value="' . ($i+1) . '" style="color:red;"><i class="uis uis-favorite"></i></button>';
        };
        for($i=$str_star;$i<5;$i++){
            echo '<button onclick="comment_stars_value(this.value)" class="comment_stars" value="' . ($i+1) . '" style="color:lightgrey;"><i class="uis uis-favorite"></i></button>';
        };

echo'
    </div>

    <textarea id="comment_stars_description" maxlength="350" rows="6">' . $description . '</textarea>
    <p>Description limité à 350 caractères</p>



    <button onclick="my_comment_modify_send(\'' . $email . '\', \'' . $id . '\')" class="btn align-self-end film_modify_button" style="width:7.2em;"> Mettre à jour </button>
';
