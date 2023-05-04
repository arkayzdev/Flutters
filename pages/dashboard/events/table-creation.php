<?php include '../../connect_db.php';

$q = 'SELECT * FROM EVENT';
$req = $bdd->query($q);
$result_events = $req->fetchAll(PDO::FETCH_ASSOC);

?>
<!-- Alter Table -->
<?php if (isset($_GET['type']) && isset($_GET['id']) && $_GET['type'] == 'modify') : ?> 
<?php foreach ($result_events as $id_event) {
    if ($_GET['id'] ==  $id_event['id_event']) : ?> 
       <form class="d-flex flex-column m-2 col-10" method="POST" action="event-update" enctype="multipart/form-data">
            <div>

                    <div class="me-4 d-flex flex-column">
                        <img src="<?php echo $id_event['image']?>" id="preview-image" style="width: 240px; height: 350px; object-fit: cover;" value="<?php echo $id_event['image']?>"/>
                        <small class="mb-2 form-text" id="poster-image-inline">Format : JPEG/PNG/GIF - 2 Mo max</small>
                        <div class="d-flex flex-column mb-3 btn btn-dark " style="width: 240px">
                            <label class="form-label text-white m-1" for="customFile1">Changer image</label>
                            <input type="file" accept="image/*" onchange="loadFile(event)" class="form-control d-none" id="customFile1" aria-describedby="poster-image-inline" name="image" value="<?php echo $id_event['image']?>">
                        </div>
                    
                   
                    
                    <div class="ml-2 d-flex flex-column">
                        <div class="mb-3">
                            <label class="form-label" for="event-input">Nom de l'événement</label>
                            <input class="form-control" name="name" placeholder="Evenement" id="event-input" style="width:50%" value="<?php echo htmlspecialchars($id_event['name'], ENT_QUOTES)?>" required>
                        </div>  

                        <label class="form-label" for="description-input">Description</label>
                        <textarea class="form-control mb-3" name="description" rows="6" aria-describedby="descriptionHelp" id="description-input" style="width:50%"><?php echo htmlspecialchars($id_event['description'], ENT_QUOTES)?></textarea>

                        <div class="mb-3">
                            <label class="form-label" for="date-input">Date</label>
                            <input class="form-control" name="date" id="date-input" type="date" style="width:50%" value="<?php echo $id_event['date_event']?>" required>
                        </div>    

                        <div class="mb-3">
                            <label class="form-label" for="time-input">Heure</label>
                            <input class="form-control" name="time" id="time-input" type="time" style="width:50%" value="<?php echo $id_event['start_time']?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="capacity-input">Capacité</label>
                            <input class="form-control" name="capacity" placeholder="1" id="capacity-input" style="width:50%" type="number" min="1" step="1" value="<?php echo htmlspecialchars($id_event['capacity'], ENT_QUOTES)?>" required>
                        </div>  
                        
                        <div class="mb-4">
                            <label class="form-label" for="price-input">Prix</label>
                            <input class="form-control" name="price" placeholder="0" id="price-input" style="width:50%" type="number" min="0" step="0.01" value="<?php echo htmlspecialchars(number_format($id_event['price'],2), ENT_QUOTES)?>" required>
                        </div>  
                    </div>
                 
                    </div>
                </div>
            </div>

           

                <div class="mb-4">
                    <?php echo '<input type="hidden" name="id" value="' . $_GET['id'] . '">'; ?>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#alterModal">
                            Confirmer
                    </button>
                    <button type="button" class="btn" style="background-color: #c6c6c6;">
                        <a class="text-light" href="events">Annuler</a> 
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
        <form class="d-flex flex-column m-2 col-10" method="POST" action="event-create" enctype="multipart/form-data">
            <div>
             
                    <div class="me-4 d-flex flex-column">
                        <img src="img/Aperçu.png" id="preview-image" style="width: 240px; height: 350px; object-fit: cover;" />
                        <small class="mb-2 form-text" id="poster-image-inline">Format JPEG/PNG/GIF- 2 Mo max</small>
                        <div class="d-flex flex-column mb-3 btn btn-dark " style="width:20%">
                            <label class="form-label text-white m-1" for="customFile1">Choisir image</label>
                            <input type="file" accept="image/*" onchange="loadFile(event)" class="form-control d-none" id="customFile1" aria-describedby="poster-image-inline" name="image">
                        </div>
                    </div>
                    
                    <div class="ml-2 d-flex flex-column">
                        <div class="mb-3">
                            <label class="form-label" for="event-input">Nom de l'événement</label>
                            <input class="form-control" name="name" placeholder="Evenement" id="event-input" style="width:50%" required>
                        </div>  

                        <label class="form-label" for="description-input">Description</label>
                        <textarea class="form-control mb-3" name="description" rows="6" aria-describedby="descriptionHelp" id="description-input" style="width:50%"></textarea>

                        <div class="mb-3">
                            <label class="form-label" for="date-input">Date</label>
                            <input class="form-control" name="date" id="date-input" type="date" style="width:50%" required>
                        </div>    

                        <div class="mb-3">
                            <label class="form-label" for="time-input">Heure</label>
                            <input class="form-control" name="time" id="time-input" type="time" style="width:50%" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="capacity-input">Capacité</label>
                            <input class="form-control" name="capacity" placeholder="1" id="capacity-input" style="width:50%" type="number" min="1" step="1" required>
                        </div>  
                        
                        <div class="mb-4">
                            <label class="form-label" for="price-input">Prix</label>
                            <input class="form-control" name="price" placeholder="0" id="price-input" style="width:50%" type="number" min="0" step="0.01" required>
                        </div>  
                    </div>
                </div>
            
            <div>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#createModal">
                    Confirmer
                </button>
                <button type="button" class="btn" style="background-color: #c6c6c6;">
                    <a class="text-light" href="events">Annuler</a> 
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
                        Êtes-vous sûr de vouloir créer cet événement ?
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
    <?php foreach ($result_events as $id_event) : 
        $id = $id_event['id_event'];
        echo '<tr>';
        echo '<td>' .  htmlspecialchars($id_event['id_event']) . '</td>';
        echo '<td>' .  htmlspecialchars($id_event['name']) . '</td>';
        echo '<td>' .  htmlspecialchars(substr($id_event['description'], 0, 20) . '...'). '</td>';
        echo '<td>' .  htmlspecialchars($id_event['date_event']) . '</td>';
        echo '<td>' .  htmlspecialchars(date("H:i", strtotime($id_event['start_time']))) . '</td>';
        echo '<td>' .  htmlspecialchars(number_format($id_event['price'],2)) . '€</td>'; 
        echo '<td>' .  htmlspecialchars($id_event['capacity']) . '</td>';?>
         <td>
            <button type="button" class="btn btn-light">
                <a class="text-dark" href="events?id=<?php echo $id_event['id_event']?>&type=modify">
                    <i class="uil uil-setting"></i>
                </a>
            </button>

            <button type="button" class="btn btn-light ms-2" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteModal(<?php echo $id_event['id_event']?>)">
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
                Êtes-vous sûr de vouloir supprimer cet événement?
            </div>
            <div class="modal-footer">
                <button id="delete-event-btn" type="button" class="btn btn-danger">Supprimer</button>
                <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #c6c6c6; color: white">Annuler</button>
            </div>
            </div>
        </div>
    </div>
<?php endif; ?>

