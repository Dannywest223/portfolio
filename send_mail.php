<?php
header("Access-Control-Allow-Origin: *");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start the session to store nonce
session_start();

// Generate a nonce for the current session
if (!isset($_SESSION['nonce'])) {
    $_SESSION['nonce'] = bin2hex(random_bytes(16)); // Generates a secure random nonce
}

// Set Content Security Policy with the generated nonce
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'nonce-{$_SESSION['nonce']}';");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master 2/src/Exception.php';
require 'PHPMailer-master 2/src/PHPMailer.php';
require 'PHPMailer-master 2/src/SMTP.php';

header('Content-Type: application/json'); // Ensure JSON response

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 0; // Change to 2 for detailed debug output

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'okorodannels95@gmail.com'; // Your email for sending
        $mail->Password = 'zycn bsjr qbcc bywn'; // Your App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Set the sender's email and name from user input
        $mail->setFrom($_POST["email"], $_POST["name"]); 
        $mail->addAddress('okorodannels95@gmail.com'); // Recipient's email
        $mail->addReplyTo($_POST["email"], $_POST["name"]); // User's email and name

        $mail->isHTML(true);
        $mail->Subject = 'Contact Form Submission'; // Default subject
        $mail->Body = $_POST["message"];

        $mail->send();
        
        // Return success response
        echo json_encode(['status' => 'success', 'message' => 'Email sent successfully.']);
    } catch (Exception $e) {
        // Return error response
        echo json_encode(['status' => 'error', 'message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
    }
} else {
    // Return error for invalid request method
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
