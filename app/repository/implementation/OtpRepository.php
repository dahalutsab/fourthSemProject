<?php

namespace App\Repository\implementation;

use App\models\Otp;
use App\Repository\OtpRepositoryInterface;
use Cassandra\Date;
use Config\Database;
use DateInterval;

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
        $expires_at = $created_at->add(new DateInterval('3 minutes'));
        $stmt->bind_param("isd", $userId, $otp1, $created_at, $expires_at);
        $stmt->execute();
        $stmt->close();
    }

    public function find(string $email, string $otp): ?Otp
    {
        // TODO: Implement find() method.
    }

    public function verifyUserOtp($userId): bool
    {
        $stmt = $this->database->getConnection()->prepare("SELECT * FROM otps WHERE user_id = ? AND expires_at > NOW()");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result();
    }


}