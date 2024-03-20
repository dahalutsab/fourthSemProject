<?php
namespace App\controllers;


use App\service\implementation\MailerService;
use App\service\implementation\OtpService;
use App\service\implementation\UserService;
use Exception;

class UserController {
    protected UserService $userService;
    protected OtpService $otpService;

    protected MailerService $mailerService;

    public function __construct() {
        $this->userService = new UserService;
        $this->otpService = new OtpService;
        $this->mailerService = new MailerService;
    }

    /**
     * @throws Exception
     */
    public function signup(): void
    {
        // Retrieve form data sent by the router
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $role = $_POST['role'] ?? '';

        // Perform basic validation
        if (empty($username) || empty($email) || empty($password) || empty($role)) {
            // Handle missing fields error
            echo "All fields are required.";
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Handle invalid email format error
            echo "Invalid email format.";
            return;
        }

        // Perform password strength validation
        if (strlen($password) < 8) {
            // Handle weak password error
            echo "Password must be at least 8 characters long.";
            return;
        }

        $this->userService->createUser($username, $email, $password, $role);

        header('Location: /verify-otp');
        $this->otpService->sendOtp($email, $username);
    }


    public function verifyOtp(): void
    {
        // Retrieve form data sent by the router
        $otp1 = $_POST['otp_1'] ?? '';
        $otp2 = $_POST['otp_2'] ?? '';
        $otp3 = $_POST['otp_3'] ?? '';
        $otp4 = $_POST['otp_4'] ?? '';
        $otp5 = $_POST['otp_5'] ?? '';
        $otp6 = $_POST['otp_6'] ?? '';
        //get email from session
        $email = $_SESSION[SESSION_EMAIL] ?? '';

        $otp = $otp1 . $otp2 . $otp3 . $otp4 . $otp5 . $otp6;

        // Perform basic validation
        if (empty($otp)) {
            // Handle missing fields error
            echo "OTP is required.";
            return;
        }


        //get userId from email from user table
        $userId = $this->userService->getUserId($email);
        // Verify OTP
        if ($this->otpService->verifyOtp($userId, $otp)) {
            header('Location: /home');
        } else {
            // Handle invalid OTP error
            echo "Invalid OTP.";
        }
    }

}
