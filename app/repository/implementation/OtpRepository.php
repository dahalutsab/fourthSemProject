<?php

namespace App\Repository\implementation;

use App\Models\Otp;
use App\Repository\OtpRepositoryInterface;
use Config\Database;

class OtpRepository implements OtpRepositoryInterface
{
    protected Database $database;

    public function __construct() {
        $this->database = new Database;
    }

    public function save( Otp $otp)
    {
        $stmt = $this->database->getConnection()->prepare("INSERT INTO otps (user_id, otp, created_at, expires_at) VALUES (?, ?, ?)");
    }
    public function saveUser($username, $email, $password, $accountType): void
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $createdDate = date('Y-m-d H:i:s');

        $stmt = $this->database->getConnection()->prepare("INSERT INTO users (username, email, password, role_id, created_at) VALUES ( ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $username, $email, $hashedPassword, $accountType, $createdDate);
        $stmt->execute();
        $stmt->close();
    }

    public function find(string $email, string $otp): ?Otp
    {
        // TODO: Implement find() method.
    }
}