<?php
namespace App\Services\Implementation;


use App\Repository\UserRepository;
use App\Service\UserServiceInterface;

require_once __DIR__ . '/../../repository/implementation/UserRepository.php';
require_once __DIR__ . '/RoleService.php';

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