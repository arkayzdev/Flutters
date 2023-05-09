<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="news.css?rs=<?= time()?>">
    <title>Document</title>
</head>
<body>
    
<?php

include("/var/www/flutters.ovh/pages/connect_db.php");

$result = $bdd->query('SELECT * FROM NEWSLETTER');
$query = $bdd->prepare('SELECT email FROM NEWSLETTER WHERE email = :email');





if (!$result) {
    echo "Problème de requête";
} else {
    $nbre_emails = $result->rowCount();
    ?>
   
    <h3>TOUS NOS ABONNÉS</h3>
    <h4>Il y a <?php echo $nbre_emails; ?> abonnés à la newsletter</h4>
    <button id="btn456">
          <a href="share.php">Envoyer des news a nos abonnés</a>
            </button>
    <table class="container">
        <thread>
        <tr>
            <th>Email</th>
            <th>Date d'inscription</th> 
            <th>Supprimer</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($ligne = $result->fetch(PDO::FETCH_ASSOC)) {

            echo "<tr>";
            echo "<td>" . $ligne['email'] . "</td>";
            echo "<td>" . $ligne['sub_date'] . "</td>"; 
            echo "<td><a href='delete.php?email=" . $ligne['email'] . "'>Supprimer</a></td>";
            echo "</tr>";
            
            
        }
    }
        ?>
        </tbody>
          </table>
            <br/>
            


        


      

        

   

<?php
$result->closeCursor();
?>



</body>
</html>


