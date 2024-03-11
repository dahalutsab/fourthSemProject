<?php

namespace App\Repository;

use App\Models\User;
use App\Models\Otp;
require_once 'config/Database.php';

class UserRepositoryImpl implements UserRepository {
    private $otpRepository;

    public function __construct(OtpRepository $otpRepository)
    {
        $this->otpRepository = $otpRepository;
    }

    public function save(User $user)
    {
        global $mysqli;

        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            exit();
        }

        $stmt = $mysqli->prepare("INSERT INTO users (username, email, password, accountType, createdDate) VALUES (?, ?, ?, ?, ?)");
        $username = $user->getUsername();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $accountType = $user->getAccountType();
        $format = $user->getCreatedDate()->format('Y-m-d H:i:s');
        $stmt->bind_param("sssss", $username, $email, $password, $accountType, $format);
        $stmt->execute();
    }

    public function saveWithOtp(User $user)
    {
        // Save the user as before
        $this->save($user);

        // Now save the OTP
        $otp = $user->getOtp();
        if ($otp) {
            $this->otpRepository->save($otp);
        }
    }
}