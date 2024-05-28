<?php

namespace app\service;

interface AuthServiceInterface
{
    public function login($email, $password): void;
}