<?php
namespace App\service\implementation;


use App\repository\implementation\UserRepository;
use App\Service\UserServiceInterface;


class UserService implements UserServiceInterface {
    protected UserRepository $userRepository;
    protected RoleService $roleService;

    public function __construct() {
        $this->userRepository = new UserRepository;
        $this->roleService = new RoleService;
    }


    public function createUser($username, $email, $password, $role): void
    {
        if (!$this->roleService->validateRole($role)) {
            echo "Invalid role.";
            return;
        }
        $this->userRepository->saveUser($username, $email, $password, $role);
    }

    public function getUserId(string $email)
    {
        return $this->userRepository->getUserId($email);
    }

}