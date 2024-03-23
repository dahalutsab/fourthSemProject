<?php
namespace App\service\implementation;


use App\dto\request\UserRequest;
use App\repository\implementation\UserRepository;
use App\Service\UserServiceInterface;
use InvalidArgumentException;


class UserService implements UserServiceInterface {
    protected UserRepository $userRepository;
    protected RoleService $roleService;

    public function __construct() {
        $this->userRepository = new UserRepository;
        $this->roleService = new RoleService;
    }


    public function createUser(UserRequest $userRequest): bool
    {
        if (!$this->roleService->validateRole($userRequest->getRole())) {
            throw new InvalidArgumentException("Invalid role");
        }
        if($this->userRepository->getUserByColumnValue('username', $userRequest->getUsername())){
            throw new InvalidArgumentException("User with the same username already exists");

        }
        if($this->userRepository->getUserByColumnValue('email', $userRequest->getEmail())){
            throw new InvalidArgumentException("User with the same email already exists");
        }
        $this->userRepository->saveUser($userRequest);
        return true;
    }

    public function getUserId(string $email)
    {
        return $this->userRepository->getUserId($email);
    }

    public function setUserVerificationTrue($userId): bool
    {
        return $this->userRepository->setUserVerificationTrue($userId);
    }

}