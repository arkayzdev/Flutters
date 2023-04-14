<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Newsletter</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
  <?php
  if (isset($_GET['message'])) {
  ?>
    <input type="checkbox" id="toggle" />
    <label for="toggle" class="show-btn">S'abonner</label>
    <div class="wrapper">
      <label for="toggle">
        <i class="cancel-icon fas fa-times"></i>
      </label>
      <div class="icon"><i class="far fa-envelope"></i></div>
      <div class="content">
        <header>Entrer dans le monde de Flutters</header>
      </div>
    <?php echo '<p>' . htmlspecialchars($_GET['message']) . '</p>';
  } else { ?>
      <input type="checkbox" id="toggle" />
      <label for="toggle" class="show-btn">S'abonner</label>
      <div class="wrapper">
        <label for="toggle">
          <i class="cancel-icon fas fa-times"></i>
        </label>
        <div class="icon"><i class="far fa-envelope"></i></div>
        <div class="content">
          <header>Entrer dans le monde de Flutters</header>
          <p>
            Viens, on va faire un tour au cinéma !
          </p>
        </div>
        <form action="newsletter_verification.php" method="post">
          <div class="data">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <button id="btn2" type="submit">S'abonner</button>
          <?php } ?>
          </div>
</body>

</html>