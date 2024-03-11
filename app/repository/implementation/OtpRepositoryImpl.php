<?php

namespace App\Repository;

use App\Models\Otp;

require_once 'config/Database.php';
class OtpRepositoryImpl implements OtpRepository
{
    public function save(Otp $otp)
    {
        // Save the OTP to the database
        // This is a placeholder. Replace with your actual database saving logic.
    }
}