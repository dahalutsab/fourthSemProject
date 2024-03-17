<?php

namespace App\models;

use DateTime;
use DateTimeZone;

class Otp
{
    private int $userId;
    private string $otp;
    private DateTime $createdDate;
    private DateTime $expiresAt;

    public function __construct($userId, $otp)
    {
        $this->userId = $userId;
        $this->otp = $otp;
        $this->createdDate =new DateTime();
        $this->createdDate->setTimezone(new DateTimeZone('Asia/Kathmandu'));
        $this->expiresAt = $this->createdDate -> modify('+ 5 minutes');
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

    public function getExpiresAt(): DateTime
    {
        return $this->expiresAt;
    }

    public function setExpiresAt($expiresAt): void
    {
        $this->expiresAt = $expiresAt;
    }

}