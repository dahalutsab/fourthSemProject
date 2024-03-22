<?php

namespace App\service;

interface MailerServiceInterface
{
    public function sendMail($to, $username, $otp): bool;
}