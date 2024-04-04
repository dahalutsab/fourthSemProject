<?php

namespace App\models;

class UserDetails
{
    private ?int $id;
    private ?string $fullName;
    private ?string $phone;
    private ?string $address;
    private ?string $profilePicture;
    private ?array $socialMedia;
    private ?string $bio;
    private ?string $created_at;
    private ?string $updated_at;

    public function __construct(
        ?int $id,
        ?string $fullName,
        ?string $phone,
        ?string $address,
        ?string $profilePicture,
        ?array $socialMedia,
        ?string $bio,
        ?string $created_at,
        ?string $updated_at
    ) {
        $this->id = $id;
        $this->fullName = $fullName;
        $this->phone = $phone;
        $this->address = $address;
        $this->profilePicture = $profilePicture;
        $this->socialMedia = $socialMedia;
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

    public function getProfilePicture(): ?string
    {
        return $this->profilePicture;
    }

    public function setProfilePicture(string $profilePicture): void
    {
        $this->profilePicture = $profilePicture;
    }

    public function getSocialMedia(): ?array
    {
        return $this->socialMedia;
    }

    public function setSocialMedia(array $socialMedia): void
    {
        $this->socialMedia = $socialMedia;
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