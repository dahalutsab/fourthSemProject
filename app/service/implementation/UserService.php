<?php
namespace App\Services\Implementation;


use App\Repository\UserRepository;
use App\Service\UserServiceInterface;

require_once __DIR__ . '/../../repository/implementation/UserRepository.php';

class UserService implements UserServiceInterface {
    protected UserRepository $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository;
    }

    public function createUser($username, $email, $password, $accountType): void
    {
        $this->userRepository->saveUser($username, $email, $password, $accountType);
    }

}