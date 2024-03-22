<?php

namespace App\dto\response;

class UserResponse {
    private int $id;
    private string $username;
    private string $email;
    private string $role;

    public function __construct(int $id, string $username, string $email, string $role) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->role = $role;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getRole(): string {
        return $this->role;
    }
}
