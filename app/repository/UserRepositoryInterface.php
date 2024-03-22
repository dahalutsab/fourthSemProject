<?php
namespace App\repository;

use App\dto\request\UserRequest;

interface UserRepositoryInterface {
    public function saveUser(UserRequest $userRequest);
}