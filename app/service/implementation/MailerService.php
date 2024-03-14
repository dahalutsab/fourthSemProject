<?php

namespace App\service\implementation;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class MailerService
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
        $this->mail->Host = 'smtp.google.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'dlutsab2120@gmail.com.com';
        $this->mail->Password = 'password';
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port = 587;

        $this->mail->setFrom('noreply@openmichub.com', 'Open Mic Hub');
        $this->mail->isHTML(true);
    }

    public function sendMail($to, $subject, $body): bool
    {
        try {
            $this->mail->addAddress($to);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;

            $this->mail->send();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

}