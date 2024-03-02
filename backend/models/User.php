<?php

class User {
    private int $id;
    private string $username;
    private string $email;
    private string $passwordHash;
    private string $firstName;
    private string $lastName = "";
    private string $bio = "";
    private string $profilePicture = "";
    private string $createdAt;
    private string $updatedAt;

    public function __construct(
        int $id,
        string $username,
        string $email,
        string $passwordHash,
        string $firstName,
        string $lastName = "",
        string $bio = "",
        string $profilePicture = "",
        string $createdAt = "",
        string $updatedAt = ""
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->bio = $bio;
        $this->profilePicture = $profilePicture;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

//     Getters
    public function getId(): int {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPasswordHash(): string {
        return $this->passwordHash;
    }

    public function getFirstName(): string {
        return $this->firstName;
    }

    public function getLastName(): string {
        return $this->lastName;
    }

    public function getBio(): string {
        return $this->bio;
    }

    public function getProfilePicture(): string {
        return $this->profilePicture;
    }

    public function getCreatedAt(): string {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string {
        return $this->updatedAt;
    }


    // Setters
    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setPasswordHash(string $passwordHash): void {
        $this->passwordHash = $passwordHash;
    }

    public function setFirstName(string $firstName): void {
        $this->firstName = $firstName;
    }

    public function setLastName(string $lastName): void {
        $this->lastName = $lastName;
    }

    public function setBio(string $bio): void {
        $this->bio = $bio;
    }

    public function setProfilePicture(string $profilePicture): void {
        $this->profilePicture = $profilePicture;
    }

    public function setCreatedAt(string $createdAt): void {
        $this->createdAt = $createdAt;
    }

    public function setUpdatesAt(string $updatedAt): void {
        $this->createdAt = $updatedAt;
    }
}

