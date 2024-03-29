<?php

namespace App\dto\request;

class UserDetailsRequest
{
    private string $stageName;
    private string $phone;
    private string $address;
    private string $categoryID;
    private string $bio;
    private string $description;
    private int $userId;

    public function __construct(
        string $stageName,
        string $phone,
        string $address,
        string $categoryID,
        string $bio,
        string $description,
        int $userId
    ) {
        $this->stageName = $stageName;
        $this->phone = $phone;
        $this->address = $address;
        $this->categoryID = $categoryID;
        $this->bio = $bio;
        $this->description = $description;
        $this-> userId = $userId;
    }

    // Getter methods for each property


    public function getStageName(): string
    {
        return $this->stageName;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getCategoryID(): string
    {
        return $this->categoryID;
    }

    public function getBio(): string
    {
        return $this->bio;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}
