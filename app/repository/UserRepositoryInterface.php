<?php
namespace App\repository;

interface UserRepositoryInterface {
    public function saveUser($username, $email, $password, $role);
}