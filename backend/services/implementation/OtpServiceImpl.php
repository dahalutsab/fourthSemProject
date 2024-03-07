<?php

namespace services\implementation;

use config\Database;
use mysqli;
use services\OtpService;

class OtpServiceImplementation implements OtpService {
    private mysqli $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function saveOtp(int $userId, string $otp, string $expiresAt): bool {
        $sql = "INSERT INTO otps (user_id, otp, created_at, expires_at) VALUES (?, ?, NOW(), ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iss", $userId, $otp, $expiresAt);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function validateOtp(int $userId, string $otp): bool {
        $sql = "SELECT * FROM otps WHERE user_id = ? AND otp = ? AND expires_at > NOW()";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $userId, $otp);
        $stmt->execute();
        $result = $stmt->get_result();
        $isValid = $result->num_rows > 0;
        $stmt->close();

        return $isValid;
    }


}
