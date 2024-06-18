<?php

namespace app\service;

interface MailerServiceInterface
{
    public function asyncSendEmail($to, $subject, $body): void;
    public function sendOTPMail($to, $username, $otp): bool;

    public function sendCommonMail($to, $username, $subject, $message): bool;
}