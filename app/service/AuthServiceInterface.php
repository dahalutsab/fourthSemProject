<?php

namespace App\service;

interface AuthServiceInterface
{
    public function login($email, $password): void;
}