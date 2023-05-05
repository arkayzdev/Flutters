<?php include '../../connect_db.php';
include '../admin-check.php'; ?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
 
  <title>Dashboard</title>

  <!-- Icons -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <link href="../dashboard.css" rel="stylesheet">
</head>

<body>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="../../../../"><img src="../img/header-logo.svg" alt="" width="120" height="35"></a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        <a class="nav-link px-3" href="../deconnexion.php">Déconnexion</a>
      </div>
    </div>
  </header> 
  <?php include '../sidebar.php' ?>
  <div class="container-fluid mb-4">
    <div class="row" id="display-logs">
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <?php $date = date('Y-m-d') ?>
        <h2>Logs du <?php echo $date ?></h2>
          <input class="mb-4 form-select" id="search-logs-input" type="date" max="<?php echo $date?>" value="<?php echo $date?>" onchange="searchLogs()" style="width:30%;">
        <div id="logs-display">
        <?php require($_SERVER['DOCUMENT_ROOT'] . '/logs/date/' . $date . '.txt'); ?>
       </div>
      </main>
    </div>
  </div>

  <script src="main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>

</html>