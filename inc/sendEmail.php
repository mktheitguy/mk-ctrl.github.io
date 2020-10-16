<?php
require("./PHPMailer-master/src/PHPMailer.php");
require("./PHPMailer-master/src/SMTP.php");
require("./PHPMailer-master/src/Exception.php");

// Replace this with your own email address
$myEmail = 'mk@mkhalid.ca';
$from = 'info@mkhalid.ca';
$from_name = 'Message from https://mkhalid.ca';


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

     $mail = new PHPMailer\PHPMailer\PHPMailer();

      //Recipients
      $mail->setFrom($from, $from_name);
      $mail->addAddress($myEmail);     // Add a recipient
      $mail->addReplyTo($email, $name);

      //Prepeare the body of the message with all the info
      $name = "<b>Contact Name:</b> " . $name;
      $email = "<b>Contact Email:</b> " . $email;
      $subject = "<b>Subject:</b> " . $subject;
      $contact_message = "<b>Message:</b> " . $contact_message;
      $contact_message = $name . "<br><br>" . $email . "<br><br>" . $subject . "<br><br>" . $contact_message;


    // Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = "Message from you MKHALID site";
      $mail->Body    = $contact_message;
      $mail->AltBody = $contact_message;
     
      //send the message, check for errors
     if (!$mail->send()) {
       echo 'Mailer Error: '. $mail->ErrorInfo;
     } else {
       echo 'Message sent!';
     }

}
