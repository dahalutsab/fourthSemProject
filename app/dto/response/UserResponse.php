<?php

namespace App\dto\response;

use App\models\User;

class UserResponse
{
    private int $id;
    private string $username;
    private string $email;
    private int $role;
    private bool $isVerified;

    public function __construct(User $user) {
        $this->id = $user->getId();
        $this->username = $user->getUsername();
        $this->email = $user->getEmail();
        $this->role = $user->getRoleId();
        $this->isVerified = $user->getIsVerified();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'username' => $this->getUsername(),
            'email' => $this->getEmail(),
            'role' => $this->getRole(),
            'isVerified' => $this->getIsVerified(),
        ];
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

    public function getRole(): int {
        return $this->role;
    }

    public function getIsVerified(): bool {
        return $this->isVerified;
    }


}