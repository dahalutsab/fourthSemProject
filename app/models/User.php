<?php

namespace App\models;

use App\dto\response\RoleResponse;
use DateTime;
use DateTimeZone;

class User
{
    private int $id;
    private string $username;
    private string $email;
    private string $password;
    private int $role;

    private DateTime $createdDate;
    private bool $isVerified;

    private bool $isActive;

    public function __construct($id, $username, $email, $password, $role_id, $isVerified, $isActive)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role_id;
        $this->createdDate = new DateTime();
        $this->createdDate->setTimezone(new DateTimeZone('Asia/Kathmandu'));
        $this->isVerified = $isVerified;
        $this->isActive = $isActive;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRoleId(): int
    {
        return $this->role;
    }

    public function getCreatedDate(): \DateTime
    {
        return $this->createdDate;
    }

    public function getIsVerified(): bool
    {
        return $this->isVerified;
    }

    public function getIsActive(): bool
    {
        return $this -> isActive;
    }


}