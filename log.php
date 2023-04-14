<?php


function writeLog($success, $email)
{
	// Ouvrir le fichier log.txt
	$log = fopen('log.txt', 'a+');

	// Création de la ligne à écrire
	$line = date('Y/m/d - H:i:s') . ' - Tentative de connexion ' . ($success ? 'réussie' : 'échouée') . ' de ' . $email . "\n";

	// Ecriture de la ligne dans le fichier
	fputs($log, $line);

	// Fermeture du fichier de log
	fclose($log);
}

// <?php include 'log.php';
writeLog(true, 'visitor') ?>;