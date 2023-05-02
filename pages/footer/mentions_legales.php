<style>
    @media screen and (max-width: 1000px){
      main{
        width:95%!important;
        padding:1em!important;
        font-size:0.9em;
      }
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flutters: RGPD</title>
  
    <!-- Import Bootstrap CSS Library -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <!-- Import css -->
  <link href="profile.css?rs=<?= time() ?>" rel="stylesheet">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>
<body class="d-flex justify-content-center align-items-center flex-column" style="background: linear-gradient(to left, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)),url('../profile/profile_background.png');">
    <!-- Include Header -->
    <?php include("/var/www/flutters.ovh/pages/nav/nav.php"); ?>

    <main style="margin-top:10em; margin-bottom:5em; background-color: rgba(148, 148, 148, 0.70);color:white;width:65%; padding:3em;" >
    <h1>MENTIONS LÉGALES</h1>
    <br><br>
    <p>Conformément aux dispositions de la loi <strong>n° 2004-575 du 21 juin 2004</strong> pour la confiance en l'économie numérique, il est précisé aux utilisateurs du site Flutters l'identité des différents intervenants dans le cadre de sa réalisation et de son suivi.
    <br><br>
    <strong>Edition du site </strong>
    <br>

    Le présent site, accessible à l’URL Flutters.ovh (le « Site »), est édité par :<br>
    Fly Flutt, résidant 28 Boulevard de la Misère, Paris 15ème, de nationalité Française (France), né(e) le 05/05/2023, 
    <br><br>


    <strong>Hébergement</strong><br>
    Le Site est hébergé par la société OVH SAS, situé 2 rue Kellermann - BP 80157 - 59053 Roubaix Cedex 1, (contact téléphonique ou email : 1007).
    <br><br>

    <strong>Directeur de publication </strong><br>
    Le Directeur de la publication du Site est Fly Flutt.
    <br><br>

    <strong>Nous contacter </strong>
    <br>

    Par téléphone : +33585762103 <br>
    Par email : flutters.contact@gmail.com<br>
    Par courrier : 28 Boulevard de la Misère, Paris 15ème<br>
    <br><br>

    <strong>Données personnelles</strong>
    <br>

    Le traitement de vos données à caractère personnel est régi par notre Charte du respect de la vie privée, disponible depuis la section "Charte de Protection des Données Personnelles", conformément au Règlement Général sur la Protection des Données 2016/679 du 27 avril 2016 («RGPD»).
    </p>

    </main>
      <!-- Footer -->
      <?php include '/var/www/flutters.ovh/pages/footer/footer.php' ?>

<!-- Import Bootstrap JS Library -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/gsap.min.js"></script>
<script src="profile.js"></script>
    </body>
</html>