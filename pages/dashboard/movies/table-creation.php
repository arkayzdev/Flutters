<?php include '../../connect_db.php';

$q = 'SELECT * FROM MOVIE';
$req = $bdd->query($q);
$result_movies = $req->fetchAll(PDO::FETCH_ASSOC);

?>
<!-- Alter Table -->
<?php if (isset($_GET['type']) && isset($_GET['id']) && $_GET['type'] == 'modify') : ?> 
<?php foreach ($result_movies as $id_movie) {
    if ($_GET['id'] ==  $id_movie['id_movie']) : ?> 
       <form class="d-flex flex-column m-2 col-10" method="POST" action="movie-update" enctype="multipart/form-data">
            <div>
                <div class="d-flex">
                    <div class="me-4 d-flex flex-column">
                        <img src="<?php echo $id_movie['poster_image']?>" id="preview-image" style="width: 240px; height: 350px; object-fit: cover;" value="<?php echo $id_movie['poster_image']?>"/>
                        <small class="mb-2 form-text" id="poster-image-inline">Format : JPEG/PNG/GIF - 2 Mo max</small>
                        <div class="d-flex flex-column mb-3 btn btn-dark " style="width:60%">
                            <label class="form-label text-white m-1" for="customFile1">Changer image</label>
                            <input type="file" accept="image/*" onchange="loadFile(event)" class="form-control d-none" id="customFile1" aria-describedby="poster-image-inline" name="image" value="<?php echo $id_movie['poster_image']?>">
                        </div>
                    
                    </div>
                    
                    <div class="ml-2 d-flex flex-column">
                        <div class="mb-3">
                            <label class="form-label" for="film-input">Titre</label>
                            <input class="form-control" name="title" placeholder="Film" id="film-input" value="<?php echo $id_movie['title']?>" required>
                        </div>   
                        <div class="mb-3">
                            <label class="form-label" for="trailer-input">Bande d'annonce</label>
                            <input class="form-control" name="trailer" placeholder="Lien" id="trailer-input" value="<?php echo $id_movie['trailer']?>" required>
                        </div>  
                        <div class="d-flex flex-row mb-3">
                            <div class="d-flex flex-column">
                                <label class="form-label" for="release-date-input">Date de sortie</label>
                                <input class="form-control" name="release_date" type="date" id="realase-date-input" value="<?php echo $id_movie['release_date']?>" required>
                            </div>
                            <div class="d-flex flex-column">
                                <label class="form-label" for="duration-input">Durée (en min)</label>
                                <input class="form-control" name="duration" type="number" step="1" min="0" placeholder="0" id="duration-input" value="<?php echo $id_movie['duration']?>" required>
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
                                array_push($all_actors, $key['first_name'] . ' ' . $key['last_name'] );
                            }

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
                            
                            foreach ($all_actors as $actor) {
                                $option = 1;
                                foreach($result_actors as $result) {
                                    if ($actor == $result) {
                                        $option = 0;
                                    }
                                }
                                if ($option) {
                                    $actor_names = explode(' ', $actor);
                                    $actor_names = join("-", $actor_names);
                                    echo '<option id="' . $actor_names . '-option">' . $actor . "</option>'";
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

                            $q ='SELECT * FROM DIRECTOR ORDER BY first_name ASC'; // Existing Actors
                            $req = $bdd->query($q);
                            $directors= $req->fetchAll(PDO::FETCH_ASSOC);
                            $all_directors = [];
                            foreach($directors as $key) {
                                array_push($all_directors, $key['first_name'] . ' ' . $key['last_name'] );
                            }

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
                            
                            foreach ($all_directors as $director) {
                                $option = 1;
                                foreach($result_directors as $result) {
                                    if ($director == $result) {
                                        $option = 0;
                                    }
                                }
                                if ($option) {
                                    $director_names = explode(' ', $director);
                                    $director_names = join("-", $director_names);
                                    echo '<option id="' . $director_names . '-option">' . $director . "</option>'";
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
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#alterModal">
                            Confirmer
                    </button>
                    <button type="button" class="btn" style="background-color: #c6c6c6;">
                        <a class="text-light" href="movies">Annuler</a> 
                    </button>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="alterModal" tabindex="-1" aria-labelledby="alterModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="alterModalLabel">Confirmation</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir modifier ce film ?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Modifier</button>
                        <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #c6c6c6; color: white">Fermer</button>
                    </div>
                    </div>
                </div>
            </div>
            

        </form>
<?php endif; } ?>

<!-- Create table -->
<?php elseif (isset($_GET['type']) && $_GET['type'] == 'create') : ?>
        <form class="d-flex flex-column m-2 col-10" method="POST" action="movie-create" enctype="multipart/form-data">
            <div>
                <div class="d-flex">
                    <div class="me-4 d-flex flex-column">
                        <img src="img/Aperçu.png" id="preview-image" style="width: 240px; height: 350px; object-fit: cover;" />
                        <small class="mb-2 form-text" id="poster-image-inline">Format JPEG/PNG/GIF- 2 Mo max</small>
                        <div class="d-flex flex-column mb-3 btn btn-dark " style="width:60%">
                            <label class="form-label text-white m-1" for="customFile1">Choisir image</label>
                            <input type="file" accept="image/*" onchange="loadFile(event)" class="form-control d-none" id="customFile1" aria-describedby="poster-image-inline" name="image" required>
                        </div>
                    
                    </div>
                    
                    <div class="ml-2 d-flex flex-column">
                        <div class="mb-3">
                            <label class="form-label" for="film-input">Titre</label>
                            <input class="form-control" name="title" placeholder="Film" id="film-input" required>
                        </div>  
                        <div class="mb-3">
                            <label class="form-label" for="trailer-input">Bande d'annonce</label>
                            <input class="form-control" name="trailer" placeholder="Lien" id="trailer-input" required>
                        </div>    
                        <div class="d-flex flex-row mb-3">
                            <div class="d-flex flex-column">
                                <label class="form-label" for="release-date-input">Date de sortie</label>
                                <input class="form-control" name="release_date" type="date" id="realase-date-input" required>
                            </div>
                            <div class="d-flex flex-column">
                                <label class="form-label" for="duration-input">Durée (en min)</label>
                                <input class="form-control" name="duration" type="number" step="1" min="0" placeholder="0" id="duration-input" required> 
                            </div>
                           
                            
                        </div>
                        <label class="form-label" for="description-input">Description</label>
                        <textarea class="form-control" name="description" rows="6" aria-describedby="descriptionHelp" id="description-input"></textarea>
                    </div>
                </div>
            </div>
            
            <div class="mb-2">
                <label class="form-label" for="type-select">Genres</label>
                <div id="type-inputs">
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
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#createModal">
                    Confirmer
                </button>
                <button type="button" class="btn" style="background-color: #c6c6c6;">
                    <a class="text-light" href="movies">Annuler</a> 
                </button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="createModalLabel">Confirmation</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir créer ce film ?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Créer</button>
                        <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #c6c6c6; color: white">Fermer</button>
                    </div>
                    </div>
                </div>
            </div>

        </form>

    <!-- Display Table -->
<?php else : ?>
    <?php foreach ($result_movies as $id_movie) : 
        $id = $id_movie['id_movie'];
        echo '<tr>';
        echo '<td>' .  htmlspecialchars($id_movie['id_movie']) . '</td>';
        echo '<td>' .  htmlspecialchars($id_movie['title']) . '</td>';
        echo '<td><a href="' . htmlspecialchars($id_movie['trailer']) . '" target="_blank"><i class="uil uil-external-link-alt" style="color: grey; font-size:18px;"></i></a></td>';
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

            <button type="button" class="btn btn-light ms-2" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteModal(<?php echo $id_movie['id_movie']?>)">
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
<?php endif; ?>

