<?php

namespace app\service;

interface MailerServiceInterface
{
    public function sendOTPMail($to, $username, $otp): bool;
}