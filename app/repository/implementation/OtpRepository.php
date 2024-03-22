<?php

namespace App\repository\implementation;

use App\models\Otp;
use App\Repository\OtpRepositoryInterface;
use Config\Database;


class OtpRepository implements OtpRepositoryInterface
{
    protected Database $database;

    public function __construct() {
        $this->database = new Database;
    }

    public function save( Otp $otp): void
    {
        $stmt = $this->database->getConnection()->prepare("INSERT INTO otps (user_id, otp, created_at, expires_at) VALUES (?, ?, ?, ?)");
        $userId = $otp->getUserId();
        $otp1 = $otp->getOtp();
        $created_at = $otp->getCreatedDate();
        $expires_at = $otp->getExpiresAt();
        $stmt->bind_param("isdd", $userId, $otp1, $created_at, $expires_at);
        $stmt->execute();
        $stmt->close();
    }

    public function find(string $email, string $otp): ?Otp
    {
        // TODO: Implement find() method.
    }

    public function verifyUserOtp($userId, $otp): bool
    {
//        get OTP as model from database
        $stmt = $this->database->getConnection()->prepare("SELECT * FROM otps WHERE user_id = ? AND otp = ? ");
        $stmt->bind_param("ii", $userId, $otp);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->num_rows > 0;
    }


}