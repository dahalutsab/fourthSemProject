<?php

namespace app\service;

interface OtpServiceInterface
{
    public function generateOtp (): int;

    public function sendOtp ($to, $username): bool;
}