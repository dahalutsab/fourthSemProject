<?php
namespace App\Controllers;

use App\Services\Implementation\AuthService;
use Exception;

require_once __DIR__ . '/../../app/service/implementation/AuthService.php';

class AuthController {
    protected AuthService $authService;

    public function __construct() {
        $this->authService = new AuthService;
    }

    public function login(): void
    {
        // Retrieve form data sent by the router
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // Initialize an error array
        $errors = [];

        // Perform basic validation
        if (empty($email) || empty($password)) {
            // Handle missing fields error
            $errors[] = "All fields are required.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Handle invalid email format error
            $errors[] = "Invalid email format.";
        }

        // Store errors in session if any
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            return;
        }

        try {
            if($this->authService->login($email, $password)) {
                // Redirect to dashboard or any other page
                header('Location: /home');
            };
        } catch (Exception $e) {
            // Store error message in session
            var_dump($e->getMessage());
            $_SESSION['errors'][] = $e->getMessage();
            header('Location: /login');
            return;
        }
    }


}
