<?php
namespace App\Controllers;


use App\Models\Otp;
use App\service\implementation\MailerService;
use App\service\implementation\OtpService;
use App\Services\Implementation\UserService;
use DateTime;
use Exception;

require_once __DIR__ . '/../../app/service/implementation/UserService.php';
require_once __DIR__ . '/../../app/service/implementation/OtpService.php';
require_once __DIR__ . '/../../app/service/implementation/MailerService.php';

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
        $this->otpService->sendOtp($email, $this->otpService->generateOtp());
        header('Location: /verify-otp');
    }


    public function verifyOtp(): void
    {
        // Retrieve form data sent by the router
        $otp = $_POST['otp'] ?? '';
        $email = $_POST['email'] ?? '';

        // Perform basic validation
        if (empty($otp)) {
            // Handle missing fields error
            echo "OTP is required.";
            return;
        }


        //get userId from email from user table
        $userId = $this->userService->getUserId($email);
        // Verify OTP
        if ($this->otpService->verifyOtp($userId)) {
            header('Location: /home');
        } else {
            // Handle invalid OTP error
            echo "Invalid OTP.";
        }
    }

    public function tryMail(): void
    {
        $this->mailerService->tryMail();
    }
}
