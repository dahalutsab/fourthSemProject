<?php
namespace App\Controllers;


use App\Services\Implementation\UserService;

require_once __DIR__ . '/../../app/service/implementation/UserService.php';
class UserController {
    protected UserService $userService;

    public function __construct() {
        $this->userService = new UserService;
    }

    public function signup(): void
    {
        // Retrieve form data sent by the router
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $role = $_POST['role'] ?? '';

        // Perform basic validation
        if (empty($username) || empty($email) || empty($password) || empty($role)) {
            // Handle missing fields error
            echo "All fields are required.";
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Handle invalid email format error
            echo "Invalid email format.";
            return;
        }

        // Perform password strength validation
        if (strlen($password) < 8) {
            // Handle weak password error
            echo "Password must be at least 8 characters long.";
            return;
        }

        $this->userService->createUser($username, $email, $password, $role);
    }
}
