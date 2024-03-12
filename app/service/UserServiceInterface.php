<?php
namespace App\Service;

interface UserServiceInterface {
    public function createUser($username, $email, $password, $accountType);
}
