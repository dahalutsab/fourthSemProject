<?php
require __DIR__ . '/../../vendor/autoload.php'; // Adjust path as needed

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer(true);

// SMTP Configuration
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'dlutsab2120@gmail.com';
$mail->Password = 'javk mohb zyfm wjfz';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Email Settings
$mail->setFrom('dlutsab2120@gmail.com', 'Mailer');
$mail->addAddress('dlutsab2120@yopmail.com', 'Utsab Dahal'); // Add a recipient
$mail->isHTML(true); // Set email format to HTML
$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

try {
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}