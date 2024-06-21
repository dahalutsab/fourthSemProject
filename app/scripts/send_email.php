<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../vendor/autoload.php'; // Adjust path as needed

function sendEmail($to, $toUserName,  $subject, $message): void
{
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'dlutsab2120@gmail.com';
        $mail->Password = 'javk mohb zyfm wjfz';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('verify@openmichub.com', 'Open Mic Hub');

        // Content
        $mail->isHTML(true);

        ob_start(); // Start output buffering
        include __DIR__ . '/../templates/async_common_mail.html';
        $html = ob_get_clean();

        // Replace the placeholders with dynamic content
        $html = str_replace('{username}', $toUserName, $html);
        $html = str_replace('{body}', $message, $html);
        $html = str_replace('{subject}', $subject, $html);
        date_default_timezone_set('Asia/Kathmandu');
        $currentDateTime = date('Y-m-d H:i:s');
        $html = str_replace('{currentDate}', $currentDateTime, $html);
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $html;

        $mail->send();

    } catch (Exception $e) {
        error_log('Mailer Error: ' . $mail->ErrorInfo);
    }
}

$toEmail = $argv[1];
$toUsername = $argv[2];
$subject = $argv[3];
$message = $argv[4];

sendEmail($toEmail, $toUsername, $subject, $message);
