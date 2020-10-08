<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Replace this with your own email address
$myEmail = 'awais@mkhalid.ca';
$from = 'mk@mkhalid.ca';
$from_name = 'Message from mkhalid.ca';


if($_POST) {

   $name = trim(stripslashes($_POST['contactName']));
   $email = trim(stripslashes($_POST['contactEmail']));
   $subject = trim(stripslashes($_POST['contactSubject']));
   $contact_message = trim(stripslashes($_POST['contactMessage']));

   // Check Name
	if (strlen($name) < 2) {
		$error['name'] = "Please enter your name.";
	}
	// Check Email
	if (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $email)) {
		$error['email'] = "Please enter a valid email address.";
	}
	// Check Message
	if (strlen($contact_message) < 15) {
		$error['message'] = "Please enter your message. It should have at least 15 characters.";
	}
   // Subject
	if ($subject == '') { $subject = "Contact Form Submission"; }

     $mail = new PHPMailer(true);

      //Recipients
      $mail->setFrom($from, $from_name);
      $mail->addAddress($myEmail);     // Add a recipient
      $mail->addReplyTo($email, $name);

    // Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = $subject;
      $mail->Body    = $contact_message;
      $mail->AltBody = $contact_message;
     
      //send the message, check for errors
     if (!$mail->send()) {
       echo 'Mailer Error: '. $mail->ErrorInfo;
     } else {
       echo 'Message sent!';
     }

}
