<?php

namespace app\service\implementation;

require __DIR__ . '/../../../vendor/autoload.php'; // Adjust path as needed

use app\repository\implementation\TransactionRepository;
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

        $this->mail->setFrom('verify@openmichub.com', 'Open Mic Hub');
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
            $html = str_replace('{currentDate}', $currentDateTime, $html);
            $this->mail->addAddress($to);
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

    public function sendAsyncMail(string $toEmail, string $toUserName, string $subject, string $message): void
    {
        $toEmail = escapeshellarg($toEmail);
        $toUserName = escapeshellarg($toUserName);
        $subject = escapeshellarg($subject);
        $message = escapeshellarg($message);

        $command = "php " . __DIR__ . "/../../scripts/send_email.php $toEmail $toUserName $subject $message > /dev/null 2>&1 &";
        shell_exec($command);
    }

    public function sendPaymentConfirmation(mixed $bookingId): void
    {
        $paymentRepo = new TransactionRepository();
        $paymentDetails = $paymentRepo->getUserPaymentInfoForMail($bookingId);

        $userEmail = $paymentDetails['userEmail'];
        $userName = $paymentDetails['userName'];
        $artistEmail = $paymentDetails['artistEmail'];
        $artistName = $paymentDetails['artistName'];
        $artistUserName = $paymentDetails['artistName'];
        $advanceAmount = $paymentDetails['advance_amount'];
        $totalCost = $paymentDetails['total_cost'];
        $remainingAmount = $paymentDetails['remaining_amount'];
        $eventDate = $paymentDetails['event_date'];
        $eventStartTime = $paymentDetails['event_start_time'];
        $eventEndTime = $paymentDetails['event_end_time'];

        $subject = "Payment Confirmation";
        $artistMessage = "You have received a payment of NPR $advanceAmount for event on $eventDate from $eventStartTime to $eventEndTime . <br> The total cost of the event is NPR $totalCost. <br> The remaining amount to be received after event is NPR $remainingAmount.<br> You can view the details of the event in your dashboard. <br><br> Regards, <br> Open Mic Hub";

        $userMessage = "You have successfully made a payment of NPR $advanceAmount for event on $eventDate from $eventStartTime to $eventEndTime .<br> The total cost of the event is NPR $totalCost. <br> The remaining amount to be paid after event is NPR $remainingAmount.<br> You can view the details of the event in your dashboard. <br><br> Regards, <br> Open Mic Hub";

        $this->sendAsyncMail($artistEmail, $artistUserName, $subject, $artistMessage);
        $this->sendAsyncMail($userEmail, $userName, $subject, $userMessage);
    }

    /**
     * @throws Exception
     */
    public function sendMail(string $getEmail, string $subject, string $message): void
    {
        $this->mail->addAddress($getEmail);
        $this->mail->Subject = $subject;
        $this->mail->Body = $message;

        $this->mail->send();
    }
}