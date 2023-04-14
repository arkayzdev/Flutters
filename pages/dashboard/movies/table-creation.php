<?php include '../../connect_db.php';

$q = 'SELECT * FROM MOVIE';
$req = $bdd->query($q);
$result_movies = $req->fetchAll(PDO::FETCH_ASSOC);

?>
<!-- Alter Table -->
<?php if (isset($_GET['type']) && isset($_GET['id']) && $_GET['type'] == 'modify') : ?> 
<?php foreach ($result_movies as $id_movie) {
    if ($_GET['id'] ==  $id_movie['id_movie']) : ?> 
       <form class="d-flex flex-column m-2 col-6" method="POST" action="movie-create" enctype="multipart/form-data">
            <div>
                <div class="d-flex">
                    <div class="me-4 d-flex flex-column">
                        <img src="<?php echo $id_movie['poster_image']?>" id="preview-image" style="width: 240px; height: 350px; object-fit: cover;" />
                        <small class="mb-2 form-text" id="poster-image-inline">Format recommandé : 480x700 - 2 Mo max</small>
                        <div class="d-flex flex-column mb-3 btn btn-dark " style="width:60%">
                            <label class="form-label text-white m-1" for="customFile1">Choisir image</label>
                            <input type="file" accept="image/*" onchange="loadFile(event)" class="form-control d-none" id="customFile1" aria-describedby="poster-image-inline" name="image"/>
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
                        <!-- <div id="descriptionHelp" class="form-text">
                        Ceci est une description.
                        </div> -->
                        
                    </div>
                </div>
            </div>
            
            <div class="mb-2">
                <label class="form-label" for="type-select">Genres</label>
                <div id="type-inputs">
                    <!-- <input type="text" name="types[]"> -->
                    <select onchange="addType()" class="form-select mb-2" id="type-select">
                        <option  id="type-selected" selected>Choisir un genre</option>
                        <?php 
                            $q ='SELECT * FROM TYPE ORDER BY name ASC'; // Existing types
                            $req = $bdd->query($q);
                            $types = $req->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($types as $type) {
                                echo '<option id="' . $type['name']. '-option">' . $type['name'] . "</option>'";
                            } ?>
                    </select>
                </div>
                
            </div>

            <div class="mb-2">
                <label class="form-label" for="language-select">Langue original</label>
                <select class="form-select mb-2" name="language">
                    <option value="">Choisir une langue</option>
                    <?php 
                        $q ='SELECT * FROM LANGUAGE ORDER BY name ASC'; // Existing Actors
                        $req = $bdd->query($q);
                        $languages = $req->fetchAll(PDO::FETCH_ASSOC);
                        
                        foreach ($languages as $language) {
                            echo '<option value="' . $language['name'] . '">' . $language['name'] . "</option>'";
                    } ?>
                </select>
            </div>


            <div class="mb-2" >
                <label class="form-label" for="actor-select">Acteurs principaux</label>
                    <div id="actors-input">
                        <select class="form-select mb-2" id="actor-select" onchange="addActor()">
                            <option id="actor-selected">Choisir un acteur</option>
                            <?php 
                                $q ='SELECT * FROM ACTOR ORDER BY first_name ASC'; // Existing Actors
                                $req = $bdd->query($q);
                                $actors = $req->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($actors as $actor) {
                                    echo '<option id="' . $actor['first_name'] . "-" . $actor['last_name'] . '-option">' . $actor['first_name'] . " " . $actor['last_name'] . "</option>'";
                            } ?>
                        </select>
                    </div>
            </div>

            <div class="mb-2">
                    <label class="form-label" for="director-select">Réalisateurs</label>
                    <div id="directors-input">
                        <select onchange="addDirector()"class="form-select mb-2" id="director-select">
                            <option value="" id="director-selected">Choisir un réalisateur</option>
                            <?php 
                                $q ='SELECT * FROM DIRECTOR ORDER BY first_name ASC'; // Existing Actors
                                $req = $bdd->query($q);
                                $directors = $req->fetchAll(PDO::FETCH_ASSOC);
                                
                                foreach ($directors as $director) {
                                    echo '<option id="' . $director['first_name'] . "-" . $director['last_name'] . '-option">' . $director['first_name'] . " " . $director['last_name'] . "</option>'";
                                } ?>
                        </select>
                    </div>
                    
                </div>

            <div>
                <input class="btn btn-danger" type="submit" value="Ajouter" onclick="return confirm(\'Ajouter ?\')">
                <a class="btn btn-danger" href="movies" onclick="return confirm('Êtes-vous sûr de vouloir annuler ?')">Annuler</a></td>
            </div>

        </form>
<?php endif; } ?>

