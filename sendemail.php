<?php

// Include PHPMailer library
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Define recipient details
define("RECIPIENT_NAME", "Pradeep");
define("RECIPIENT_EMAIL", "artistthikarforever@gmail.com");

// Read the form values
$success = false;
$userName = isset($_POST['name']) ? $_POST['name'] : "";
$senderEmail = isset($_POST['email']) ? $_POST['email'] : "";
$message = isset($_POST['message']) ? $_POST['message'] : "";

// If all values exist, send the email
if ($userName && $senderEmail && $message) {
    try {
        $mail = new PHPMailer();

        // Set mailer to use SMTP
        $mail->isSMTP();

        // Configure SMTP settings
        $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'artistthikarforever@gmail.com'; // SMTP username
        $mail->Password = 'tmjklcfuohblfkre'; // SMTP password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587; // TCP port to connect to

        // Set sender and recipient
        $mail->setFrom($senderEmail, $userName);
        $mail->addAddress(RECIPIENT_EMAIL, RECIPIENT_NAME);

        // Set email content
        $mail->Subject = 'Contact Form Submission';
        $mail->Body = "Name: $userName\nEmail: $senderEmail\nMessage: $message";

        // Send the email
        if ($mail->send()) {
            // Redirect after successful submission
            header('Location: contact.html?message=Successfull');
            exit();
        } else {
            // Redirect after unsuccessful submission
            header('Location: contact.html?message=Failed');
            exit();
        }
    } catch (Exception $e) {
        // Handle any exceptions/errors that occurred during sending
        header('Location: contact.html?message=Failed');
        exit();
    }
} else {
    // Redirect if any required form field is missing
    header('Location: contact.html?message=Failed');
    exit();
}
?>
