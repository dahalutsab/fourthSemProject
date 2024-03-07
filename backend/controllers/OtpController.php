<?php

namespace controllers;

use services\implementation\OtpServiceImplementation;
use services\OtpService;
use services\implementation\OtpServiceImpl;

class OtpController {
    private OtpService $otpService;

    public function __construct() {
        $this->otpService = new OtpServiceImplementation();
    }

    public function validateOtp(int $userId, string $otp): bool {
        return $this->otpService->validateOtp($userId, $otp);
    }
}
