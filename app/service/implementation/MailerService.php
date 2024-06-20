<?php

namespace app\service\implementation;

use app\service\MailerServiceInterface;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class MailerService implements MailerServiceInterface
{
    private PHPMailer $mail;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->mail = new PHPMailer(true);

        // Configure email settings
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'dlutsab2120@gmail.com';
        $this->mail->Password = 'javk mohb zyfm wjfz';
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port = 587;

        $this->mail->setFrom('verify@openmichub.com','Open Mic Hub');
        $this->mail->isHTML();
    }

    public function sendOTPMail($to, $username, $otp): bool
    {
        try {
            ob_start(); // Start output buffering
            include __DIR__ . '/../../templates/email_template.html'; // Include the HTML file
            $html = ob_get_clean(); // Get the contents of the output buffer

            // Replace the placeholders with dynamic content
            $html = str_replace('{username}', $username, $html);
            $html = str_replace('{otp}', $otp, $html);
            date_default_timezone_set('Asia/Kathmandu');
            $currentDateTime = date('Y-m-d H:i:s');
            $html = str_replace('{currentDate}', $currentDateTime, $html);            $this->mail->addAddress($to);
            $this->mail->Subject = "Verify your email address";
            $this->mail->Body = $html;

            $this->mail->send();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function sendCommonMail(string $email, string $getUsername, string $link): bool
    {
        try {
            ob_start(); // Start output buffering
            include __DIR__ . '/../../templates/common_template.html'; // Include the HTML file
            $html = ob_get_clean(); // Get the contents of the output buffer

            // Replace the placeholders with dynamic content
            $html = str_replace('{username}', $getUsername, $html);
            $html = str_replace('{link}', $link, $html);
            date_default_timezone_set('Asia/Kathmandu');
            $currentDateTime = date('Y-m-d H:i:s');
            $html = str_replace('{currentDate}', $currentDateTime, $html);
            $this->mail->addAddress($email);
            $this->mail->Subject = "Reset your password";
            $this->mail->Body = $html;

            $this->mail->send();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

}