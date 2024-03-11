<?php

namespace App\Services;

interface OtpService
{
    public function generateOtp(int $userId): string; // Optional for OTP generation outside signup
    public function validateOtp(int $userId, string $code): bool;
}
