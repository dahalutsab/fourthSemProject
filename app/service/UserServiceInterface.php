<?php
namespace App\service;


use App\dto\request\UserRequest;

interface UserServiceInterface {
    public function createUser(UserRequest $userRequest);

    public function getUserById($userId);
}
