<?php

namespace App\models;

use DateTime;
use DateTimeZone;

class User
{
    private int $id;
    private string $username;
    private string $email;
    private string $password;
    private int $role_id;
    private DateTime $createdDate;

    public function __construct($id, $username, $email, $password, $role_id)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role_id = $role_id;
        $this->createdDate = new DateTime();
        $this->createdDate->setTimezone(new DateTimeZone('Asia/Kathmandu'));
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
        return $this->role_id;
    }

    public function getCreatedDate(): \DateTime
    {
        return $this->createdDate;
    }


}