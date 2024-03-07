<?php

namespace models;

class User {
    private int $id;
    private string $username;
    private string $email;
    private string $password;
    private int $role_id;
    private string $phone_number;
    private string $address;
    private string $created_at;

    public function __construct(int $id, string $username, string $email, string $password, int $role_id, string $phone_number, string $address, string $created_at) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role_id = $role_id;
        $this->phone_number = $phone_number;
        $this->address = $address;
        $this->created_at = $created_at;
    }

    // Getters and setters for each property
    public function getId(): int {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function getRoleId(): int {
        return $this->role_id;
    }

    public function setRoleId(int $role_id): void {
        $this->role_id = $role_id;
    }

    public function getPhoneNumber(): string {
        return $this->phone_number;
    }

    public function setPhoneNumber(string $phone_number): void {
        $this->phone_number = $phone_number;
    }

    public function getAddress(): string {
        return $this->address;
    }

    public function setAddress(string $address): void {
        $this->address = $address;
    }

    public function getCreatedAt(): string {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): void {
        $this->created_at = $created_at;
    }

}
