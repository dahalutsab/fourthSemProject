<?php

namespace App\Services;
use App\Models\User;

interface UserService
{
public function createUser(string $userName, string $email, string $password, string $accountType): User;

}
