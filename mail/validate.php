<?php
/****** EMAILS WILL BE SEND TO THIS ADDRSS *****/

define('YOUR_EMAIL','mail@somedomain.tld');

/****** SMTP CONFIG *****/
/****** Insert this data if you want to use SMTP autheticated mail. Ask your hosting provider if you're not sure how to fill it.    *****/
/****** If you leave this empty, mails will be send with PHP mail() functions (on Windows servers you will have to use SMTP method) *****/

$smtpHost = ""; // SMTP servers
$smtpUsername = "";  // SMTP username 
$smtpPassword = ""; // SMTP password
$smtpFrom     = ""; // SMTP Sender email
$smtpFromname = ""; //Sender name

/************************/









error_reporting(E_ERROR);

header("Content-Type: text/html; charset=utf-8");
// Start the main function
if($_POST["sendmail"]==1) {
	sendEmail();
} else {
	validateData();
}

// Validates data and sending e-mail
function sendEmail()
{
	$output = '';
	$error = 0;
	if(!$_POST['name'])
	{
		$output .= '<p>insert your name</p>';
		$error = 1;
	}
	if(!$_POST['phone'])
	{
		$output .= '<p>insert your phone</p>';
		$error = 1;
	}
	if(!$_POST['mail'])
	{
		$output .= '<p>insert your e-mail</p>';
		$error = 1;
	}
	elseif(!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))
	{
		$output .= '<p>wrong e-mail</p>';
		$error = 1;
	}
	
	if(!$_POST['message'])
	{
		$output .= '<p>insert message</p>';
		$error = 1;
	}
	if($error)
	{
		echo '<div class="error-box">'.$output.'<div class="small-triangle"></div><div class="small-icon"><i class="jfont">&#xe80f;</i></div></div>';
	}
	else
	{
			$to = YOUR_EMAIL;
			$subject = "Message from the page";
			$mbody = "
			Sender:
			".$_POST['name']."
			".$_POST['mail']."
			".$_POST['phone']."
			
			Message:
			".$_POST['message']."
			
			";
			
			if( $smtpHost && $smtUsername && $smtpPassword && $smtpFrom && $smtpFromname ) {
				require 'mailphp/PHPMailerAutoload.php';

				$mail = new PHPMailer();

				$mail->IsSMTP();       // send via SMTP
				$mail->Host     = $smtpHost; // SMTP servers
				$mail->SMTPAuth = true;     // turn on SMTP authentication
				$mail->Username = $smtpUsername;  // SMTP username 
				$mail->Password = $smtpPassword; // SMTP password

				$mail->From     = $smtpFrom; // SMTP Sender email
				$mail->Fromname = $smtpFromname; //Sender name
				$mail->AddAddress(YOUR_EMAIL,""); //receipt name
				$mail->Subject  =  $subject;
				$mail->Body     =  $mbody;

				if($mail->Send())
				{
					echo '<div class="success-box"><p>E-mail was sent.</p><div class="small-triangle"></div><div class="small-icon"><i class="jfont">&#xe816;</i></div></div>';
				}
				else {
					echo '<div class="error-box">Error. Please try again.<div class="small-triangle"></div><div class="small-icon"><i class="jfont">&#xe80f;</i></div></div>';				
				}
			}
			else {
				$headers = array
				(
					'MIME-Version: 1.0',
					'Content-Type: text/plain; charset="UTF-8";',
					'Content-Transfer-Encoding: 7bit',
					'Message-ID: <' . $_SERVER['REQUEST_TIME'] . md5($_SERVER['REQUEST_TIME']) . '@' . $_SERVER['SERVER_NAME'] . '>',
					'From: ' . strip_tags($_POST['mail']),
					'Reply-To: ' . strip_tags($_POST['mail']),
					'Return-Path: ' . strip_tags($_POST['mail']),
					'X-Mailer: PHP v' . phpversion(),
					'X-Originating-IP: ' . $_SERVER['SERVER_ADDR']
				);
				if(mail(YOUR_EMAIL, $subject, $mbody,implode("\n", $headers)))
				{
					echo '<div class="success-box"><p>E-mail was sent.</p><div class="small-triangle"></div><div class="small-icon"><i class="jfont">&#xe816;</i></div></div>';
				}
				else
				{
					echo '<div class="error-box">Error. Please try again.<div class="small-triangle"></div><div class="small-icon"><i class="jfont">&#xe80f;</i></div></div>';			
				}
			}
	}
}

function validateData() {
	
	$required = $_GET["required"];
	$type = $_GET["type"];
	$value = $_GET["value"];

	validateRequired($required, $value, $type);

	switch ($type) {
		case 'number':
			validateNumber($value);
			break;
		case 'alphanum':
			validateAlphanum($value);
			break;
		case 'alpha':
			validateAlpha($value);
			break;
		case 'date':
			validateDate($value);
			break;
		case 'email':
			validateEmail($value);
			break;
		case 'url':
			validateUrl($value);
		case 'all':
			validateAll($value);
			break;
	}
}

// The function to check if a field is required or not
function validateRequired($required, $value, $type) {
	if($required == "required") {

		// Check if we got an empty value
		if($value == "") {
			echo "false";
			exit();
		}
	} else {
		if($value == "") {
			echo "none";
			exit();
		}
	}
}

// Validation of an Email Address
function validateEmail($value) {
	if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
		echo "true";
	} else {
		echo "false";
	}
}

// Validation of a date
function validateDate($value) {
	if(preg_match("/^(\d{4})-(\d{2})-(\d{2})$/", $value)) {
		echo "true";
	} else {
		echo "false";
	}
}

// Validation of an URL
function validateUrl($value) {
	if(preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $value)) {
		echo "true";
	} else {
		echo "false";
	}
}

// Validation of characters
function validateAlpha($value) {
	if(preg_match('/^(?=.*[a-z])[a-z -]+$/i', $value)) {
		echo "true";
	} else {
		echo "false";
	}
}

// Validation of characters and numbers
function validateAlphanum($value) {
	if(preg_match('/[^a-z_\-0-9]/i', $value)) {
		echo "true";
	} else {
		echo "false";
	}
}

// Validation of numbers
function validateNumber($value) {
	if(is_numeric($value)) {
		echo "true";
	} else {
		echo "false";
	}
}

// Validation of numbers
function validateAll($value) {
		echo "true";
}

?>
