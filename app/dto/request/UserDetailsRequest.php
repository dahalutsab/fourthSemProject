<?php

namespace App\dto\request;

class UserDetailsRequest
{
    private string $fullName;
    private string $stageName;
    private string $phone;
    private string $address;
    private string $talentType;
    private string $bio;
    private string $description;

    public function __construct(
        string $fullName,
        string $stageName,
        string $phone,
        string $address,
        string $talentType,
        string $bio,
        string $description
    ) {
        $this->fullName = $fullName;
        $this->stageName = $stageName;
        $this->phone = $phone;
        $this->address = $address;
        $this->talentType = $talentType;
        $this->bio = $bio;
        $this->description = $description;
    }

    // Getter methods for each property

    public function getFullName(): string
    {
        return $this->fullName;
    }

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

    public function getTalentType(): string
    {
        return $this->talentType;
    }

    public function getBio(): string
    {
        return $this->bio;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
