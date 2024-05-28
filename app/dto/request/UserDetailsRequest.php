<?php

namespace app\dto\request;

class UserDetailsRequest
{
    private ?int $userId;
    private ?string $fullName;
    private ?string $phone;
    private ?string $address;
    private ?string $bio;

    public function __construct(
        ?int $userId,
        ?string $fullName,
        ?string $phone,
        ?string $address,
        ?string $bio
    ) {
        $this->userId = $userId;
        $this->fullName = $fullName;
        $this->phone = $phone;
        $this->address = $address;
        $this->bio = $bio;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(?string $fullName): void
    {
        $this->fullName = $fullName;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }



    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): void
    {
        $this->bio = $bio;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }


}