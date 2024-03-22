<?php
namespace App\middleware;

class AuthMiddleware
{
    public static function authenticate(): bool
    {
        return isset($_SESSION[SESSION_USER_ID]);
    }
}

