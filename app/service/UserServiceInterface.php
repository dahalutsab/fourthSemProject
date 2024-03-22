<?php
namespace App\service;

interface UserServiceInterface {
    public function createUser($username, $email, $password, $role);
}
