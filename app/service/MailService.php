<?php

namespace App\Services;

interface MailService
{

    public function sendMail(mixed $email, string $string, string $string1);
}