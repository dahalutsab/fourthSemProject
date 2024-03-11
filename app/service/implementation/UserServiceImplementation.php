<?php

namespace App\Services\implementation;

use App\Models\User;
use App\Repository\UserRepository;
use App\Services\UserService;
use Exception;

class UserServiceImpl implements UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(string $userName, string $email, string $password, string $accountType): User
    {
        $user = new User($userName, $email, $password, $accountType);

        // Generate and store OTP (assuming OTP verification is needed)
        $user->setOtp($this->generateRandomCode()); // Replace with actual code generation

        $this->userRepository->saveWithOtp($user);

        return $user;
    }

    private function generateRandomCode(): int
    {
        // generate 6 digit otp
        return rand(100000, 999999);
    }
}