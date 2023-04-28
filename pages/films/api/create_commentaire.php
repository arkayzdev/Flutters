<?php
    // $nb_star=5;
    // $str_star="";
    // for($j=0; $j<$nb_star; $j++){
    //     $str_star = $str_star . '<i class="uil uil-favorite"></i>';
    // };
    // $name = "Franck.Z";
    // $comment = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin nisi turpis, pulvinar eu sollicitudin eget, varius tristique justo. Nulla facilisi. Proin sit amet orci felis. Suspendisse potenti. Praesent ac dignissim nunc, et vulputate dui. Aenean aliquam, ipsum sed pulvinar dignissim, orci lacus tempor sem, ac elementum arcu diam vel tortor. Vivamus mi arcu, ultricies a sapien quis, varius posuere nunc. Vestibulum et euismod ligula. Vivamus venenatis mollis est et vulputate. Mauris suscipit, urna at feugiat volutpat, erat metus viverra arcu, auctor volutpat dolor lectus non eros. Ut accumsan vulputate libero, eget fringilla dui ultrices non. Etiam egestas odio quis lectus.";

    // for($i=0; $i<3; $i++){
    // echo '
    //     <div  id="film_comment_content">
    //         <h3>' . $name . '</h3>
    //         <div>' . $str_star . '</div>
    //         <p>' . $comment . '</p>
    //     </div>
    // ';}

    include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");

    if(isset($_COOKIE['id'])){
        $id = $_COOKIE['id'];
    } else {
        $id = $_GET['id'];
    }
    if(isset($_GET['all']) && isset($_COOKIE['email'])){
        echo 'op1';
        $email = $_COOKIE['email'];
    } elseif (isset($_SESSION['email'])) {
        echo 'op2';
        $email = $_SESSION['email'];
    } else {
        echo 'op3';
        $email = "";
    }
echo $email;


    echo $id;
    echo '_____________________________________________________________________';
    echo $email;
    echo '________________________________________a_____';


    $q = 'SELECT * FROM REVIEW WHERE id_client = (SELECT id_client FROM USERS WHERE email = :email) AND id_movie = :id';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'email' => $email,
        'id' => $id
    ]);
    $own_comment = $req -> fetchAll(PDO::FETCH_ASSOC);
    var_dump($own_comment);
    echo '_____________________________________________';

    $q = 'SELECT * FROM REVIEW WHERE id_movie = :id AND id_client != (SELECT id_client FROM USERS WHERE email = :email) ORDER BY publication_date DESC LIMIT 3';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'email' => $email,
        'id' => $id
    ]);
    $first_comments = $req -> fetchAll(PDO::FETCH_ASSOC);
    var_dump($first_comments);
    echo '_____________________________________________';


    $q = 'SELECT * FROM REVIEW WHERE id_movie = :id AND id_client != (SELECT id_client FROM USERS WHERE email = :email) ORDER BY publication_date DESC';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'email' => $email,
        'id' => $id
    ]);
    $all_comments = $req -> fetchAll(PDO::FETCH_ASSOC);
    var_dump($all_comments);


    if($own_comment){

        $str_star="";
        for($j=0; $j<$own_comment[0]['score']; $j++){
            $str_star = $str_star . '<i class="uil uil-favorite"></i>';
        };

        echo '
        
            <div  id="film_comment_my_content">
                <div class="d-flex justify-content-between"> 
                <h3>Mon Commentaire</h3>
                <p style="color: grey; font-weight:500; margin:0;">' . strftime("%d %B %Y", strtotime($own_comment[0]['publication_date'] )). '</p>
                </div>

                <div>' . $str_star . '</div>
                <p style="color:darkslategrey!important">' . $own_comment[0]['description'] . '</p>
                <button class="btn film_modify_button"> Modifier </button>
            </div>
        ';
    } 
    
    if(!isset($_GET['all'])) {
        echo 'FIRST COMMENT';
        foreach($first_comments as $comment) { 

            $q = 'SELECT first_name,last_name FROM USERS WHERE email = :email';
            $req = $bdd->prepare($q);
            $reponse = $req->execute([
                'email' => $email,
            ]);
            $result = $req -> fetch(PDO::FETCH_ASSOC);

            $str_star="";
            for($j=0; $j<$comment['score']; $j++){
                $str_star = $str_star . '<i class="uil uil-favorite"></i>';
            };

            echo '
            
                <div  id="film_comment_content">
                    <div class="d-flex justify-content-between"> 
                        <h3>' . $result['first_name'] . ' ' . $result['last_name']  . '</h3>
                        <p style="color: grey; font-weight:500; margin:0;">' . strftime("%d %B %Y", strtotime($comment['publication_date'] )). '</p>
                    </div>

                    <div>' . $str_star . '</div>
                    <p>' . $comment['description'] . '</p>
                </div>
            ';
        }
    } elseif(isset($_GET['all'])) {
        echo 'ALL COMMENT';

        foreach($all_comments as $comment) { 

            $q = 'SELECT first_name,last_name FROM USERS WHERE email = :email';
            $req = $bdd->prepare($q);
            $reponse = $req->execute([
                'email' => $email,
            ]);
            $result = $req -> fetch(PDO::FETCH_ASSOC);

            $str_star="";
            for($j=0; $j<$comment['score']; $j++){
                $str_star = $str_star . '<i class="uil uil-favorite"></i>';
            };

            echo '
            
                <div  id="film_comment_content">
                    <div class="d-flex justify-content-between"> 
                        <h3>' . $result['first_name'] . ' ' . $result['last_name']  . '</h3>
                        <p style="color: grey; font-weight:500; margin:0;">' . strftime("%d %B %Y", strtotime($comment['publication_date'] )). '</p>
                    </div>
                    <div>' . $str_star . '</div>
                    <p>' . $comment['description'] . '</p>
                </div>
            ';
        }
    }

