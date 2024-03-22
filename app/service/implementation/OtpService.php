<?php

namespace App\service\implementation;

use App\Models\Otp;
use App\repository\implementation\OtpRepository;
use App\service\OtpServiceInterface;


class OtpService implements OtpServiceInterface
{
    protected MailerService $mailerService;
    protected UserService $userService;
    protected OtpRepository $otpRepository;
    public function __construct()
    {
        $this->mailerService = new MailerService;
        $this->userService = new UserService;
        $this->otpRepository = new OtpRepository;
    }
    public function generateOtp (): int
    {
        return (rand(100000, 999999));
    }

    public function saveOtp ($otp, $email): void
    {
        $userId = $this->userService->getUserId($email);
        $otp = new Otp($userId, $otp);
        $this->otpRepository->save($otp);
    }

    public function sendOtp ($to, $username): bool
    {
        $otp = $this->generateOtp();
        // Start the session if it's not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Store the email in a session variable
        $_SESSION[SESSION_EMAIL] = $to;
        $this->saveOtp($otp, $to);

        $this->mailerService->sendMail($to,$username, $otp );
        return true;
    }

    public function verifyOtp ($userId, $otp): bool
    {
        return $this->otpRepository->verifyUserOtp($userId, $otp);
    }
}