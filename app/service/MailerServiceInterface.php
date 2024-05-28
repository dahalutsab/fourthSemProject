<?php

namespace app\service;

interface MailerServiceInterface
{
    public function sendMail($to, $username, $otp): bool;
}