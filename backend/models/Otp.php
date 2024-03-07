<?php

namespace models;

class Otp {
    private ?int $id;
    private int $userId;
    private string $otp;
    private string $expiresAt;

    public function __construct(int $userId, string $otp, string $expiresAt, ?int $id = null) {
        $this->userId = $userId;
        $this->otp = $otp;
        $this->expiresAt = $expiresAt;
        $this->id = $id;
    }

    // Getters and setters
    public function getId(): ?int {
        return $this->id;
    }

    public function getUserId(): int {
        return $this->userId;
    }

    public function setUserId(int $userId): void {
        $this->userId = $userId;
    }

    public function getOtp(): string {
        return $this->otp;
    }

    public function setOtp(string $otp): void {
        $this->otp = $otp;
    }

    public function getExpiresAt(): string {
        return $this->expiresAt;
    }

    public function setExpiresAt(string $expiresAt): void {
        $this->expiresAt = $expiresAt;
    }

}