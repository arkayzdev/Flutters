<?php include '../../connect_db.php';

$q = 'SELECT * FROM SESSION ORDER BY seance_date DESC';
$req = $bdd->query($q);
$result_sessions = $req->fetchAll(PDO::FETCH_ASSOC);

?>
<!-- Alter Table -->
<?php if (isset($_GET['type']) && isset($_GET['id']) && $_GET['type'] == 'modify') : ?> 
<?php foreach ($result_movies as $id_movie) {
    if ($_GET['id'] ==  $id_movie['id_movie']) : ?> 
       <form class="d-flex flex-column m-2 col-6" method="POST" action="movie-update" enctype="multipart/form-data">
            <div>
                <div class="d-flex">
                    <div class="me-4 d-flex flex-column">
                        <img src="<?php echo $id_movie['poster_image']?>" id="preview-image" style="width: 240px; height: 350px; object-fit: cover;" value="<?php echo $id_movie['poster_image']?>"/>
                        <small class="mb-2 form-text" id="poster-image-inline">Format : JPEG/PNG/GIF - 2 Mo max</small>
                        <div class="d-flex flex-column mb-3 btn btn-dark " style="width:60%">
                            <label class="form-label text-white m-1" for="customFile1">Changer image</label>
                            <input type="file" accept="image/*" onchange="loadFile(event)" class="form-control d-none" id="customFile1" aria-describedby="poster-image-inline" name="image" value="<?php echo $id_movie['poster_image']?>"/>
                        </div>
                    
                    </div>
                    
                    <div class="ml-2 d-flex flex-column">
                        <div class="mb-3">
                            <label class="form-label" for="film-input">Titre</label>
                            <input class="form-control" name="title" placeholder="Film" id="film-input" value="<?php echo $id_movie['title']?>">
                        </div>   
                        <div class="d-flex flex-row mb-3">
                            <div class="d-flex flex-column">
                                <label class="form-label" for="release-date-input">Date de sortie</label>
                                <input class="form-control" name="release_date" type="date" id="realase-date-input" value="<?php echo $id_movie['release_date']?>">
                            </div>
                            <div class="d-flex flex-column">
                                <label class="form-label" for="duration-input">Durée (en min)</label>
                                <input class="form-control" name="duration" type="number" step="1" min="0" placeholder="0" id="duration-input" value="<?php echo $id_movie['duration']?>">
                            </div>
                           
                            
                        </div>
                        <label class="form-label" for="description-input">Description</label>
                        <textarea class="form-control" name="description" rows="6" aria-describedby="descriptionHelp" id="description-input"><?php echo $id_movie['description']?></textarea>

                    </div>
                </div>
            </div>
            
            <div class="mb-2">
                <label class="form-label" for="type-select">Genres</label>
                <div id="type-inputs">
                    <select onchange="addType()" class="form-select mb-2" id="type-select">
                        <option  id="type-selected" selected>Choisir un genre</option>
                        <?php 
                            $id = $_GET['id'];

                            $q ='SELECT * FROM TYPE ORDER BY name ASC'; // Existing types
                            $req = $bdd->query($q);
                            $types = $req->fetchAll(PDO::FETCH_ASSOC);


                            $q ="SELECT name FROM TYPE t
                            INNER JOIN IS_TO IT on t.id_type = IT.id_type
                            INNER JOIN MOVIE M on IT.id_movie = M.id_movie
                            WHERE M.id_movie = $id";
                            $req = $bdd->query($q);
                            $results = $req->fetchAll(PDO::FETCH_ASSOC);
                            
                            foreach ($types as $type) {
                                $option = 1;
                                foreach($results as $result) {
                                    if ($result['name'] == $type['name']) {
                                        $option = 0;
                                    }
                                }
                                if ($option) {
                                    echo '<option id="' . $type['name']. '-option">' . $type['name'] . "</option>'";
                                }   
                            } ?>
                    </select>
                    
                    <?php foreach ($results as $result) { ?>
                            <div class="d-flex mb-2" id="<?php echo $result['name'] ?>-delete">
                                <input class="form-control" name="types[]" value="<?php echo $result['name']?>" readonly>
                                <button class="btn btn-danger" type="button" onclick="deleteType('<?php echo $result['name'] ?>')">
                                    <i class="uil uil-multiply"></i>
                                </button>
                           </div>
                    <?php } ?>
                </div>
                
            </div>

            <div class="mb-2">
                <label class="form-label" for="language-select">Langue original</label>
                <select class="form-select mb-2" name="language">
                    
                    <?php $q = "SELECT name from LANGUAGE l
                    INNER JOIN IN_LANGUAGE IL on l.id_language = IL.id_language
                    INNER JOIN MOVIE M on IL.id_movie = M.id_movie
                    WHERE M.id_movie = $id";
                    $req = $bdd->query($q);
                    $results = $req->fetchAll(PDO::FETCH_ASSOC);?>

                    <option value="<?php echo $results[0]['name']?>"><?php echo $results[0]['name']?></option>
                    <?php 
                    $q = 'SELECT * FROM LANGUAGE ORDER BY name ASC'; // Existing Actors
                    $req = $bdd->query($q);
                    $languages = $req->fetchAll(PDO::FETCH_ASSOC);

                    
                    
                    foreach ($languages as $language) {
                        $option = 1;
                        foreach($results as $result) {
                            if ($result['name'] == $language['name']) {
                                $option = 0;
                            }
                        }
                        if ($option) {
                            echo '<option value="' . $language['name'] . '">' . $language['name'] . "</option>'";
                        }   
                    } ?>
                </select>
            </div>


            <div class="mb-2" >
                <label class="form-label" for="actor-select">Acteurs principaux</label>
                    <div id="actors-input">
                        <select class="form-select mb-2" id="actor-select" onchange="addActor()">
                            <option id="actor-selected">Choisir un acteur</option>
                            <?php 

                            $id = $_GET['id'];

                            $q ='SELECT * FROM ACTOR ORDER BY first_name ASC'; // Existing Actors
                            $req = $bdd->query($q);
                            $actors = $req->fetchAll(PDO::FETCH_ASSOC);
                            $all_actors = [];
                            foreach($actors as $key) {
                                array_push($all_actors, $key['first_name'] . '-' . $key['last_name'] );
                            }

                            $q ="SELECT first_name, last_name FROM ACTOR a
                            INNER JOIN PLAYED P on a.id_actor = P.id_actor
                            INNER JOIN MOVIE M on P.id_movie = M.id_movie
                            WHERE M.id_movie = $id";
                            $req = $bdd->query($q);
                            $results = $req->fetchAll(PDO::FETCH_ASSOC);
                            
                            $result_actors = [];
                            foreach($results as $key) {
                                array_push($result_actors, $key['first_name'] . '-' . $key['last_name'] );
                            }
                            
                            foreach ($all_actors as $actor) {
                                $option = 1;
                                foreach($result_actors as $result) {
                                    if ($actor == $result) {
                                        $option = 0;
                                    }
                                }
                                if ($option) {
                                    echo '<option id="' . $actor. '-option">' . $actor . "</option>'";
                                }   
                            } 
                             ?>
                        </select>
                        <?php foreach ($results as $result) { 
                            $actor_name = $result['first_name'] . " " . $result['last_name']; ?>
                            <div class="d-flex mb-2" id="<?php echo $actor_name?>-delete">
                                <input class="form-control" name="actors[]" value="<?php echo $actor_name?>" readonly>
                                <button class="btn btn-danger" type="button" onclick="deleteActor('<?php echo $actor_name ?>')">
                                    <i class="uil uil-multiply"></i>
                                </button>
                           </div>
                        <?php } ?>
                    </div>
            </div>

            <div class="mb-2">
                    <label class="form-label" for="director-select">Réalisateurs</label>
                    <div id="directors-input">
                        <select onchange="addDirector()"class="form-select mb-2" id="director-select">
                            <option value="" id="director-selected">Choisir un réalisateur</option>
                            <?php 

                            $id = $_GET['id'];

                            $q ='SELECT * FROM DIRECTOR ORDER BY first_name ASC'; 
                            $req = $bdd->query($q);
                            $directors= $req->fetchAll(PDO::FETCH_ASSOC);
                            $all_directors = [];
                            foreach($directors as $key) {
                                array_push($all_directors, $key['first_name'] . '-' . $key['last_name'] );
                            }

                            $q ="SELECT first_name, last_name FROM DIRECTOR d
                            INNER JOIN REALIZED R on d.id_director = R.id_director
                            INNER JOIN MOVIE M on R.id_movie = M.id_movie
                            WHERE M.id_movie = $id";
                            $req = $bdd->query($q);
                            $results = $req->fetchAll(PDO::FETCH_ASSOC);
                                            
                            $result_directors = [];
                            foreach($results as $key) {
                                array_push($result_directors, $key['first_name'] . '-' . $key['last_name'] );
                            }
                            
                            foreach ($all_directors as $director) {
                                $option = 1;
                                foreach($result_directors as $result) {
                                    if ($director == $result) {
                                        $option = 0;
                                    }
                                }
                                if ($option) {
                                    echo '<option id="' . $director . '-option">' . $director . "</option>'";
                                }   
                            } 
                             ?>
                        </select>
                        <?php foreach ($results as $result) { 
                            $director_name = $result['first_name'] . " " . $result['last_name']; ?>
                            <div class="d-flex mb-2" id="<?php echo $director_name?>-delete">
                                <input class="form-control" name="directors[]" value="<?php echo $director_name?>" readonly>
                                <button class="btn btn-danger" type="button" onclick="deleteDirector('<?php echo $director_name ?>')">
                                    <i class="uil uil-multiply"></i>
                                </button>
                           </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="mb-4">
                    <?php echo '<input type="hidden" name="id" value="' . $_GET['id'] . '">'; ?>
                    <input class="btn btn-danger" type="submit" value="Modifier" onclick="return confirm(\'Modifier ?\')">
                    <a class="btn btn-danger" href="movies" onclick="return confirm('Êtes-vous sûr de vouloir annuler ?')">Annuler</a></td>
                </div>
            
            </div>

            

        </form>
<?php endif; } ?>

<!-- Create table -->
<?php elseif (isset($_GET['type']) && $_GET['type'] == 'create') : ?>
    <tr>
        <form method="POST" action="session-create" enctype="multipart/form-data">
            <td><input type="date" class="form-control" name="date" min="<?= date('Y-m-d')?>"></td>
            <td><input type="time" class="form-control" name="start_time"></td>
            <td>
                <select class="form-select mb-2" id="type-select" name="movie">
                    <option id="type-selected" selected>Choisir un film</option>
                    <?php 
                        $q ='SELECT title FROM MOVIE ORDER BY title ASC'; // Existing types
                        $req = $bdd->query($q);
                        $movies= $req->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($movies as $movie) {
                            echo '<option value="' . $movie['title'] . '">' . $movie['title'] . "</option>'";
                        } ?>
                </select>
            </td>
            
            <td>
                <select class="form-select mb-2" id="type-select" name="language">
                    <option id="type-selected" selected>Choisir une langue</option>
                    <option value="VOSTFR">VOSTFR</option>
                    <option value="VO">VO</option>
                    <option value="VOSTENG">VOSTENG</option>
                </select>
            </td>    
            <td>
                <select class="form-select mb-2" id="type-select" name="room">
                    <option id="type-selected" selected>Choisir une salle</option>
                    <?php 
                        $q ='SELECT room_name FROM ROOM ORDER BY room_name ASC'; // Existing types
                        $req = $bdd->query($q);
                        $rooms = $req->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($rooms as $room) {
                            echo '<option value="' . $room['room_name'] . '">' . $room['room_name'] . "</option>'";
                        } ?>
                </select>
            </td>
            <td><input class="form-control" name="price" type="number"></td>
            <td><input class="btn btn-danger" type="submit" value="Ajouter" onclick="return confirm('Ajouter ?');">
            <a class="btn btn-danger" href="sessions" onclick="return confirm('Êtes-vous sûr de vouloir annuler ?');">Annuler</a></td>
        </form>
    </tr>

    <!-- Display Table -->
<?php else : ?>
    <?php foreach ($result_sessions as $id_session) {
        $id = $id_session['id_session'];
        echo '<tr>';
        echo '<td>' .  htmlspecialchars($id_session['id_session']) . '</td>';
        echo '<td>' .  htmlspecialchars($id_session['seance_date']) . '</td>';
        echo '<td>' .  htmlspecialchars($id_session['start_time']) . '</td>';
        
        $q = "SELECT title, duration  FROM MOVIE m
        INNER JOIN TAKE_PLACE TP on m.id_movie = TP.id_movie
        INNER JOIN SESSION S on TP.id_session = S.id_session
        WHERE S.id_session = $id"; 
        $req = $bdd->query($q);
        $result = $req->fetch(PDO::FETCH_ASSOC);

        echo '<td>' .  htmlspecialchars($result['title']) . '</td>'; 
        echo '<td>' .  htmlspecialchars($result['duration']) . ' min</td>'; 
        echo '<td>' .  htmlspecialchars($id_session['language']) . '</td>'; 

        $id_room = $id_session['id_room'];
        $q = "SELECT room_name, capacity_seat FROM ROOM WHERE id_room = $id_room "; 
        $req = $bdd->query($q);
        $result = $req->fetch(PDO::FETCH_ASSOC);
        
        echo '<td>' .  htmlspecialchars($result['room_name']) . '</td>'; 
        echo '<td>' .  htmlspecialchars($result['capacity_seat']) . '</td>'; 
        echo '<td>' .  htmlspecialchars(number_format($id_session['price'],2)) . '€</td>'; 
        ?>

        <td>
        <?php echo '<a class="button hover-effect" href="sessions?id=' . $id_session['id_session'] .'&type=check">
                        <i class="uil uil-info-circle"></i>
                    </a>';
        echo '  <a class="button hover-effect" href="sessions?id=' . $id_session['id_session'] . '&type=modify">
                    <i class="uil uil-setting"></i>
                </a>';
        echo ' <a class="button hover-effect" href="sessions?id=' . $id_session['id_session'] . '&type=delete" onclick="return confirm(\'Êtes-vous sûr de vouloir le supprimer ?\');">
                    <i class="uil uil-trash-alt"></i>
                </a>';
    } ?>
        </td>
        </tr>
    <?php endif; ?>

    <script src="main.js"></script>