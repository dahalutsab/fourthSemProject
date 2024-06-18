<?php

use PHPMailer\PHPMailer\PHPMailer;

require __DIR__ . '/../vendor/autoload.php'; // Adjust path as needed

function sendEmail($to, $subject, $body, $from, $fromName, $username, $password): void
{
    $mail = new PHPMailer(true);

    try {
        // Configure email settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom($from, $fromName);
        $mail->addAddress($to);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
    } catch (Exception $e) {
        error_log('Mailer Error: ' . $mail->ErrorInfo);
    }
}

// Get the parameters from the command line
$to = $argv[1];
$subject = $argv[2];
$body = $argv[3];
$from = $argv[4];
$fromName = $argv[5];
$username = $argv[6];
$password = $argv[7];

sendEmail($to, $subject, $body, $from, $fromName, $username, $password);