<!-- Create table -->
<?php elseif (isset($_GET['type']) && $_GET['type'] == 'create') : ?>
        <form class="d-flex flex-column m-2 col-6" method="POST" action="movie-create" enctype="multipart/form-data">
            <div>
                <div class="d-flex">
                    <div class="me-4 d-flex flex-column">
                        <img src="img/Aperçu.png" id="preview-image" style="width: 240px; height: 350px; object-fit: cover;" />
                        <small class="mb-2 form-text" id="poster-image-inline">Format recommandé : 480x700 - 2 Mo max</small>
                        <div class="d-flex flex-column mb-3 btn btn-dark " style="width:60%">
                            <label class="form-label text-white m-1" for="customFile1">Choisir image</label>
                            <input type="file" accept="image/*" onchange="loadFile(event)" class="form-control d-none" id="customFile1" aria-describedby="poster-image-inline" name="image"/>
                        </div>
                    
                    </div>
                    
                    <div class="ml-2 d-flex flex-column">
                        <div class="mb-3">
                            <label class="form-label" for="film-input">Titre</label>
                            <input class="form-control" name="title" placeholder="Film" id="film-input">
                        </div>   
                        <div class="d-flex flex-row mb-3">
                            <div class="d-flex flex-column">
                                <label class="form-label" for="release-date-input">Date de sortie</label>
                                <input class="form-control" name="release_date" type="date" id="realase-date-input">
                            </div>
                            <div class="d-flex flex-column">
                                <label class="form-label" for="duration-input">Durée (en min)</label>
                                <input class="form-control" name="duration" type="number" step="1" min="0" placeholder="0" id="duration-input">
                            </div>
                           
                            
                        </div>
                        <label class="form-label" for="description-input">Description</label>
                        <textarea class="form-control" name="description" rows="6" aria-describedby="descriptionHelp" id="description-input"></textarea>
                        <!-- <div id="descriptionHelp" class="form-text">
                        Ceci est une description.
                        </div> -->
                        
                    </div>
                </div>
            </div>
            
            <div class="mb-2">
                <label class="form-label" for="type-select">Genres</label>
                <div id="type-inputs">
                    <!-- <input type="text" name="types[]"> -->
                    <select onchange="addType()" class="form-select mb-2" id="type-select">
                        <option  id="type-selected" selected>Choisir un genre</option>
                        <?php 
                            $q ='SELECT * FROM TYPE ORDER BY name ASC'; // Existing types
                            $req = $bdd->query($q);
                            $types = $req->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($types as $type) {
                                echo '<option id="' . $type['name']. '-option">' . $type['name'] . "</option>'";
                            } ?>
                    </select>
                </div>
                
            </div>

            <div class="mb-2">
                <label class="form-label" for="language-select">Langue original</label>
                <select class="form-select mb-2" name="language">
                    <option value="">Choisir une langue</option>
                    <?php 
                        $q ='SELECT * FROM LANGUAGE ORDER BY name ASC'; // Existing Actors
                        $req = $bdd->query($q);
                        $languages = $req->fetchAll(PDO::FETCH_ASSOC);
                        
                        foreach ($languages as $language) {
                            echo '<option value="' . $language['name'] . '">' . $language['name'] . "</option>'";
                    } ?>
                </select>
            </div>


            <div class="mb-2" >
                <label class="form-label" for="actor-select">Acteurs principaux</label>
                    <div id="actors-input">
                        <select class="form-select mb-2" id="actor-select" onchange="addActor()">
                            <option id="actor-selected">Choisir un acteur</option>
                            <?php 
                                $q ='SELECT * FROM ACTOR ORDER BY first_name ASC'; // Existing Actors
                                $req = $bdd->query($q);
                                $actors = $req->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($actors as $actor) {
                                    echo '<option id="' . $actor['first_name'] . "-" . $actor['last_name'] . '-option">' . $actor['first_name'] . " " . $actor['last_name'] . "</option>'";
                            } ?>
                        </select>
                    </div>
            </div>

            <div class="mb-2">
                    <label class="form-label" for="director-select">Réalisateurs</label>
                    <div id="directors-input">
                        <select onchange="addDirector()"class="form-select mb-2" id="director-select">
                            <option value="" id="director-selected">Choisir un réalisateur</option>
                            <?php 
                                $q ='SELECT * FROM DIRECTOR ORDER BY first_name ASC'; // Existing Actors
                                $req = $bdd->query($q);
                                $directors = $req->fetchAll(PDO::FETCH_ASSOC);
                                
                                foreach ($directors as $director) {
                                    echo '<option id="' . $director['first_name'] . "-" . $director['last_name'] . '-option">' . $director['first_name'] . " " . $director['last_name'] . "</option>'";
                                } ?>
                        </select>
                    </div>
                    
                </div>

            <div>
                <input class="btn btn-danger" type="submit" value="Ajouter" onclick="return confirm(\'Ajouter ?\')">
                <a class="btn btn-danger" href="movies" onclick="return confirm('Êtes-vous sûr de vouloir annuler ?')">Annuler</a></td>
            </div>

        </form>

    <!-- Display Table -->
<?php else : ?>
    <?php foreach ($result_movies as $id_movie) {
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
            <?php $q ="SELECT first_name, last_name FROM ACTOR a
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
        <?php echo '<a class="button hover-effect" href="movies?id=' . $id_movie['id_movie'] .'&type=check">
                        <i class="uil uil-info-circle"></i>
                    </a>';
        echo '  <a class="button hover-effect" href="movies?id=' . $id_movie['id_movie'] . '&type=modify">
                    <i class="uil uil-setting"></i>
                </a>';
        echo ' <a class="button hover-effect" href="movies?id=' . $id_movie['id_movie'] . '&type=delete" onclick="return confirm(\'Êtes-vous sûr de vouloir le supprimer ?\');">
                    <i class="uil uil-trash-alt"></i>
                </a>';
    } ?>
        </td>
        </tr>
    <?php endif; ?>

    <script src="main.js"></script>