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
        $user = $this->userRepository->getUserByColumnValue('email', $email);
        if ($user==null) {
            throw new Exception("User doesnt exist");
        }

        if(!$user->getIsVerified()) {
            throw new Exception("Please verify your email to login.");
        }
        if(!$user->getIsActive()) {
            throw new Exception("User account doesnt exist. Please create a new account to continue.");
        }
        if (!password_verify($password, $user->getPassword())) {
            throw new Exception("Invalid email or password.");
        }
        $_SESSION[SESSION_USER_ID] = $user->getId();
        $_SESSION[SESSION_ROLE] = $user->getRole();
    }
}
