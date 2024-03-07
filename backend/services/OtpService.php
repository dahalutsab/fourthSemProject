<?php

namespace services;

interface OtpService {
    public function saveOtp(int $userId, string $otp, string $expiresAt): bool;
    public function validateOtp(int $userId, string $otp): bool;
}
