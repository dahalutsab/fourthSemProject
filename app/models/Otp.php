<?php

namespace app\models;

use DateTime;
use DateTimeZone;
use Exception;

class Otp
{
    private int $userId;
    private string $otp;
    private DateTime $createdDate;
    private DateTime $expiresAt;

    /**
     * @throws Exception
     */
    public function __construct($userId, $otp)
    {
        $this->userId = $userId;
        $this->otp = $otp;

        // Set createdDate and expiresAt in Nepal Time
        $this->createdDate = new DateTime('now', new DateTimeZone('Asia/Kathmandu'));
        $this->expiresAt = (clone $this->createdDate)->modify('+5 minutes');
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