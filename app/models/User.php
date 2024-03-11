<?php

namespace App\Models;

class User
{
    private $username;
    private $email;
    private $password;
    private $accountType;
    private $createdDate;
    private $updatedDate;
    private $otp;

    public function __construct($username, $email, $password, $accountType)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->accountType = $accountType;
        $this->createdDate = new \DateTime();
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getAccountType()
    {
        return $this->accountType;
    }

    public function getCreatedDate(): \DateTime
    {
        return $this->createdDate;
    }

    public function getUpdatedDate()
    {
        return $this->updatedDate;
    }

    public function setOtp($otp)
    {
        $this->otp = $otp;
    }

    public function getOtp()
    {
        return $this->otp;
    }
}