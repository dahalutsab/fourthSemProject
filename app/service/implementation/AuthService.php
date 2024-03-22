<?php
namespace App\service\implementation;

use App\repository\implementation\UserRepository;
use App\service\AuthServiceInterface;
use Exception;

require_once __DIR__ . '/../../repository/implementation/UserRepository.php';

class AuthService implements AuthServiceInterface {
    protected UserRepository $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository;
    }

    /**
     * @throws Exception
     */
    public function login($email, $password): void
    {
        $user = $this->userRepository->getUserByEmail($email);

        if (!$user || !password_verify($password, $user->getPassword())) {
            throw new Exception("Invalid email or password.");
        }
        $_SESSION[SESSION_USER_ID] = $user->getId();

    }
}
