<?php
namespace App\Services\Implementation;

use App\Repository\UserRepository;
use App\Service\AuthServiceInterface;

require_once __DIR__ . '/../../repository/implementation/UserRepository.php';

class AuthService implements AuthServiceInterface {
    protected UserRepository $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository;
    }

    public function login($email, $password): void
    {
        $user = $this->userRepository->getUserByEmail($email);

        if (!$user || !password_verify($password, $user->getPassword())) {
            echo "Invalid email or password.";
            return;
        }

        // Here you can handle session creation, JWT generation, etc.
        // For example:
        // $_SESSION['user_id'] = $user->id;
        // header('Location: /dashboard');
    }
}
