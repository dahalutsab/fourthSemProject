<?php
namespace App\Repository;

interface UserRepositoryInterface {
    public function saveUser($username, $email, $password, $accountType);
}