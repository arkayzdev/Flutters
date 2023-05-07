<?php include '../../connect_db.php';

$q = 'SELECT * FROM SESSION ORDER BY seance_date DESC';
$req = $bdd->query($q);
$result_sessions = $req->fetchAll(PDO::FETCH_ASSOC);


?>
<!-- Alter Table -->
<?php if (isset($_GET['type']) && isset($_GET['id']) && $_GET['type'] == 'modify') : ?> 
<?php foreach ($result_sessions as $id_session) {
    if ($_GET['id'] ==  $id_session['id_session']) : ?> 
        <?php $id=  $id_session['id_session']; ?>
        <form class="d-flex flex-column m-2 col-6 ld_itema" method="POST" action="session-update" enctype="multipart/form-data">
            <td><input type="date" class="form-control" name="date" min="<?= date('Y-m-d')?>" value="<?php echo $id_session['seance_date']?>" required></td>
            <td><input type="time" class="form-control" name="start_time" value="<?php echo $id_session['start_time']?>" required></td>
            <td>
                <select class="form-select mb-2" id="type-select" name="movie">
                    <?php 
                    $q = "SELECT title FROM MOVIE m
                    INNER JOIN TAKE_PLACE TP on m.id_movie = TP.id_movie
                    INNER JOIN SESSION S on TP.id_session = S.id_session
                    WHERE S.id_session = $id"; 
                    $req = $bdd->query($q);
                    $movie_title = $req->fetch(PDO::FETCH_ASSOC);
                    $title = $movie_title['title'];
                    ?>
                    <option value="<?php echo $title?>" selected><?php echo htmlspecialchars($title)?></option>
                    <?php 
                        if(strpos($title, "'")) {
                            $title = str_replace("'","\'",$title);
                        }
                        $q = "SELECT title FROM MOVIE WHERE NOT title = '$title' ORDER BY title ASC";
                        $req = $bdd->query($q);
                        $movies = $req->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($movies as $movie) {
                            echo '<option value="' . $movie['title'] . '">' . htmlspecialchars($movie['title']) . "</option>'";
                        } ?>
                </select>
            </td>
            
            <td>
                <select class="form-select mb-2" id="type-select" name="language">
                    <option value="<?php echo $id_session['language']?>" selected><?php echo htmlspecialchars($id_session['language'])?></option>
                    <?php $language_options = array('VOSTFR', 'VO', 'VOSTENG', 'VF'); 
                    foreach ($language_options as $language) {
                        if ($language != $id_session['language']) {
                            echo '<option value="' . $language .'">' . $language . '</option>';
                        }
                    } ?>
                </select>
            </td>    
            <td>
                
                <select class="form-select mb-2" id="type-select" name="room">
                <?php
                    $q = "SELECT room_name FROM ROOM
                        JOIN Flutters.SESSION S on ROOM.id_room = S.id_room
                        WHERE S.id_session = $id";
                    $req = $bdd->query($q);
                    $selected_room = $req->fetch(PDO::FETCH_ASSOC);
                    ?>
                
                    <option value="<?php echo $selected_room['room_name']?>" selected><?php echo $selected_room['room_name']?></option>
                <?php 
                    $room_name = $selected_room['room_name'];
                    $q = "SELECT room_name FROM ROOM WHERE NOT room_name = '$room_name' ORDER BY room_name ASC";
                    $req = $bdd->query($q);
                    $rooms = $req->fetchAll(PDO::FETCH_ASSOC);
            
                    foreach ($rooms as $room) {
                        echo '<option value="' . $room['room_name'] . '">' . htmlspecialchars($room['room_name']) . "</option>'";
                    } ?>
                </select>
            </td>
            <td><input class="form-control" name="price" type="number" min="0.01" step="0.01" value="<?php echo htmlspecialchars(number_format($id_session['price'], 2))?>" required></td>
            <td>
            <?php echo '<input type="hidden" name="id" value="' . $_GET['id'] . '">'; ?>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#alterModal">
                    Confirmer
            </button>
            <button type="button" class="btn" style="background-color: #c6c6c6;">
                <a class="text-light" href="sessions">Annuler</a> 
            </button>
            </td>
            
            <div class="modal fade" id="alterModal" tabindex="-1" aria-labelledby="alterModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="alterModalLabel">Confirmation</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir modifier cette séance ?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Modifier</button>
                        <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #c6c6c6; color: white">Fermer</button>
                    </div>
                    </div>
                </div>
            </div>
        </form>

            

        </form>
<?php endif; } ?>

<!-- Create table -->
<?php elseif (isset($_GET['type']) && $_GET['type'] == 'create') : ?>
    <tr>
        <form class="ld_itema" method="POST" action="session-create" enctype="multipart/form-data">
            <td><input type="date" class="form-control" name="date" min="<?= date('Y-m-d')?>" required></td>
            <td><input type="time" class="form-control" name="start_time" required></td>
            <td>
                <select class="form-select mb-2" id="type-select" name="movie">
                    <option id="type-selected" selected>Choisir un film</option>
                    <?php 
                        $q ='SELECT title FROM MOVIE ORDER BY title ASC'; // Existing types
                        $req = $bdd->query($q);
                        $movies= $req->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($movies as $movie) {
                            echo '<option value="' . $movie['title'] . '">' . htmlspecialchars($movie['title']) . "</option>'";
                        } ?>
                </select>
            </td>
            
            <td>
                <select class="form-select mb-2" id="type-select" name="language">
                    <option id="type-selected" selected>Choisir une langue</option>
                    <option value="VOSTFR">VOSTFR</option>
                    <option value="VO">VO</option>
                    <option value="VOSTENG">VOSTENG</option>
                    <option value="VF">VF</option>
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
                            echo '<option value="' . $room['room_name'] . '">' . htmlspecialchars($room['room_name']) . "</option>'";
                        } ?>
                </select>
            </td>
            <td><input class="form-control" name="price" type="number" min="0.01" step="0.01"></td>
            <td>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#createModal">
                    Confirmer
                </button>
                <button type="button" class="btn" style="background-color: #c6c6c6;">
                    <a class="text-light" href="sessions">Annuler</a> 
                </button>
            </td>
            
            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="createModalLabel">Confirmation</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Êtes-vous sûr de vouloir créer cette séance ?
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Créer</button>
                            <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #c6c6c6; color: white">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </tr>

    <!-- Display Table -->
<?php else : ?>
    <?php foreach ($result_sessions as $id_session) :
        $id = $id_session['id_session'];
        echo '<tr  class="ld_itema">';
        echo '<td>' .  htmlspecialchars($id_session['id_session']) . '</td>';
        echo '<td>' .  htmlspecialchars($id_session['seance_date']) . '</td>';
        echo '<td>' .  htmlspecialchars(date("H:i", strtotime($id_session['start_time']))) . '</td>';
        
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
            <button type="button" class="btn btn-light">
                <a class="text-dark" href="sessions?id=<?php echo $id_session['id_session']?>&type=modify">
                    <i class="uil uil-setting"></i>
                </a>
            </button>

            <button type="button" class="btn btn-light ms-2" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteModal(<?php echo $id_session['id_session']?>)">
                <i class="uil uil-trash-alt"></i>
            </button>
        </td>
        </tr>
    <?php endforeach; ?>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Confirmation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer cette séance ?
            </div>
            <div class="modal-footer">
                <button id="delete-session-btn" type="button" class="btn btn-danger">Supprimer</button>
                <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #c6c6c6; color: white">Annuler</button>
            </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

