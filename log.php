<?php
// type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated  | $page = actual url

$email ='';

function writeLog($type, $email, $page)
{
	if (!isset($_SESSION['email']) && $type == 3){
		return;
	}else if(!isset($_SESSION['email'])){
		$email = 'visitor';
	}else{
		$email = $_SESSION['email'];
	};
	// Create txt everyday
	$log = fopen($_SERVER['DOCUMENT_ROOT']. '/logs/' . date('Y-m-d') . '.txt' , 'a+');

	if($type == 1){
		$line = date('Y-m-d - H:i:s') . ' - ' . $_POST['email'] . ' - Logging attempt SUCCESS ' . "\n" . '';
	} elseif($type == 2) { 
		$line = date('Y-m-d - H:i:s') . ' - ' . $_POST['email'] . ' - Logging attempt FAILED ' . "\n" . '';
	} elseif($type == 3){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - visited ' . $page ."\n" . '';
	} elseif($type == 4){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - email sent ' . "\n" . '';
	} elseif($type == 5){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - user info modified ' . "\n" . '';
	} elseif($type == 6){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - user pdf generated ' . "\n" . '';
	} elseif($type == 7){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - order pdf generated ' . "\n" . '';
	} elseif($type == 8){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - Logging out ' . "\n" . '';
	} elseif($type == 9){
		$line = date('Y-m-d - H:i:s') . ' - ' . $_POST['email'] . ' - Failed to sign up ' . "\n" . '';
	} elseif($type == 10){
		$line = date('Y-m-d - H:i:s') . ' - ' . $_POST['email'] . ' - Account created successfully ' . "\n" . '';
	}

	fputs($log, $line);
	fclose($log);

	// Create txt for every user
	$log = fopen($_SERVER['DOCUMENT_ROOT']. '/logs/' . $email . '.txt' , 'a+');

	if($type == 1){
		$line = date('Y-m-d - H:i:s') . ' - ' . $_POST['email'] . ' - Logging attempt SUCCESS ' . "\n" . '';
	} elseif($type == 2) { 
		$line = date('Y-m-d - H:i:s') . ' - ' . $_POST['email'] . ' - Logging attempt FAILED ' . "\n" . '';
	} elseif($type == 3){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - visited ' . $page ."\n" . '';
	} elseif($type == 4){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - email sent ' . "\n" . '';
	} elseif($type == 5){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - user info modified ' . "\n" . '';
	} elseif($type == 6){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - user pdf generated ' . "\n" . '';
	} elseif($type == 7){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - order pdf generated ' . "\n" . '';
	} elseif($type == 8){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - Logging out ' . "\n" . '';
	} elseif($type == 9){
		$line = date('Y-m-d - H:i:s') . ' - ' . $_POST['email'] . ' - Failed to sign up ' . "\n" . '';
	} elseif($type == 10){
		$line = date('Y-m-d - H:i:s') . ' - ' . $_POST['email'] . ' - Account created successfully ' . "\n" . '';
	}

	fputs($log, $line);
	fclose($log);
}

// <?php include 'log.php';
writeLog($log_type, $email, $log_page) ?>