<?php
namespace app\repository;

use app\dto\request\UserRequest;

interface UserRepositoryInterface {
    public function saveUser(UserRequest $userRequest);
}