<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
 
  <title>Dashboard | Movies</title>

  <!-- Icons -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <link href="../dashboard.css" rel="stylesheet">
</head>

<body>
  
  <?php include '../searchbar.php' ?>
  <div class="container-fluid">
    <div class="row">
      
    <?php include '../sidebar.php' ?>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h2>Films</h2>
        <div class="table-responsive">
        <?php if(!isset($_GET['type']) || $_GET['type'] == 'delete') : ?> 
          <table class="table table-sm">
            <thead>
                <tr>
                  <?php echo (!isset($_GET['type']) || $_GET['type'] == 'delete')? '<th scope="col">#</th>' :'';?>
                  <th scope="col" width="15%">Titre</th>
                  <th scope="col" width="8%">Date </th>
                  <th scope="col">Durée</th>
                  <th scope="col" width="15%">Types</th>
                  <th scope="col">Directeur</th>
                  
                  <th scope="col">Acteurs</th>

                    <th scope="col">
                      <div class=" hover-effect d-flex align-items-center">
                        <i class="add-icon uil uil-plus-circle"></i> 
                        <a class="add-cta" href="movies?type=create">Ajouter un film</a>     
                      </div>
                    </th>

          <?php endif; ?>    
                
                </tr>
            </thead>
            <tbody>
            <?php include 'movie-delete.php';
            include 'table-creation.php'; ?>

            </tbody>
          </table> 
        </div>
      </main>
    </div>
  </div>



</body>

</html>