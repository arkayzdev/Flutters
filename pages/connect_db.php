<?php 
    // Connect to db
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=Flutters;port=3306','debian', '74cBZfxeFSBg', array(PDO::ATTR_ERRMODE => PDO :: ERRMODE_EXCEPTION));
    } catch(Exception $e){
        die('Erreur PDO : ' . $e->getMessage());
    }
?>