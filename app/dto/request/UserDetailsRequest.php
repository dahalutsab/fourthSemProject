<?php

namespace App\dto\request;

class UserDetailsRequest
{
    private ?string $fullName;
    private ?string $phone;
    private ?string $address;
    private ?string $profilePicture;
    private ?array $socialMedia;
    private ?string $bio;

    public function __construct(
        ?string $fullName,
        ?string $phone,
        ?string $address,
        ?string $profilePicture,
        ?array $socialMedia,
        ?string $bio
    ) {
        $this->fullName = $fullName;
        $this->phone = $phone;
        $this->address = $address;
        $this->profilePicture = $profilePicture;
        $this->socialMedia = $socialMedia;
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

    public function getProfilePicture(): ?string
    {
        return $this->profilePicture;
    }


    public function setProfilePicture(?string $profilePicture): void
    {
        $this->profilePicture = $profilePicture;
    }

    public function getSocialMedia(): ?array
    {
        return $this->socialMedia;
    }

    public function setSocialMedia(?array $socialMedia): void
    {
        $this->socialMedia = $socialMedia;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): void
    {
        $this->bio = $bio;
    }


}