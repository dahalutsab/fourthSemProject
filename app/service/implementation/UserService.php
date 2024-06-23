<?php
namespace app\service\implementation;


use app\dto\request\UserRequest;
use app\dto\response\UserResponse;
use app\repository\implementation\UserRepository;
use app\service\UserServiceInterface;
use Exception;
use InvalidArgumentException;


class UserService implements UserServiceInterface {
    protected UserRepository $userRepository;
    protected RoleService $roleService;

    public function __construct() {
        $this->userRepository = new UserRepository;
        $this->roleService = new RoleService;
    }


    public function createUser(UserRequest $userRequest): UserResponse
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
        $userResponse = $this->userRepository->saveUser($userRequest);

        return new UserResponse($userResponse);
    }

    public function getUserId(string $email)
    {
        return $this->userRepository->getUserId($email);
    }

    public function setUserVerificationTrue($userId): bool
    {
        return $this->userRepository->setUserVerificationTrue($userId);
    }

    /**
     * @throws Exception
     */
    public function getUserById($userId): UserResponse
    {
        return new UserResponse($this->userRepository->getUserById($userId));
    }

    public function getAllUsers(): array
    {
        $users = $this->userRepository->getAllUsers();
        return array_map(function ($user) {
            $userResponse = new UserResponse($user);
            return $userResponse->toArray();
        }, $users);
    }

    public function getUserByEmail($email): UserResponse
    {
        return new UserResponse($this->userRepository->getUserByColumnValue('email', $email));
    }

    public function getNavbarDetails($userId): array
    {
        return $this->userRepository->getNavbarDetails($userId);
    }

}