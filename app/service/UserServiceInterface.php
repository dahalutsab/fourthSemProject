<?php
namespace app\service;


use app\dto\request\UserRequest;

interface UserServiceInterface {
    public function createUser(UserRequest $userRequest);

    public function getUserById($userId);
}
