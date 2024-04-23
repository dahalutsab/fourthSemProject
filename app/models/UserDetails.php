<?php

namespace App\models;

class UserDetails
{
    private ?int $id;
    private ?string $fullName;
    private ?string $phone;
    private ?string $address;
    private ?string $bio;
    private ?string $created_at;
    private ?string $updated_at;

    public function __construct(
        ?int $id,
        ?string $fullName,
        ?string $phone,
        ?string $address,
        ?array $socialMedia,
        ?string $bio,
        ?string $created_at,
        ?string $updated_at
    ) {
        $this->id = $id;
        $this->fullName = $fullName;
        $this->phone = $phone;
        $this->address = $address;
        $this->bio = $bio;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }


    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(string $bio): void
    {
        $this->bio = $bio;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(string $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

}