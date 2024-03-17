<?php

namespace App\repository;

use App\models\Otp;

interface OtpRepositoryInterface
{
    public function save(Otp $otp);

    public function find(string $email, string $otp): ?Otp;
}