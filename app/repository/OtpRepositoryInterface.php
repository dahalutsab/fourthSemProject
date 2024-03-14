<?php

namespace App\Repository;

use App\Models\Otp;

interface OtpRepositoryInterface
{
    public function save(Otp $otp);

    public function find(string $email, string $otp): ?Otp;
}