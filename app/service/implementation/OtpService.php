<?php

namespace App\service\implementation;

use App\Repository\implementation\OtpRepository;
use App\service\OtpServiceInterface;

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
        return rand(100000, 999999);
    }

    public function sendOtp ($to, $otp): bool
    {
        $this->mailerService->sendMail($to, $otp, "Your OTP is: " . $otp);
        return true;
    }

    public function verifyOtp ($otp, $email): bool
    {
        return $this->otpRepository->verifyUserOtp($otp, $email);
    }
}