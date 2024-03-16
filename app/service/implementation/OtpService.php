<?php

namespace App\service\implementation;

use App\Models\Otp;
use App\Repository\implementation\OtpRepository;
use App\service\OtpServiceInterface;
use DateTime;

require_once __DIR__ . '/MailerService.php';
require_once __DIR__ . '/../../repository/implementation/OtpRepository.php';

class OtpService implements OtpServiceInterface
{
    protected MailerService $mailerService;
    protected OtpRepository $otpRepository;
    public function __construct()
    {
        $this->mailerService = new MailerService;
        $this->otpRepository = new OtpRepository;
    }
    public function generateOtp (): int
    {
        return (rand(100000, 999999));
    }

    public function saveOtp ($otp, $email): void
    {
        $createdAt = new DateTime();
        $expiry = $createdAt -> modify('+ 5 minutes');
        $otp = new Otp($email, $otp, $createdAt, $expiry);
        $this->otpRepository->save($otp);
    }

    public function sendOtp ($to, $otp): bool
    {
        // Start the session if it's not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Store the email in a session variable
        $_SESSION['email'] = $to;

        $this->mailerService->sendMail($to, $otp, "Your OTP is: " . $otp);
        return true;
    }

    public function verifyOtp ($userId): bool
    {
        return $this->otpRepository->verifyUserOtp($userId);
    }
}