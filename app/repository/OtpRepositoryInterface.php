<?php

namespace app\repository;

use app\models\Otp;

interface OtpRepositoryInterface
{
    public function save(Otp $otp);

    public function find(string $email, string $otp): ?Otp;
}