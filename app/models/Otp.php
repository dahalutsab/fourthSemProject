<?php

namespace App\Models;

class Otp
{
    private $userId;
    private $otp;
    private $createdDate;

    public function __construct($userId, $otp)
    {
        $this->userId = $userId;
        $this->otp = $otp;
        $this->createdDate = new \DateTime();
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    public function getOtp()
    {
        return $this->otp;
    }

    public function setOtp($otp): void
    {
        $this->otp = $otp;
    }

    public function getCreatedDate(): \DateTime
    {
        return $this->createdDate;
    }

}