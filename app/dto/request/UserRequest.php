<?php

namespace App\dto\request;
class UserRequest {
    private string $username;
    private string $email;
    private string $password;
    private string $role;

    public function __construct($formData) {
        $this->username = $formData['username'];
        $this->email = $formData['email'];
        $this->password = $formData['password'];
        $this->role = $formData['role'];
//        $this->username = $username;
//        $this->email = $email;
//        $this->password = $password;
//        $this->role = $role;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getRole(): string {
        return $this->role;
    }
}
