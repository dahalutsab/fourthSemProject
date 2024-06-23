<?php
namespace app\service;


use app\dto\request\UserRequest;

interface UserServiceInterface {
    public function createUser(UserRequest $userRequest);

    public function getUserById($userId);

    public function getAllUsers();

    public function getUserByEmail($email);

    public function getNavbarDetails($userId);

    public function changePassword($data);

    public function blockUser($userId);
}
