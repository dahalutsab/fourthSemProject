<?php

namespace controllers;

use models\User;
use services\UserService;
use services\UserServiceImplementation;

class UserController {

    private UserServiceImplementation $userService;

    public function __construct() {
        $this->userService = new UserServiceImplementation();
    }

    public function createUser(User $user): bool {
        return $this->userService->createUser($user);
    }

    public function getUserById(int $id): ?User {
        return $this->userService->getUserById($id);
    }

    public function updateUser(User $user): bool {
        return $this->userService->updateUser($user);
    }

    public function deleteUser(int $id): bool {
        return $this->userService->deleteUser($id);
    }
}
