<?php
    // echo '<pre>' . var_dump($first_comments, true) . '</pre>';
    include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");


    // Setups
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];
        } elseif(isset($_GET['email']) && $_GET['email'] != "") {
            $email = $_GET['email'];
        } else {
            $email = NULL;
        }
        $id = $_GET['id'];


    // Own comments 
        $q = 'SELECT * FROM REVIEW WHERE id_client = (SELECT id_client FROM USERS WHERE email = :email) AND id_movie = :id';
        $req = $bdd->prepare($q);
        $reponse = $req->execute([
            'email' => $email,
            'id' => $id
        ]);
        $own_comment = $req -> fetchAll(PDO::FETCH_ASSOC);

    // First comments
        if (is_null($email)) {
            $q = 'SELECT * FROM REVIEW WHERE id_movie = :id ORDER BY publication_date DESC LIMIT 3';
            $req = $bdd->prepare($q);
            $reponse = $req->execute([
                'id' => $id
            ]);
        }
        else {
            $q = 'SELECT * FROM REVIEW WHERE id_movie = :id AND id_client != (SELECT id_client FROM USERS WHERE email = :email) ORDER BY publication_date DESC LIMIT 3';
            $req = $bdd->prepare($q);
            $reponse = $req->execute([
                'email' => $email,
                'id' => $id
        ]);
        }
        $first_comments = $req -> fetchAll(PDO::FETCH_ASSOC);

    // All comments
        if (is_null($email)) {
            $q = 'SELECT * FROM REVIEW WHERE id_movie = :id  ORDER BY publication_date DESC';
            $req = $bdd->prepare($q);
            $reponse = $req->execute([
                'id' => $id
            ]);
        }
        else {
            $q = 'SELECT * FROM REVIEW WHERE id_movie = :id AND id_client != (SELECT id_client FROM USERS WHERE email = :email) ORDER BY publication_date DESC';
            $req = $bdd->prepare($q);
            $reponse = $req->execute([
                'email' => $email,
                'id' => $id
            ]);
        }
        $all_comments = $req -> fetchAll(PDO::FETCH_ASSOC);


    // Create commentaries
        // Own comment
        if($own_comment){

            $str_star="";
            for($j=0; $j<$own_comment[0]['score']; $j++){
                $str_star = $str_star . '<i class="uis uis-favorite"></i>';
            };
            for($j=$own_comment[0]['score']; $j<5; $j++){
                $str_star = $str_star . '<i style="color:lightgrey;" class="uis uis-favorite"></i>';
            };

            echo '
                <div id="film_comment_my_content">
                    <div class="d-flex justify-content-between"> 
                    <h3 class="ld_itema">Mon Commentaire</h3>
                    <p class="ld_itema" style="color: grey; font-weight:500; margin:0;">' . strftime("%d %B %Y", strtotime($own_comment[0]['publication_date'] )). '</p>
                    </div>

                    <div>' . $str_star . '</div>
                    <p class="ld_itema" style="color:darkslategrey!important">' . htmlspecialchars($own_comment[0]['description']) . '</p>
                    <button onclick="my_comment_modify(\'' . htmlspecialchars($email) . '\',\'' . htmlspecialchars($id) . '\')" class="btn align-self-end film_modify_button"> Modifier </button>
                </div>
            ';
        } else if(!$own_comment && !is_null($email)){
            echo '
                <div  id="film_comment_my_content">
                    <p></p><p></p>
                    <p style="color:grey!important">Vous n\'avez pas encore noté(e) ce film</p>
                    <button onclick="my_comment_create(\'' . htmlspecialchars($email) . '\',\'' . htmlspecialchars($id) . '\')" id="film_grade_button" class="btn film_modify_button"> Noter </button>
                </div>
            ';
        }
    
        // First comments
        if(!isset($_GET['all'])) {
        foreach($first_comments as $comment) { 

            $q = 'SELECT first_name,last_name FROM USERS WHERE id_client = :id_client';
            $req = $bdd->prepare($q);
            $reponse = $req->execute([
                'id_client' => $comment['id_client'],
            ]);
            $result = $req -> fetch(PDO::FETCH_ASSOC);

            $str_star="";
            for($j=0; $j<$comment['score']; $j++){
                $str_star = $str_star . '<i class="uis uis-favorite"></i>';
            };
            for($j=$comment['score']; $j<5; $j++){
                $str_star = $str_star . '<i style="color:lightgrey;" class="uis uis-favorite"></i>';
            };

            echo '
            
                <div id="film_comment_content">
                    <div class="d-flex justify-content-between"> 
                        <h3 class="ld_itema">' . htmlspecialchars($result['first_name']) . ' ' . htmlspecialchars($result['last_name'])  . '</h3>
                        <p style="color: grey; font-weight:500; margin:0;">' . strftime("%d %B %Y", strtotime($comment['publication_date'] )). '</p>
                    </div>

                    <div>' . $str_star . '</div>
                    <p>' . htmlspecialchars($comment['description']) . '</p>
                </div>
            ';
        }
        // All comments
        } elseif(isset($_GET['all'])) {
            foreach($all_comments as $comment) { 

                $q = 'SELECT first_name,last_name FROM USERS WHERE id_client = :id_client';
                $req = $bdd->prepare($q);
                $reponse = $req->execute([
                    'id_client' => $comment['id_client'],
                ]);
                $result = $req -> fetch(PDO::FETCH_ASSOC);

                $str_star="";
                for($j=0; $j<$comment['score']; $j++){
                    $str_star = $str_star . '<i class="uis uis-favorite"></i>';
                };
                for($j=$comment['score']; $j<5; $j++){
                    $str_star = $str_star . '<i style="color:lightgrey;" class="uis uis-favorite"></i>';
                };

                echo '
                
                    <div  id="film_comment_content">
                        <div class="d-flex justify-content-between"> 
                            <h3>' . htmlspecialchars($result['first_name']) . ' ' . htmlspecialchars($result['last_name'])  . '</h3>
                            <p style="color: grey; font-weight:500; margin:0;">' . strftime("%d %B %Y", strtotime($comment['publication_date'] )). '</p>
                        </div>
                        <div>' . $str_star . '</div>
                        <p>' . htmlspecialchars($comment['description']) . '</p>
                    </div>
                ';
            }
        }

        if (!isset($all_comments[0]) || !isset($first_comments[0])){
            echo '<p style="color: grey; text-align:center; margin: 2em 0 2em 0;">Pas de commentaires sur ce film.</p>';
            echo '<BODY onLoad="remove_show_btn()">';   
        }
        if (!isset($all_comments[3])){
            echo '<BODY onLoad="remove_show_btn()">';  
        }
        


    // echo '<pre>' . var_dump($own_comment, true) . '</pre>';
    // echo '<pre>' . var_dump($first_comments, true) . '</pre>';
    // echo '<pre>' . var_dump($all_comments, true) . '</pre>';

