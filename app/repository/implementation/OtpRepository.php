<?php

namespace App\repository\implementation;

use App\models\Otp;
use App\Repository\OtpRepositoryInterface;
use Config\Database;
use DateTime;
use Exception;


class OtpRepository implements OtpRepositoryInterface
{
    protected Database $database;

    public function __construct() {
        $this->database = new Database;
    }

    public function save(Otp $otp): void
    {
        $stmt = $this->database->getConnection()->prepare("INSERT INTO otp (user_id, otp, created_at, expires_at) VALUES (?, ?, ?, ?)");

        // Get values from the $otp object
        $userId = $otp->getUserId();
        $otpValue = $otp->getOtp();
        $created_at = $otp->getCreatedDate()->format('Y-m-d H:i:s');
        $expires_at = $otp->getExpiresAt()->format('Y-m-d H:i:s');

        // Bind parameters
        $stmt->bind_param("isss", $userId, $otpValue, $created_at, $expires_at);

        // Execute statement
        $stmt->execute();

        // Close statement
        $stmt->close();
    }


    public function find(string $email, string $otp): ?Otp
    {
        // TODO: Implement find() method.
    }

    /**
     * @throws Exception
     */
    public function verifyUserOtp($userId, $otp): bool
    {
        // Get OTP record from the database
        $stmt = $this->database->getConnection()->prepare("SELECT * FROM otp WHERE user_id = ? AND otp = ? ");
        $stmt->bind_param("ii", $userId, $otp);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        // Check if OTP record exists
        if ($result->num_rows > 0) {
            $otpRecord = $result->fetch_assoc();

            // Check if the OTP is not expired
            $expiresAt = new DateTime($otpRecord['expires_at']);
            $currentDateTime = new DateTime();

            if ($expiresAt > $currentDateTime) {
                return true; // OTP is valid and not expired
            }
        }

        return false; // OTP is either invalid or expired
    }



}