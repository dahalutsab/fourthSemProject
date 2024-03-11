<?php

namespace App\Controllers;

use App\Services\UserService;

class UserController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function signup(): void
    {
        // Validate form data
        // ...

        // Delegate the business logic to the UserService
        $this->userService->createUser($_POST);

        // Redirect to otp.php
        header('Location: /otp');
    }

    public function verifyOtp(): void
    {
        // Delegate the OTP verification to the UserService
        if ($this->userService->verifyOtp($_POST['otp'])) {
            // OTP is correct, redirect to the login page
            header('Location: /login');
        } else {
            // OTP is incorrect, redirect back to otp.php with an error message
            $_SESSION['error'] = 'Incorrect OTP. Please try again.';
            header('Location: /otp');
        }
    }
}