<?php
include '../../../connect_db.php';

if(isset($_GET['name']) && !empty($_GET['name'])) {
    $name = $_GET['name'];

    $q = "SELECT * FROM MOVIE WHERE title LIKE ?";
    $req = $bdd->prepare($q);
    $success = $req->execute([
        '%' . $name . '%'
    ]);

    if($success) {
            $result_movies = $req->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result_movies as $id_movie) :
            $id = $id_movie['id_movie'];
            echo '<tr>';
            echo '<td>' .  htmlspecialchars($id_movie['id_movie']) . '</td>';
            echo '<td>' .  htmlspecialchars($id_movie['title']) . '</td>';
            echo '<td>' .  htmlspecialchars($id_movie['release_date']) . '</td>';
            echo '<td>' .  htmlspecialchars($id_movie['duration']) . 'min</td>'; ?>
    
            <td>
                <?php 
                $q ="SELECT name FROM TYPE t
                INNER JOIN IS_TO IT on t.id_type = IT.id_type
                INNER JOIN MOVIE M on IT.id_movie = M.id_movie
                WHERE M.id_movie = $id";
                $req = $bdd->query($q);
                $results = $req->fetchAll(PDO::FETCH_ASSOC);
    
                $result_types = [];
                foreach($results as $key) {
                    array_push($result_types, $key['name']);
                }
                echo join(", ", $result_types) ?>
            </td>
    
            <td>
                <?php 
                $q ="SELECT first_name, last_name FROM DIRECTOR d
                INNER JOIN REALIZED R on d.id_director = R.id_director
                INNER JOIN MOVIE M on R.id_movie = M.id_movie
                WHERE M.id_movie = $id";
                $req = $bdd->query($q);
                $results = $req->fetchAll(PDO::FETCH_ASSOC);
    
                $result_directors = [];
                foreach($results as $key) {
                    array_push($result_directors, $key['first_name'] . ' ' . $key['last_name'] );
                }
                echo join(", ", $result_directors) ?>
            </td>
    
            <td>
                <?php 
                $q ="SELECT first_name, last_name FROM ACTOR a
                INNER JOIN PLAYED P on a.id_actor = P.id_actor
                INNER JOIN MOVIE M on P.id_movie = M.id_movie
                WHERE M.id_movie = $id";
                $req = $bdd->query($q);
                $results = $req->fetchAll(PDO::FETCH_ASSOC);
    
                $result_actors = [];
                foreach($results as $key) {
                    array_push($result_actors, $key['first_name'] . ' ' . $key['last_name'] );
                }
                echo join(", ", $result_actors) ?>
            </td>
    
            <td>
            <button type="button" class="btn btn-light">
                <a class="text-dark" href="movies?id=<?php echo $id_movie['id_movie']?>&type=modify">
                    <i class="uil uil-setting"></i>
                </a>
            </button>

            <button type="button" class="btn btn-light ms-2" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteModal(<?php echo $id_actor['id_actor']?>)">
                <i class="uil uil-trash-alt"></i>
            </button>
        </td>
        </tr>
    <?php endforeach; ?>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Confirmation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer ce film ?
            </div>
            <div class="modal-footer">
                <button id="delete-movie-btn" type="button" class="btn btn-danger">Supprimer</button>
                <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #c6c6c6; color: white">Annuler</button>
            </div>
            </div>
        </div>
    </div>
</td>

<?php  }
} 
if (empty($_GET['name'])) {
    $q = 'SELECT * FROM MOVIE';
    $req = $bdd->query($q);
    $result_movies = $req->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result_movies as $id_movie) :
        $id = $id_movie['id_movie'];
        echo '<tr>';
        echo '<td>' .  htmlspecialchars($id_movie['id_movie']) . '</td>';
        echo '<td>' .  htmlspecialchars($id_movie['title']) . '</td>';
        echo '<td>' .  htmlspecialchars($id_movie['release_date']) . '</td>';
        echo '<td>' .  htmlspecialchars($id_movie['duration']) . 'min</td>'; ?>

        <td>
            <?php 
            $q ="SELECT name FROM TYPE t
            INNER JOIN IS_TO IT on t.id_type = IT.id_type
            INNER JOIN MOVIE M on IT.id_movie = M.id_movie
            WHERE M.id_movie = $id";
            $req = $bdd->query($q);
            $results = $req->fetchAll(PDO::FETCH_ASSOC);

            $result_types = [];
            foreach($results as $key) {
                array_push($result_types, $key['name']);
            }
            echo join(", ", $result_types) ?>
        </td>

        <td>
            <?php 
            $q ="SELECT first_name, last_name FROM DIRECTOR d
            INNER JOIN REALIZED R on d.id_director = R.id_director
            INNER JOIN MOVIE M on R.id_movie = M.id_movie
            WHERE M.id_movie = $id";
            $req = $bdd->query($q);
            $results = $req->fetchAll(PDO::FETCH_ASSOC);

            $result_directors = [];
            foreach($results as $key) {
                array_push($result_directors, $key['first_name'] . ' ' . $key['last_name'] );
            }
            echo join(", ", $result_directors) ?>
        </td>

        <td>
            <?php 
            $q ="SELECT first_name, last_name FROM ACTOR a
            INNER JOIN PLAYED P on a.id_actor = P.id_actor
            INNER JOIN MOVIE M on P.id_movie = M.id_movie
            WHERE M.id_movie = $id";
            $req = $bdd->query($q);
            $results = $req->fetchAll(PDO::FETCH_ASSOC);

            $result_actors = [];
            foreach($results as $key) {
                array_push($result_actors, $key['first_name'] . ' ' . $key['last_name'] );
            }
            echo join(", ", $result_actors) ?>
        </td>

        <td>
        <button type="button" class="btn btn-light">
                <a class="text-dark" href="movies?id=<?php echo $id_movie['id_movie']?>&type=modify">
                    <i class="uil uil-setting"></i>
                </a>
            </button>

            <button type="button" class="btn btn-light ms-2" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteModal(<?php echo $id_actor['id_actor']?>)">
                <i class="uil uil-trash-alt"></i>
            </button>
        </td>
        </tr>
    <?php endforeach; ?>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Confirmation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer ce film ?
            </div>
            <div class="modal-footer">
                <button id="delete-movie-btn" type="button" class="btn btn-danger">Supprimer</button>
                <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #c6c6c6; color: white">Annuler</button>
            </div>
            </div>
        </div>
    </div>
</td>
<?php }  ?>
