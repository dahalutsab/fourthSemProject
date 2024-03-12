<?php

namespace App\Models;

class User
{
    private int $id;
    private string $username;
    private string $email;
    private string $password;
    private int $accountType;
    private \DateTime $createdDate;
//    private $updatedDate;

    public function __construct($username, $email, $password, $accountType)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->accountType = $accountType;
        $this->createdDate = new \DateTime();
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

    public function getAccountType(): int
    {
        return $this->accountType;
    }

    public function getCreatedDate(): \DateTime
    {
        return $this->createdDate;
    }


}