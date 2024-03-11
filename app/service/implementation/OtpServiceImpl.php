<?php

namespace App\Services\implementation;

use App\Models\Otp;
use App\Repository\OtpRepository;
use App\Services\OtpService;
use Exception;

class OtpServiceImpl implements OtpService
{
    private OtpRepository $otpRepository;

    public function __construct(OtpRepository $otpRepository)
    {
        $this->otpRepository = $otpRepository;
    }

    public function generateOtp(int $userId): string
    {
        $code = $this->generateRandomCode(); // Replace with actual code generation
        $this->otpRepository->save(new Otp($userId, $code));
        return $code;
    }

    /**
     * @throws Exception
     */
    public function validateOtp(int $userId, string $code): bool
    {
        $otp = $this->otpRepository->findByUserId($userId);
        if ($otp && $otp->getOtp() === $code) {
            // OTP validation logic (e.g., remove OTP from storage)
            return true;
        }
        return false;
    }

    private function generateRandomCode(): int
    {
        // generate 6 digit otp
        return rand(100000, 999999);
    }
}