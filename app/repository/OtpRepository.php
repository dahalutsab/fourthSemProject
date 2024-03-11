<?php

namespace App\Repository;

use App\Models\Otp;

interface OtpRepository
{
    public function save(Otp $otp);
}