<?php

    // logs

	// --> $log_type = 1-logSuccess 2-logFailed 3-visited 4-emailSent 5-uiModified 6-updfGenerated 7-opdfGenerated 8-LogOut 9-FailedToSignUp 10-AccountCreated  
	// 11-StripePaymentSent 12-StripePaymentSuccessfull 13-DownloadPDF | $log_page = actual url
    
	// include($_SERVER['DOCUMENT_ROOT']."/log.php");
	// $log_type $email $log_page

if(!isset($_SESSION['email'])){
	$email = 'visitor';
}else{
	$email = $_SESSION['email'];
}

function writeLog($type, $email, $page)
{
	// Create txt everyday
	$log = fopen($_SERVER['DOCUMENT_ROOT']. '/logs/date/' . date('Y-m-d') . '.txt' , 'a+');

	if($type == 1){
		$line = date('Y-m-d - H:i:s') . ' - ' . $_POST['email'] . ' - Logging attempt SUCCESS ' . "<br>\n" . '';
	} elseif($type == 2) { 
		$line = date('Y-m-d - H:i:s') . ' - ' . $_POST['email'] . ' - Logging attempt FAILED ' . "<br>\n" . '';
	} elseif($type == 3){
		$line = '';
	} elseif($type == 4){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - email sent ' . "<br>\n" . '';
	} elseif($type == 5){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - user info modified ' . "<br>\n" . '';
	} elseif($type == 6){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - user pdf generated ' . "<br>\n" . '';
	} elseif($type == 7){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - order pdf generated ' . "<br>\n" . '';
	} elseif($type == 8){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - Logging out ' . "<br>\n" . '';
	} elseif($type == 9){
		$line = date('Y-m-d - H:i:s') . ' - ' . $_POST['email'] . ' - Failed to sign up ' . "<br>\n" . '';
	} elseif($type == 10){
		$line = date('Y-m-d - H:i:s') . ' - ' . $_POST['email'] . ' - Account created successfully ' . "<br>\n" . '';
	} elseif($type == 11){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - Stripe Payment Sent ' . "<br>\n" . '';
	} elseif($type == 12){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - Sripe Payment Successfull ' . "<br>\n" . '';
	} elseif($type == 13){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - Downloaded PDF #' . $page . "<br>\n" . '';
	} elseif($type == 14){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - Commented ' . $page . "<br>\n" . '';
	} elseif($type == 15){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - Modified Comment ' . $page . "<br>\n" . '';
	}

	fputs($log, $line);
	fclose($log);

	// Create txt for every user
	$log = fopen($_SERVER['DOCUMENT_ROOT']. '/logs/user/' . $email . '.txt' , 'a+');

	if($type == 1){
		$line = date('Y-m-d - H:i:s') . ' - ' . $_POST['email'] . ' - Logging attempt SUCCESS ' . "<br>\n" . '';
	} elseif($type == 2) { 
		$line = date('Y-m-d - H:i:s') . ' - ' . $_POST['email'] . ' - Logging attempt FAILED ' . "<br>\n" . '';
	} elseif($type == 3){
		$line = '';
	} elseif($type == 4){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - email sent ' . "<br>\n" . '';
	} elseif($type == 5){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - user info modified ' . "<br>\n" . '';
	} elseif($type == 6){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - Export User Informations PDF generated ' . "<br>\n" . '';
	} elseif($type == 7){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - order pdf generated ' . "<br>\n" . '';
	} elseif($type == 8){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - Logging out ' . "<br>\n" . '';
	} elseif($type == 9){
		$line = date('Y-m-d - H:i:s') . ' - ' . $_POST['email'] . ' - Failed to sign up ' . "<br>\n" . '';
	} elseif($type == 10){
		$line = date('Y-m-d - H:i:s') . ' - ' . $_POST['email'] . ' - Account created successfully ' . "<br>\n" . '';
	} elseif($type == 11){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - Stripe Payment Sent ' . "<br>\n" . '';
	} elseif($type == 12){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - Sripe Payment Successfull ' . "<br>\n" . '';
	} elseif($type == 13){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - Downloaded PDF ' . $page . "<br>\n" . '';
	}elseif($type == 14){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - Commented ' . $page . "<br>\n" . '';
	} elseif($type == 15){
		$line = date('Y-m-d - H:i:s') . ' - ' . $email . ' - Modified Comment ' . $page . "<br>\n" . '';
	}

	fputs($log, $line);
	fclose($log);
}

// <?php include 'log.php';
writeLog($log_type, $email, $log_page) ?>