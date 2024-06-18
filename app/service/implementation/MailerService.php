<?php
namespace app\service\implementation;

use app\service\MailerServiceInterface;
use Exception;

class MailerService implements MailerServiceInterface
{
    private $from;
    private $fromName;
    private $username;
    private $password;

    public function __construct()
    {
        $this->from = 'verify@openmichub.com';
        $this->fromName = 'Open Mic Hub';
        $this->username = 'dlutsab2120@gmail.com';
        $this->password = 'javk mohb zyfm wjfz';
    }

    public function asyncSendEmail($to, $subject, $body): void
    {
        $command = sprintf(
            'php %s/../../scripts/send_email.php %s %s %s %s %s %s %s > /dev/null 2>&1 &',
            __DIR__,
            escapeshellarg($to),
            escapeshellarg($subject),
            escapeshellarg($body),
            escapeshellarg($this->from),
            escapeshellarg($this->fromName),
            escapeshellarg($this->username),
            escapeshellarg($this->password)
        );
        shell_exec($command);
    }

    public function sendOTPMail($to, $username, $otp): bool
    {
        try {
            ob_start();
            include __DIR__ . '/../../templates/email_template.html';
            $html = ob_get_clean();

            $html = str_replace('{username}', $username, $html);
            $html = str_replace('{otp}', $otp, $html);
            date_default_timezone_set('Asia/Kathmandu');
            $currentDateTime = date('Y-m-d H:i:s');
            $html = str_replace('{currentDate}', $currentDateTime, $html);

            $this->asyncSendEmail($to, 'Verify your email address', $html);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function sendCommonMail($to, $username, $subject, $message): bool
    {
        try {
            ob_start();
            include __DIR__ . '/../../templates/common_template.html';
            $html = ob_get_clean();

            $html = str_replace('{username}', $username, $html);
            $html = str_replace('{subject}', $subject, $html);
            $html = str_replace('{body}', $message, $html);
            date_default_timezone_set('Asia/Kathmandu');
            $currentDateTime = date('Y-m-d H:i:s');
            $html = str_replace('{currentDate}', $currentDateTime, $html);

            $this->asyncSendEmail($to, $subject, $html);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
