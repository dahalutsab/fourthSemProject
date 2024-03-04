<?php
require_once '../models/User.php';
require_once '../vendor/autoload.php';

class UserService {
    private string $secretKey = "357638792F423F4428472B4B6250655368566D597133743677397A2443264629";

    public function __construct($secretKey) {
        $this->secretKey = $secretKey;
    }

    public function login($username, $password): array
    {
        // Validate user credentials
        $user = User::findByUsername($username);
        if (!$user || !password_verify($password, $user->getPasswordHash())) {
            return GlobalApiResponse::error('Invalid username or password');
        }

        // Generate JWT token
        $token = $this->generateToken($user->getId());

        return GlobalApiResponse::success('Login successful', ['token' => $token]);
    }

    public function logout(): array
    {
        // Logout logic (optional)
        return GlobalApiResponse::success('Logout successful');
    }

    private function generateToken($userId): string
    {
        // Generate JWT token using Firebase JWT library
        $tokenPayload = array(
            'user_id' => $userId,
            'exp' => time() + (60 * 60)  // Token expiration time (1 hour)
        );
        return Firebase\JWT\JWT::encode($tokenPayload, $this->secretKey);
    }
}
