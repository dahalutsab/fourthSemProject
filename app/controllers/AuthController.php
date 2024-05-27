<?php
namespace App\controllers;

use App\service\implementation\AuthService;
use Exception;
use JetBrains\PhpStorm\NoReturn;

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
            $_SESSION[SESSION_ERRORS] = $errors;
            return;
        }

        try {
            $this->authService->login($email, $password);
            $_SESSION[SESSION_ROLE] = $this->authService->getUserRole($email);
        } catch (Exception $e) {
            $_SESSION[SESSION_ERRORS][] = $e->getMessage();
            header('Location: /login');
            return;
        }

        if ($_SESSION['redirect_to']) {
            header('Location: ' . $_SESSION['redirect_to']);
            unset($_SESSION['redirect_to']);
            return;
        }
        header('Location: /dashboard');
    }


    #[NoReturn] public function logout(): void
    {
        // Check if the user is logged in
        if (isset($_SESSION[SESSION_USER_ID])) {
            // Unset the specific session variable storing the user ID
            unset($_SESSION[SESSION_USER_ID]);
        }

        // Redirect to home page
        header('Location: /home');
        exit; // Always exit after redirecting
    }


}
