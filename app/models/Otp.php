<?php

namespace App\Models;

use DateTime;

class Otp
{
    private int $userId;
    private string $otp;
    private DateTime $createdDate;
    private DateTime $updatedDate;

    public function __construct($userId, $otp, $createdDate, $updatedDate)
    {
        $this->userId = $userId;
        $this->otp = $otp;
        $this->createdDate =$createdDate;
        $this->updatedDate = $updatedDate;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    public function getOtp(): string
    {
        return $this->otp;
    }

    public function setOtp($otp): void
    {
        $this->otp = $otp;
    }

    public function getCreatedDate(): DateTime
    {
        return $this->createdDate;
    }

    public function setCreatedDate($createdDate): void
    {
        $this->createdDate = $createdDate;
    }

    public function getUpdatedDate(): DateTime
    {
        return $this->updatedDate;
    }

    public function setUpdatedDate($updatedDate): void
    {
        $this->updatedDate = $updatedDate;
    }

}