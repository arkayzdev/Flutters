<?php

include($_SERVER['DOCUMENT_ROOT']."/pages/connect_db.php");

if(isset($_GET['search']) && $_GET['search']!=""){
    $q = 'SELECT * FROM MOVIE WHERE title LIKE ? AND id_movie NOT IN(SELECT id_movie FROM TAKE_PLACE WHERE id_session IN (SELECT id_session FROM Flutters.SESSION WHERE seance_date >=(SELECT DATE(SYSDATE()) FROM dual)) ORDER BY release_date DESC) ORDER BY title ASC;';

    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        '%' . $_GET['search'] . '%'
    ]);
    $result = $req -> fetchAll(PDO::FETCH_ASSOC);

    foreach($result as $film) { 
        echo '<a class="film_a" href="film_page.php?id=' . htmlspecialchars($film['id_movie']) . '">'
    ?>
            <?php 
                echo '<img id="film_img" src="../dashboard/movies/' . htmlspecialchars($film['poster_image']) . '">
                <p class="titles"> ' . htmlspecialchars($film['title']) . '</p> 
            ';?>
        </a>
    <?php 
    }
} else {
    $q = 'SELECT * FROM MOVIE WHERE id_movie NOT IN(SELECT id_movie FROM TAKE_PLACE WHERE id_session IN (SELECT id_session FROM Flutters.SESSION WHERE seance_date >=(SELECT DATE(SYSDATE()) FROM dual)) ORDER BY release_date DESC) ORDER BY title ASC;';

    $req = $bdd->prepare($q);
    $reponse = $req->execute();
    $result = $req -> fetchAll(PDO::FETCH_ASSOC);

    foreach($result as $film) { 
        echo '<a class="film_a" href="film_page.php?id=' . htmlspecialchars($film['id_movie']) . '">'
    ?>
            <?php 
                echo '<img id="film_img" src="../dashboard/movies/' . htmlspecialchars($film['poster_image']) . '">
                <p class="titles"> ' . htmlspecialchars($film['title']) . '</p> 
            ';?>
        </a>
<?php 
}
}
?>