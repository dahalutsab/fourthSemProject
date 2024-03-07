<?php

namespace services;

use config\Database;
use models\User;
use services\implementation\UserService;


class UserServiceImplementation implements UserService {

    private mysqli $conn;
    private OtpService $otpService;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getUserById(int $id): ?User {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_object(User::class);
        $stmt->close();
        return $user;
    }

    public function getUserByUsername(string $username): ?User {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_object(User::class);
        $stmt->close();
        return $user;
    }

    public function getUserByEmail(string $email): ?User {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_object(User::class);
        $stmt->close();
        return $user;
    }


    public function createUser(User $user): bool {
        // Generate 6-digit numeric OTP
        $otp = rand(100000, 999999);

        // Create the user in the database
        $sql = "INSERT INTO users (username, email, password, role_id, phone_number, address) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $username = $user->getUsername();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $roleId = $user->getRoleId();
        $phoneNumber = $user->getPhoneNumber();
        $address = $user->getAddress();
        $stmt->bind_param("sssiis", $username, $email, $password, $roleId, $phoneNumber, $address);
        $result = $stmt->execute();
        $stmt->close();

        if ($result) {
            // Insert OTP into OTP table using the OtpService
            $userId = $this->conn->insert_id;
            $expiresAt = date('Y-m-d H:i:s', strtotime('+5 minutes'));
            return $this->otpService->saveOtp($userId, $otp, $expiresAt);
        }

        return false;
    }



    public function updateUser(User $user): bool {
        $sql = "UPDATE users SET username = ?, email = ?, password = ?, role_id = ?, phone_number = ?, address = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $username = $user->getUsername();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $roleId = $user->getRoleId();
        $phoneNumber = $user->getPhoneNumber();
        $address = $user->getAddress();
        $id = $user->getId();
        $stmt->bind_param($username, $email, $password, $roleId, $phoneNumber, $address, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function deleteUser(int $id): bool {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}
