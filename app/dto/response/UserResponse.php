<?php

namespace app\dto\response;

use app\models\User;

class UserResponse
{
    private int $id;
    private string $username;
    private string $email;
    private int $role;
    private bool $isVerified;

    private bool $isBlocked;

    public function __construct(User $user) {
        $this->id = $user->getId();
        $this->username = $user->getUsername();
        $this->email = $user->getEmail();
        $this->role = $user->getRoleId();
        $this->isVerified = $user->getIsVerified();
        $this->isBlocked = $user->getIsBlocked();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'username' => $this->getUsername(),
            'email' => $this->getEmail(),
            'role' => $this->getRole(),
            'isVerified' => $this->getIsVerified(),
            'isBlocked' => $this->getISBlocked()
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

    private function getISBlocked(): bool
    {
        return $this->isBlocked;
    }


}