<?php
header("Access-Control-Allow-Origin: *");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master 2/src/Exception.php';
require 'PHPMailer-master 2/src/PHPMailer.php';
require 'PHPMailer-master 2/src/SMTP.php';

$response_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data safely
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $number = htmlspecialchars($_POST['number']);
    $message = htmlspecialchars($_POST['message']);

    // PHPMailer setup
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 0; // Set to 2 for detailed debug output
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'okorodannels95@gmail.com'; // Your email
        $mail->Password = 'zycn bsjr qbcc bywn'; // Your App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Set sender and recipient
        $mail->setFrom($email, $name); 
        $mail->addAddress('okorodannels95@gmail.com'); // Your email
        $mail->addReplyTo($email, $name); // User's email and name

        // Email content
        $mail->isHTML(true);
        $mail->Subject = "New message from $name";
        $mail->Body = "Name: $name<br>Email: $email<br>Number: $number<br>Message: $message";

        // Send email
        $mail->send();
        $response_message = "Thank you, $name! Your message has been received.";
    } catch (Exception $e) {
        $response_message = "There was an error sending your message. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    $response_message = "Something went wrong. Please try again.";
}

// Return the response message as plain text
echo $response_message;
?>
