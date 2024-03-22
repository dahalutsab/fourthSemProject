<?php

namespace App\dto\response;

class UserDetailsResponse {
    private int $id;
    private string $fullName;
    private string $stageName;
    private string $phone;
    private string $address;
    private string $category;
    private string $bio;
    private string $description;

    public function __construct(int $id, string $fullName, string $stageName, string $phone, string $address, string $category, string $bio, string $description) {
        $this->id = $id;
        $this->fullName = $fullName;
        $this->stageName = $stageName;
        $this->phone = $phone;
        $this->address = $address;
        $this->category = $category;
        $this->bio = $bio;
        $this->description = $description;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getFullName(): string {
        return $this->fullName;
    }

    public function getStageName(): string {
        return $this->stageName;
    }

    public function getPhone(): string {
        return $this->phone;
    }

    public function getAddress(): string {
        return $this->address;
    }

    public function getCategory(): string {
        return $this->category;
    }

    public function getBio(): string {
        return $this->bio;
    }

    public function getDescription(): string {
        return $this->description;
    }
}
